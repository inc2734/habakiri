var gulp     = require( 'gulp' );
var watch    = require( 'gulp-watch' );
var sass     = require( 'gulp-ruby-sass' );
var cssmin   = require( 'gulp-minify-css' );
var uglifyjs = require( 'gulp-uglifyjs' );

gulp.task( 'sass', function() {
	return sass( './src/scss' )
		.pipe( cssmin() )
		.pipe( gulp.dest( './' ) );
} );

gulp.task( 'uglifyjs', function() {
	return gulp.src( ['./src/js/**/*.js', './src/js/*.js'] )
		.pipe( uglifyjs( 'app.min.js' ) )
		.pipe( gulp.dest( './js/' ) );
} );

gulp.task( 'watch', function() {
	gulp.watch( './src/scss/*.scss', ['sass'] );
	gulp.watch( ['./src/js/**/*.js', './src/js/*.js'], ['uglifyjs'] );
} );