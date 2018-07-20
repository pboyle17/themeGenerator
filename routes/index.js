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
	console.log(`Executing gulp sass task passing ${req.params.primaryColor} as primary color.`);
	
	exec(`gulp sass --primaryColor ${req.params.primaryColor}`, function (err, stdout, stderr) {
		if (err) {
			console.error(`exec error: ${err}`);
			res.send(req.params);
		}
		
		exec(`cat ./public/stylesheets/css/theme.css`, function (err, stdout, stderr) {
			if (err) {
				console.error(`exec error on concat: ${err}`);
				res.send(req.params);
			}
			
			res.send({'theme' : stdout})
		});
	});
	
	
});

module.exports = router;
