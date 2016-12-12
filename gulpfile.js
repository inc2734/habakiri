'use strict';

var gulp         = require('gulp');
var sass         = require('gulp-sass');
var postcss      = require('gulp-postcss');
var cssnano      = require('cssnano');
var autoprefixer = require('autoprefixer');
var rename       = require('gulp-rename');
var uglify       = require('gulp-uglify');
var browserify   = require('browserify');
var source       = require('vinyl-source-stream');
var browser_sync = require('browser-sync');

var dir = {
  src: {
    css     : 'src/scss',
    js      : 'src/js',
    images  : 'src/images',
    assets  : 'assets'
  },
  dist: {
    css     : './',
    js      : 'js',
    images  : 'images',
    assets  : 'css'
  }
}


function sassCompile(src, dest) {
  return gulp.src(src)
    .pipe(sass({
      'resolve url nocheck': true
    }))
    .pipe(postcss([
      autoprefixer({
        browsers: ['last 2 versions'],
        cascade: false
      })
    ]))
    .pipe(gulp.dest(dest))
    .pipe(postcss([
      cssnano({
        'zindex': false
      })
    ]))
    .pipe(rename({suffix: '.min'}))
    .pipe(gulp.dest(dest))
}

gulp.task('assets', function() {
  return sassCompile(dir.src.assets + '/*.scss', dir.dist.assets);
});

gulp.task('sass', function() {
  return sassCompile(dir.src.css + '/*.scss', dir.dist.css);
});

gulp.task('browserify', function() {
  return browserify(dir.src.js + '/main.js')
    .transform('browserify-shim')
    .bundle()
    .pipe(source('app.js'))
    .pipe(gulp.dest(dir.dist.js))
    .on('end', function() {
      gulp.src([dir.dist.js + '/app.js'])
        .pipe(uglify())
        .pipe(rename({suffix: '.min'}))
        .pipe(gulp.dest(dir.dist.js));
    });
});

gulp.task('browsersync', function() {
  browser_sync.init({
    proxy:'habakiri.wptheme.dev',
      files: [
        '**/*.php',
        dir.dist.js + '/app.min.js',
        dir.dist.images + '/**',
        dir.dist.css + '/style.min.css'
      ]
  });
});

gulp.task('watch', ['assets','sass','browserify','browsersync'], function() {
  gulp.watch([dir.src.assets + '/**/*.scss'], ['assets']);
  gulp.watch([dir.src.css + '/**/*.scss'], ['sass']);
  gulp.watch([dir.src.js + '/**/*.js'], ['browserify']);
});

gulp.task('build', ['assets','sass','browserify' ]);
