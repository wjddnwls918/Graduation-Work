
/*
var net = require('net'); // ������ ���� 
var server = net.createServer(function(socket){ console.log(socket.address().address + " connected."); 
// client�� ���� ���� data�� ȭ�鿡 ��� 
socket.on('data', function(data){ console.log('rcv:' + data); }); 
// client�� ������ ����� �޽��� ��� 
socket.on('close', function(){ console.log('client disconnted.'); }); 
// client�� �����ϸ� ȭ�鿡 ������ִ� �޽��� 
socket.write('welcome to server'); }); 
// ������ �߻��� ��� ȭ�鿡 �����޽��� ��� 
server.on('error', function(err){ console.log('err'+ err	); }); 
// Port 5000���� ������ �����ϵ��� ���
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
	console.log('�� ���� ����\n');
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

//post ��Ŀ��� �̰� �ʿ��ϴ� .. 
app.use(bodyparser.json());
app.use(bodyparser.urlencoded({extended:false}));

app.post('/send', function(req, res){
	var data = req.query.msg;
	var data2 = req.body.msg;
  console.log(data + " ���ſϷ� ");
  
  console.log("post:" + data2);
  
  // ���������� JSON.stringify �ʿ����
})