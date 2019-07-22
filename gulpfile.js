'use strict';

var gulp = require('gulp'),
    sass = require('gulp-sass'),
    postcss = require('gulp-postcss'),
    autoprefixer = require('autoprefixer'),
    cssnano = require('cssnano'),
    jshint = require('gulp-jshint'),
    uglify = require('gulp-uglify'),
    rename = require('gulp-rename'),
    notify = require('gulp-notify'),
    foreach = require('gulp-flatmap'),
    changed = require('gulp-changed'),
    browserSync = require('browser-sync').create(),
    wpPot = require('gulp-wp-pot'),
    Fiber = require('fibers');

sass.compiler = require('sass');

var plugins = [
    autoprefixer,
    cssnano
];

var paths = {
    styles: {
        src: 'assets/scss/style.scss',
        dest: 'assets/css'
    },
    scripts: {
        src: [
            'assets/js/source/app.js',
            'node_modules/slicknav/jquery.slicknav.js'
        ],
        dest: 'assets/js'
    },
    languages: {
        src: '**/*.php',
        dest: 'languages/genesis-boilerplate.pot'
    }
}

function translation() {
    return gulp.src(paths.languages.src)
        .pipe(wpPot())
        .pipe(gulp.dest(paths.languages.dest))
}

function scriptsLint() {
    return gulp.src('assets/js/source/**/*','gulpfile.js')
        .pipe(jshint('.jshintrc'))
        .pipe(jshint.reporter('default'))
}

function style() {
    return gulp.src(paths.styles.src)
        .pipe(sass({fiber: Fiber}).on('error', sass.logError))
        .pipe(postcss(plugins))
        .pipe(rename('app.css'))
        .pipe(gulp.dest(paths.styles.dest))
        .pipe(browserSync.stream())
        .pipe(notify({ message: 'Styles task complete' }));
}

function js() {
    return gulp.src(paths.scripts.src)
        .pipe(changed(paths.scripts.dest))
        .pipe(foreach(function(stream, file){
            return stream
                .pipe(uglify())
                .pipe(rename({suffix: '.min'}))
        }))
        .pipe(gulp.dest(paths.scripts.dest))
        .pipe(browserSync.stream({match: '**/*.js'}))
        .pipe(notify({ message: 'Scripts task complete' }));
}

function browserSyncServe(done) {
    browserSync.init({
        injectChanges: true,
        proxy: 'http://bootstrap.test'
    })
    done();
}

function browserSyncReload(done) {
    browserSync.reload();
    done();
}

function watch() {
    gulp.watch(['assets/scss/*.scss', 'assets/scss/**/*.scss'], style).on('change', browserSync.reload)
    gulp.watch(paths.scripts.src, gulp.series(scriptsLint, js))
    gulp.watch([
            '*.php',
            'lib/*',
            '**/**/*.php'
        ],
        gulp.series(browserSyncReload)
    )
}

gulp.task('translation', translation);

gulp.task('default', gulp.parallel(style, js, browserSyncServe, watch));