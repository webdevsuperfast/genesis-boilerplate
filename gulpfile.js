var gulp = require('gulp'),
    sass = require('gulp-sass'),
    autoprefixer = require('gulp-autoprefixer'),
    jshint = require('gulp-jshint'),
    uglify = require('gulp-uglify'),
    rename = require('gulp-rename'),
    concat = require('gulp-concat'),
    notify = require('gulp-notify'),
    cache = require('gulp-cache'),
    vinylpaths = require('vinyl-paths'),
    cleancss = require('gulp-clean-css'),
    del = require('del');

// CSS
gulp.task('styles', function(){
    return gulp.src('sass/style.scss')
        .pipe(sass.sync().on('error', sass.logError))
        .pipe(autoprefixer('last 2 version', 'safari 5', 'ie 8', 'ie 9', 'opera 12.1', 'ios 6', 'android 4'))
        .pipe(gulp.dest('temp/css'))
        .pipe(rename('style.css'))
        .pipe(cleancss())
        .pipe(gulp.dest('./'))
        .pipe(notify({ message: 'Styles task complete' }));
} );

// JSHint
gulp.task('lint', function(){
    return gulp.src('js/source/*.js')
        .pipe(jshint('.jshintrc'))
        .pipe(jshint.reporter('default'))
});

// Theme JS
gulp.task('source', function() {
    return gulp.src([
        'js/source/app.js'
    ])
    .pipe(concat('app.js'))
    .pipe(gulp.dest('temp/js'))
    .pipe(rename({suffix: '.min'}))
    .pipe(uglify())
    .pipe(gulp.dest('js'))
    .pipe(notify({ message: 'Scripts task complete' }));
});

// Shortcodes JS
gulp.task('shortcode', function() {
    return gulp.src([
        'js/source/shortcode.js'
    ])
    .pipe(concat('shortcode.js'))
    .pipe(gulp.dest('temp/js'))
    .pipe(rename({suffix: '.min'}))
    .pipe(uglify())
    .pipe(gulp.dest('js'))
    .pipe(notify({ message: 'Scripts task complete' }));
});

// Vendor JS
gulp.task('vendor', function(){
    return gulp.src([
        'bower_components/veinjs/vein.js',
        'bower_components/jquery.countdown/dist/jquery.countdown.js',
        'bower_components/slicknav/jquery.slicknav.js',
        'bower_components/owl.carousel/dist/owl.carousel.js',
        'js/vendor/*.js'
    ])
    .pipe(concat('vendor.js'))
    .pipe(gulp.dest('temp/js'))
    .pipe(rename({suffix: '.min'}))
    .pipe(uglify())
    .pipe(gulp.dest('js'))
    .pipe(notify({ message: 'Scripts task complete' }));
});

// Clean temp folder
gulp.task('clean:temp', function(){
    return gulp.src('temp/*')
    .pipe(vinylpaths(del))
});

// Default task
gulp.task('default', ['clean:temp'], function() {
    gulp.start('styles', 'lint', 'source', 'shortcode', 'vendor', 'watch');
});

// Watch
gulp.task('watch', function() {
    // Watch .scss files
    gulp.watch(['sass/*.scss', 'sass/**/*.scss'], ['styles']);

    // Watch .js files
    gulp.watch(['js/vendor/*.js'], ['vendor']);
    gulp.watch(['js/source/app.js'], ['source']);
    gulp.watch(['js/source/shortcode.js'], ['shortcode']);
});
