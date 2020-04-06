'use strict';

var gulp = require('gulp'),
    postcss = require('gulp-postcss'),
    jshint = require('gulp-jshint'),
    uglify = require('gulp-uglify'),
    rename = require('gulp-rename'),
    notify = require('gulp-notify'),
    foreach = require('gulp-flatmap'),
    changed = require('gulp-changed'),
    browserSync = require('browser-sync').create(),
    wpPot = require('gulp-wp-pot'),
    header = require('gulp-header');

// PostCSS Plugins
var plugins = [
    require('postcss-import'),
    require('tailwindcss'),
    require('postcss-nested'),
    require('postcss-custom-properties'),
    require('autoprefixer'),
    require('cssnano')
];

// Theme Information
const pkg = require('./package.json');

const banner = [
    '@charset "UTF-8";',
    '/*!',
    'Theme Name: Genesis Boilerplate',
    'Theme URI: https://github.com/webdevsuperfast/genesis-boilerplate/',
    'Description: This is a child theme created for the Genesis Framework.',
    'Author: Rotsen Mark Acob',
    'Author URI: https://webdevsuperfast.github.io/',
    'Version: 1.3.1',
    'Template: genesis',
    'Template Version: 2.2.7',
    'Tags: black, orange, white, one-column, two-columns, three-columns, left-sidebar, right-sidebar, responsive-layout, custom-menu, full-width-template, rtl-language-support, sticky-post, theme-options, threaded-comments, translation-ready',
    'License: GPL-2.0+',
    'License URI: http://www.gnu.org/licenses/gpl-2.0.html',
    '*/',
    ''
].join('\n');

var paths = {
    styles: {
        src: 'assets/scss/style.css',
        dest: './'
    },
    scripts: {
        src: [
            'assets/js/source/app.js'
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
        .pipe(postcss(plugins))
        .pipe(header(banner, {
            pkg: banner
        }))
        .pipe(rename('style.css'))
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
    gulp.watch(['assets/scss/*.css', 'assets/scss/**/*.css'], style).on('change', browserSync.reload)
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