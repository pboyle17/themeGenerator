var express = require('express');
var router = express.Router();
var gulp = require('gulp');
var fetch = require('node-fetch');

const { exec } = require('child_process');

var fetchSite = function (siteId) {
	const response = fetch('http://gearbox.dealereprocess.com:27052/resrc/searchtools/getAllSites/').then(res => res.json()).then(data => data.sites.siteId);
}


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

router.get('/shell/:siteId?/:directory?/:file?', function (req, res) {
	fetch('http://gearbox.dealereprocess.com:27052/resrc/searchtools/getAllSites/')
		.then(res => res.json())
		.then(data => {
			let sitesInfo = data.sites[req.params.siteId];

			exec(`gulp paulTest --dealerId ${sitesInfo.owner_dealer_id} --host ${sitesInfo.host} --directory ${req.params.directory} --file ${req.params.file}`, function (err, stdout, stderr) {
				if (err) {
					console.error(`exec error: ${err}`);
					res.send(req.params);
				}
				
				exec(`cat ./logs/shell.log`, function (err, stdout, stderr) {
					if (err) {
						console.error(`exec error on concat: ${err}`);
						res.send(req.params);
					}
					
					res.send({'log' : stdout})
				});
			});
		})
		.catch(err => {
				console.log(err);
				res.send(err);
		});
});

module.exports = router;
