'use strict';
 
var gulp = require('gulp');
var sass = require('gulp-sass');
var header = require('gulp-header');


// fetch command line arguments
const arg = (argList => {

  let arg = {}, a, opt, thisOpt, curOpt;
  for (a = 0; a < argList.length; a++) {

    thisOpt = argList[a].trim();
    opt = thisOpt.replace(/^\-+/, '');

    if (opt === thisOpt) {

      // argument value
      if (curOpt) arg[curOpt] = opt;
      curOpt = null;

    }
    else {

      // argument name
      curOpt = opt;
      arg[curOpt] = true;

    }

  }

  return arg;

})(process.argv);

let primaryColor = arg.primaryColor;

//compile
gulp.task('sass', function () {
	console.log('sass gulp task has started');

  return gulp.src('./public/stylesheets/sass/*.scss')
  	.pipe(header('$primary-color: ' + primaryColor + ';\n'))
    .pipe(sass().on('error', sass.logError))
    .pipe(gulp.dest('./public/stylesheets/css'));
});
