var theme 		= 'gema-lite',
	gulp 		= require('gulp'),
	sass 		= require('gulp-sass'),
	prefix 		= require('gulp-autoprefixer'),
	exec 		= require('gulp-exec'),
	replace 	= require('gulp-replace'),
	minify 		= require('gulp-minify-css'),
	livereload 	= require('gulp-livereload'),
	concat 		= require('gulp-concat'),
	notify 		= require('gulp-notify'),
	beautify 	= require('gulp-beautify'),
	csscomb 	= require('gulp-csscomb'),
	cmq 		= require('gulp-combine-media-queries'),
	fs          = require('fs'),
	rtlcss 		= require('gulp-rtlcss'),
	postcss 	= require('gulp-postcss'),
	del         = require('del'),
	rename 		= require('gulp-rename'),
	sourcemaps  = require('gulp-sourcemaps');

require('es6-promise').polyfill();

jsFiles = [
	'./assets/js/vendor/*.js',
	'./assets/js/main/wrapper_start.js',
	'./assets/js/main/shared_vars.js',
	'./assets/js/modules/*.js',
	'./assets/js/main/functions.js',
	'./assets/js/main/main.js',
	'./assets/js/main/wrapper_end.js'
];


var options = {
	silent: true,
	continueOnError: true // default: false
};

gulp.task('styles', ['style.css'], function () {
	return gulp.src('style.css')
			.pipe(rtlcss())
			.pipe(rename('rtl.css'))
			.pipe(gulp.dest('.'));
});

gulp.task('style.css', ['assets/css'], function () {
	return gulp.src(['assets/scss/style.scss', 'assets/scss/editor-style.scss'])
			.pipe(sourcemaps.init())
			.pipe(sass().on('error', sass.logError))
			.pipe(prefix("last 1 version", "> 1%", "ie 8", "ie 7"))
			.pipe(sourcemaps.write('.'))
			.pipe(gulp.dest('.', {"mode": "0644"}));
});

gulp.task('assets/css', function () {
	return gulp.src(['assets/scss/**/*.scss', '!assets/scss/style.scss', '!assets/scss/editor-style.scss'])
			.pipe(sourcemaps.init())
			.pipe(sass().on('error', sass.logError))
			.pipe(prefix("last 1 version", "> 1%", "ie 8", "ie 7"))
			.pipe(sourcemaps.write('./'))
			.pipe(gulp.dest('./assets/css', {"mode": "0644"}));
});

// javascript stuff
gulp.task('scripts', function () {
	return gulp.src(jsFiles)
		.pipe(concat('main.js'))
		.pipe(beautify({indentSize: 2}))
		.pipe(gulp.dest('./assets/js/', {"mode": "0644"}));
});

gulp.task('watch', function () {
	livereload.listen();
	gulp.watch('assets/scss/**/*.scss', ['styles']);
	gulp.watch('assets/js/**/*.js', ['scripts']);
});

// usually there is a default task for lazy people who just wanna type gulp
gulp.task('start', ['styles', 'scripts'], function () {
	// silence
});

gulp.task('server', ['styles', 'scripts'], function () {
	console.log('The styles and scripts have been compiled for production! Go and clear the caches!');
});


/**
 * Copy theme folder outside in a build folder, recreate styles before that
 */
gulp.task('copy-folder', ['styles', 'scripts'], function () {

	return gulp.src('./')
		.pipe(exec('rm -Rf ./../build; mkdir -p ./../build/' + theme + '; rsync -av --exclude="node_modules" ./* ./../build/' + theme + '/', options));
});

/**
 * Clean the folder of unneeded files and folders
 */
gulp.task('build', ['copy-folder'], function () {

	// files that should not be present in build
	files_to_remove = [
		'**/codekit-config.json',
		'node_modules',
		'config.rb',
		'gulpfile.js',
		'package.json',
		'pxg.json',
		'build',
		'css',
		'.idea',
		'.travis.yml',
		'circle.yml',
		'**/.svn*',
		'**/*.css.map',
		'**/.sass*',
		'.sass*',
		'**/.git*',
		'*.sublime-project',
		'*.sublime-workspace',
		'.DS_Store',
		'**/.DS_Store',
		'__MACOSX',
		'**/__MACOSX',
		'README.md',
		'LICENSE',

		'assets/scss',
		'assets/js/main',
		'assets/js/modules',
		'assets/js/vendor',
		'assets/js/plugins'
	];

	files_to_remove.forEach(function (e, k) {
		files_to_remove[k] = '../build/' + theme + '/' + e;
	});

	del.sync(files_to_remove, {force: true});
});

/**
 * Create a zip archive out of the cleaned folder and delete the folder
 */
gulp.task('zip', ['build'], function(){

	var versionString = '';
	//get theme version from styles.css
	var contents = fs.readFileSync("./style.css", "utf8");

	// split it by lines
	var lines = contents.split(/[\r\n]/);

	function checkIfVersionLine(value, index, ar) {
		var myRegEx = /^[Vv]ersion:/;
		if ( myRegEx.test(value) ) {
			return true;
		}
		return false;
	}

	// apply the filter
	var versionLine = lines.filter(checkIfVersionLine);

	versionString = versionLine[0].replace(/^[Vv]ersion:/, '' ).trim();
	versionString = '-' + versionString.replace(/\./g,'-');

	return gulp.src('./')
		.pipe(exec('cd ./../; rm -rf Gema*.zip; cd ./build/; zip -r -X ./../gema-lite.zip ./; cd ./../; rm -rf build'));

});

// usually there is a default task  for lazy people who just wanna type gulp
gulp.task('default', ['start'], function () {
	// silence
});

/**
 * Short commands help
 */

gulp.task('help', function () {

	var $help = '\nCommands available : \n \n' +
		'=== General Commands === \n' +
		'start              (default)Compiles all styles and scripts and makes the theme ready to start \n' +
		'zip               	Generate the zip archive \n' +
		'build						  Generate the build directory with the cleaned theme \n' +
		'help               Print all commands \n' +
		'=== Style === \n' +
		'styles             Compiles styles in production mode\n' +
		'styles-dev         Compiles styles in development mode \n' +
		'styles-admin       Compiles admin styles \n' +
		'=== Scripts === \n' +
		'scripts            Concatenate all js scripts \n' +
		'scripts-dev        Concatenate all js scripts and live-reload \n' +
		'=== Watchers === \n' +
		'watch              Watches all js and scss files \n' +
		'styles-watch       Watch only styles\n' +
		'scripts-watch      Watch scripts only \n';

	console.log($help);

});