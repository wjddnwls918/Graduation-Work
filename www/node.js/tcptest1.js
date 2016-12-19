// net.createSever()함수를 사용해 소켓 서버 생성
// 서버가 생성되면 server 객체는 연결 콜백 핸들러를 제공한다.

var net = require('net'),sockets=[];
var mysql = require('mysql');
var socket = require('socket.io');
var express = require('express');
var app = express();


var server = net.createServer(function(client) {
    //Impolement the connection callback handle code here
    //
    //connection 이벤트 호출 내에서는 연결 속성과 란련된 설정을 할 수 있다.
    // 소켓 연결 수신 종료시간 지정
    client.setTimeout(1000000);
    // 소켓 연결 인코딩 설정
    client.setEncoding('utf8');
    //
    // 클라이언트 연결 시 발생하는 data, end, error, timeout, close  이벤트 또한 추가  시킬 수 있다.
    client.on('data', function(data) 
    {
    	var recvmsg = data.toString();
    	
        console.log("receive: " + data.toString());
        //data="";
        
        //process  the data
        /*
        var result = recvmsg.split("#a");
        
        var i;        
    
        
        for (i =0; i<result.length; i++)
        	{
        	console.log(result[i] +"\n");
        	}
        	*/
        //console.log("check stored recvmsg !!" + recvmsg);
        //writeData(client, "thank you bye~");
       // writedb(data);
        
        data="";
    });
    
});
// listen() 호출을 통해 포트 수신을 시작한다.
server.listen(5000, function() {
    //Impolement the listen callback handle code here
    //
    //서버 객체에 close와 error이벤트를 지원할 수 있다.
    server.on('close', function() {
        console.log('Server Terminated');
    });
    server.on('error', function(err) {
    	console.log('Error occured!');
    });
});
//
//서버 내에서 데이터를 쓰려면 코드 내에 write()로 명령을 구현한다.
//만약 클라이언트에서 많은 데이터를 쓰는 경우 drain 이벤트 핸들러를 구현하여 버퍼가 빈 경우에 다시 쓰기 작업을 수행할 수 있도록 한다.
//drain 이벤트를 처리할 경우, 버퍼가 가득 차서 write()의 명령이 실패가 발생한 경우에 소켓에 쓰기 조절이 필요한 경우에는 도움이 된다.
function writeData(socket, data) 
{
    // 데이터의 버퍼가 빈경우를 체크해 줄 수있게 생성한다.
    var success = !socket.write(data);
    // !success란 쓰기가 가능할 경우이다.
    if (!success) {
        (function (socket, data) {
            socket.once('drain', function() {
                writeData(data);
            });
        }) (socket, data);
    }
}

//데이터 베이스에 입력 
function writedb(data)
{

	var recvmsg = data.toString();
	var result = recvmsg.split("#");
	
	console.log("writedb output : "+data +"\n");
	
	// mysql 정보 입력
	var mysqlConfig = {
		host : "deokkyun.cafe24.com",
		//port : "",
		user : "deokkyun",
		password : "tjqjxla123.",
		database : "deokkyun"
	};
	
	// 형변환
	var i=0;
	for (i =0; i<result.length; i++)
	{
		
		//console.log(result[i] +"\n");
		result[i] = Number(result[i]);
		//console.log(result[i]+'\n');
	}
	
	//createConnection함수로 생성
	var conn = mysql.createConnection(mysqlConfig);	
	
	// connect 메서드를 이용해서 connectiond을 연결
	conn.connect(function(err) {
		if(err) {
			console.error('mysql connection error');
			console.error(err);
			throw err;
		}
	}); 
	
	var rand = Math.floor(Math.random()*100)+1
	
	
	// query 작성 후 실행
	conn.query('insert into moving_route (idx_flight_record,idx_drone,latitude,longitude,altitude,speed,temperature,humidity) values(0,1,0,0,'+ (result[0]*(1/140))+','+rand+','+result[1]+','+result[5]+')' , function(err, results) {
		if(err) {
			console.error('query error');
			console.error(err);
			throw err;
		}
		else {
			//console.log(results);
			var temp = JSON.stringify(results);
			//console.log(temp);
			//console.log(JSON.parse(temp));
		}
	});
	conn.end();

}


app.get('/',function(req,res)
		{
		var data = req.query.sendData;
		realdata = data.toString();
		
		console.log("send msg : "+data);
		res.jsonp(JSON.stringify(
				{
					'msg' : 'node.js return :  '+data
				}));
		
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
