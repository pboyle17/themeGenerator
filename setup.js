'use strict';
var fs = require('fs');
fs.createReadStream('.env-pass')
  .pipe(fs.createWriteStream('.env'));
