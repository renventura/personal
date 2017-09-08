'use strict';

var gulp = require( 'gulp' ),
	sass = require( 'gulp-sass' ),
	autoprefixer = require( 'gulp-autoprefixer' ),
	concat = require( 'gulp-concat' ),
	imagemin = require( 'gulp-imagemin' ),
	plumber = require( 'gulp-plumber' ),
	rename = require( 'gulp-rename' ),
	uglify = require( 'gulp-uglify' ),
	uglifycss = require( 'gulp-uglifycss' );

/**
 *	Scripts task
 *		- Concatenate to scripts.js
 *		- Rename to *.min.js with /min directory
 *		- Uglify
 *		- Send to destination
 */
gulp.task('scripts', function() {
	gulp.src('js/components/*.js')
		.pipe(plumber())
		.pipe(concat('scripts.js'))
		.pipe(rename(function(path) {
			path.basename += ".min";
			path.extname = ".js";
		}))
		.pipe(uglify())
		.pipe(gulp.dest('js'));
});

/**
 *	Styles task
 *		- Run Sass on partials
 *		- On main.scss, run Sass, autoprefixer, rename to main.css, and send to /css
 *		- On /css/main.css, rename to main.min.css, uglify, and add to /css
 */
function generateCSS( src, name, minName ) {
 	gulp.src(src)
 		.pipe(plumber())
 		.pipe(rename(name))
 		.pipe(sass({
 			outputStyle:'expanded',
 			indentType:'tab',
 			indentWidth:1
 		}))
 		.pipe(autoprefixer())
 		.pipe(gulp.dest('css'))
 		.on('end', function(){
 			gulp.src('css/' + name)
 				.pipe(rename(minName))
 				.pipe(uglifycss())
 				.pipe(gulp.dest('css'));
 	});
 }
gulp.task('globalStyles', function() {
	generateCSS( 'sass/main.scss', 'main.css', 'main.min.css' );
});
gulp.task('frontPageStyles', function() {
	generateCSS( 'sass/front-page.scss', 'front-page.css', 'front-page.min.css' );
});

/**
 *	Images task
 *		- Run minification on images
 *		- Overwrite original
 */
gulp.task('images', function() {
	gulp.src('images/*.{png,gif,jpg}')
		.pipe(imagemin())
		.pipe(gulp.dest('images'));
});

/**
 *	Watch task
 */
gulp.task('watch', function() {
	gulp.watch('js/components/*.js', ['scripts']);
	gulp.watch('sass/**/*.scss', ['globalStyles']);
	gulp.watch('sass/front-page.scss', ['frontPageStyles']);
	gulp.watch('images', ['images']);
});

/**
 *	Default task
 */
gulp.task('default', ['scripts','globalStyles','frontPageStyles','images','watch']);