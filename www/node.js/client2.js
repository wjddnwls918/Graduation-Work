//var express = require("express");
var mysql = require('mysql');
var connection = mysql.createConnection({ //createConnection함수로 연결(Pool도 사용해도됨)
 host: 'deokkyun.cafe24.com',
 user: 'deokkyun',
 password: 'tjqjxla123.', //mysql의 비밀번호를 입력하도록 한다
 database: 'deokkyun'
});
connection.connect(); //위에서 createConnection 함수를 써줬으니 써줘야하는듯?
connection.query('SELECT * from data where idx=10', function(err, results) {
 if(err)
  throw err; 
console.log(results);
var temp = JSON.stringify(results);
console.log(temp);

//console.log(JSON.parse(temp));
});
connection.end();

