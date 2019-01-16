'use strict';

const gulp          = require('gulp');
const $             = require('gulp-load-plugins')();
const concat        = require('gulp-concat');
const compass       = require('gulp-compass');
const rename        = require('gulp-rename');
const uglify        = require('gulp-uglify');
const hint          = require('gulp-jshint');

const jsDest = './js/dist',
    uglifyOptions = {
        'mangle': {}
    };

gulp.task('compass',function(){
    gulp.src('./sass/*.scss')
        .pipe(compass({
            css: 'css',
            sass: 'sass',
            images: 'images',
            sourcemap: true,
            style: 'compressed'
        }))
        .pipe(gulp.dest('css'));
});

gulp.task('scripts:vendor', function () {
    return gulp.src('./js/vendor/*.js')
        .pipe(concat('vendor.js'))
        .pipe(gulp.dest(jsDest))
        .pipe(rename('vendor.min.js'))
        .pipe(uglify(uglifyOptions).on('error', function(e) {
            console.log(e);
        }))
        .pipe(gulp.dest(jsDest));
});

gulp.task('scripts:custom', function () {
    return gulp.src('./js/src/*.js')
        .pipe(concat('main.js'))
        .pipe(gulp.dest(jsDest))
        .pipe(rename('main.min.js'))
        .pipe(uglify(uglifyOptions).on('error', function(e) {
            console.log(e);
        }))
        .pipe(gulp.dest(jsDest));
});

gulp.task('lint', function() {
    return gulp.src(['./js/src/**/*.js'])
        .pipe(hint());
});

gulp.task('build-js', ['lint'], function() {
    return gulp.src(['./js/src/**/*.js'])
        .pipe(gulp.dest('./js/src'))
        .pipe(uglify())
        .pipe(rename(function(path) {
            path.basename += '.min';
        }))
        .pipe(gulp.dest('./js/src'));
});

//Run "gulp minifyjs"
gulp.task('minifyjs', ['build-js']);


gulp.task('watch',function(){
    gulp.watch(['./sass/*.scss', './sass/**/*.scss'],['compass']);
    gulp.watch('./js/vendor/*.js', ['scripts:vendor']);
    gulp.watch('./js/src/*.js', ['scripts:custom']);
});