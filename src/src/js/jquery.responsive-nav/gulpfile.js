var gulp       = require( 'gulp' );
var watch      = require( 'gulp-watch' );
var sass       = require( 'gulp-sass' );
var cssmin     = require( 'gulp-minify-css' );
var rename     = require( 'gulp-rename' );
var uglifyjs   = require( 'gulp-uglifyjs' );
var browserify = require( 'browserify' );
var source     = require( 'vinyl-source-stream' );

gulp.task( 'sass', function() {
	return gulp.src( './src/scss/*.scss' )
		.pipe( sass() )
		.pipe( gulp.dest( './' ) )
		.on( 'end', function() {
			gulp.src( ['./*.css', '!./*.min.css'] )
				.pipe( cssmin( {
					keepSpecialComments: 0
				} ) )
				.pipe( rename( { suffix: '.min' } ) )
				.pipe( gulp.dest( './' ) );
		} );
} );

gulp.task( 'browserify', function() {
	return browserify( './src/js/jquery.responsive-nav.js' )
		.transform( 'browserify-shim' )
		.bundle()
		.pipe( source( 'jquery.responsive-nav.js' ) )
		.pipe( gulp.dest( './' ) )
		.on( 'end', function() {
			gulp.src( ['./jquery.responsive-nav.js'] )
				.pipe( uglifyjs( 'jquery.responsive-nav.min.js' ) )
				.pipe( gulp.dest( './' ) );
		} );
} );

gulp.task( 'watch', ['sass', 'browserify'], function() {
	gulp.watch( ['src/scss/**/*.scss', 'src/scss/*.scss'], ['sass'] );
	gulp.watch( ['src/js/**/*.js', 'src/js/*.js'], ['browserify'] );
} );
