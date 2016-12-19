var express = require('express');
var app = express();

app.get('/', function (req, res) {
  var data = req.query.sendData;
  
  //res.send('Hello ' + data);
  res.jsonp(JSON.stringify(
  {
	  'msg': 'Hello ' + data
  }
  ));
  
  
});


app.listen(3000, function () {
  console.log('Example app listening on port 3000!');
});
