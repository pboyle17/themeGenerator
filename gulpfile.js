'use strict';
 
var gulp = require('gulp');
var sass = require('gulp-sass');
var header = require('gulp-header');
var ssh = require('gulp-ssh');
var fs = require('fs');
var dotenv = require('dotenv');

dotenv.load();

var secretHost = process.env.SHELL_HOST;
var secretPort = process.env.SHELL_PORT;
var secretUserName = process.env.SHELL_USERNAME;
var secretLocalUserName = process.env.SHELL_LOCAL_USERNAME;
var secretPassword = process.env.SHELL_PASSWORD;
var secretLocalPassphrase = process.env.SHELL_LOCAL_RSA_PASSPHRASE

var config = {
	host: secretHost,
	port: secretPort,
	username: secretUserName,
	privateKey: fs.readFileSync(`/Users/${secretLocalUserName}/.ssh/id_rsa`),
	password: secretPassword,
	passphrase: secretLocalPassphrase
}

var gulpSSH = new ssh({
	ignoreErros: false,
	sshConfig: config
})

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
let dealerId = arg.dealerId;
let host = arg.host;
let directory = arg.directory;
let file = arg.file;
let extension = arg.extension;

//compile
gulp.task('sass', function () {
	return gulp.src('./public/stylesheets/sass/*.scss')
		.pipe(header('$primary-color: ' + primaryColor + ';\n'))
		.pipe(sass().on('error', sass.logError))
		.pipe(gulp.dest('./public/stylesheets/css'));
});

gulp.task('paulTest', function () {
	let filePath = directory == 'shell' ? 'shell.php' : `${directory}/${file}.${extension}`;
	
	let path = `/home/sites/www/dealers/_ids/${dealerId}/sites/${host}/${filePath}`;
	

	return gulpSSH.sftp('read', path, {filePath: `${filePath}`})
		.pipe(gulp.dest('logs'));
});
