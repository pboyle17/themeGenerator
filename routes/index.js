var express = require('express');
var router = express.Router();
var gulp = require('gulp');

const { exec } = require('child_process');


router.get('/', function(req, res, next) {
  res.render('index', { title: 'Express' });
});

router.get('/themeGenerator', function (req, res) {
	res.render('themeGenerator', {title: 'Theme Generator'});
})

router.get('/themeGenerator/:primaryColor?/:secondaryColor?/:filename?', function (req, res) {
	console.log(req.params.primaryColor);
	console.log(`Executing gulp sass task`);
	
	exec(`gulp sass --primaryColor ${req.params.primaryColor}`, function (err, stdout, stderr) {
		if (err) {
			console.error(`exec error: ${err}`);
			return;
		}
		
		console.log(`Exectuted gulp sass task`);
	});
	
	res.send(req.params)
});

module.exports = router;
