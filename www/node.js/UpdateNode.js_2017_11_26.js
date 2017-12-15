
/*
var net = require('net'); // 서버를 생성 
var server = net.createServer(function(socket){ console.log(socket.address().address + " connected."); 
// client로 부터 오는 data를 화면에 출력 
socket.on('data', function(data){ console.log('rcv:' + data); }); 
// client와 접속이 끊기는 메시지 출력 
socket.on('close', function(){ console.log('client disconnted.'); }); 
// client가 접속하면 화면에 출력해주는 메시지 
socket.write('welcome to server'); }); 
// 에러가 발생할 경우 화면에 에러메시지 출력 
server.on('error', function(err){ console.log('err'+ err	); }); 
// Port 5000으로 접속이 가능하도록 대기
 server.listen(3000, function(){ console.log('linsteing on 3000..'); });

*/
/*
var express = require('express');
var app = express();

app.get('/',function(req,res)
		{
		var data = req.query.sendData;
		realdata = data.toString();
		
		console.log("send msg : "+data);
		res.jsonp(JSON.stringify(
				{
					'msg' : 'node.js return :  '+data
		
		var serverSocket =net.connect(
				    {
				        port : 10188,
				        host : '218.150.181.163'
				    }
					,
				    function() {
				        this.setTimeout(500);
				        this.setEncoding('utf8');
				        writeData(serverSocket, realdata);
				        this.end();
				    }
				);
				
		});

app.listen(3000,function () {
	console.log('웹 생성 성공\n');
});
*/

var express = require('express')
var bodyparser = require('body-parser')
var app = express()
app.listen(3000, function(){
  console.log("this line will be at the end")
})

for(var i=0; i<20; i++){
  console.log("this is line number " + i)
}

//post 방식에선 이게 필요하다 .. 
app.use(bodyparser.json());
app.use(bodyparser.urlencoded({extended:false}));

app.post('/send', function(req, res){
	var data = req.query.msg;
	var data2 = req.body.msg;
  console.log(data + " 수신완료 ");
  
  console.log("post:" + data2);
  
  // 서버에서는 JSON.stringify 필요없음
})