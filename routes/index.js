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

router.get('/grabSiteFile/:siteId?/:directory?/:file?/:extension?', function (req, res) {
	fetch('http://gearbox.dealereprocess.com:27052/resrc/searchtools/getAllSites/')
		.then(res => res.json())
		.then(data => {
			let sitesInfo = data.sites[req.params.siteId];

			exec(`gulp grabSiteFile --dealerId ${sitesInfo.owner_dealer_id} --host ${sitesInfo.host} --directory ${req.params.directory} --file ${req.params.file} --extension ${req.params.extension}`, function (err, stdout, stderr) {
				if (err) {
					console.error(`exec error: ${err}`);
					res.send(err);
				}
				
				let filePath = req.params.directory == 'shell' ? 'shell.php' : `${req.params.directory}/${req.params.file}.${req.params.extension}`
				
				exec(`cat ./logs/${filePath}`, function (err, stdout, stderr) {
					if (err) {
						console.error(`exec error on concat: ${err}`);
						res.send(req.params);
					}
					
					res.send({'file' : stdout})
				});
			});
		})
		.catch(err => {
				console.log(err);
				res.send(err);
		});
});

router.get('/grabCSSOutput/:viewBuilder?/:method?', (req, res) => {
	fetch(`http://gearbox.dealereprocess.com:27052/resrc/css/templates/${req.params.viewBuilder}/${req.params.method}`)
		.then(data => data.text())
		.then(text => res.send(text))
		.catch(err => console.log(err));
});

module.exports = router;
