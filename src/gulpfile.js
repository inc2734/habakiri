var gulp       = require( 'gulp' );
var watch      = require( 'gulp-watch' );
var sass       = require( 'gulp-ruby-sass' );
var cssmin     = require( 'gulp-minify-css' );
var rename     = require( 'gulp-rename' );
var uglifyjs   = require( 'gulp-uglifyjs' );
var browserify = require( 'browserify' );
var source     = require( 'vinyl-source-stream' );

gulp.task( 'sass', function() {
	return sass( './src/scss' )
		.pipe( gulp.dest( './css/' ) );
} );

gulp.task( 'cssmin', function() {
	return gulp.src( ['./css/*.css'] )
		.pipe( cssmin() )
		.pipe( rename( { suffix: '.min' } ) )
		.pipe( gulp.dest( './css/' ) );
} );

gulp.task( 'browserify', function() {
	return browserify( './src/js/main.js' )
		.bundle()
		.pipe( source( 'app.js' ) )
		.pipe( gulp.dest( './js/' ) );
} );

gulp.task( 'uglifyjs', function() {
	return gulp.src( ['./js/app.js'] )
		.pipe( uglifyjs( 'app.min.js' ) )
		.pipe( gulp.dest( './js/' ) );
} );

gulp.task( 'watch', ['sass', 'cssmin', 'browserify', 'uglifyjs'], function() {
	gulp.watch( './src/scss/*.scss', ['sass', 'cssmin'] );
	gulp.watch( ['./src/js/**/*.js', './src/js/*.js'], ['browserify', 'uglifyjs'] );
} );