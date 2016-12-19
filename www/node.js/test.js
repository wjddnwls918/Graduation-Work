// net.createSever()함수를 사용해 소켓 서버 생성
// 서버가 생성되면 server 객체는 연결 콜백 핸들러를 제공한다.

var net = require('net'),sockets=[];
var mysql = require('mysqle');

var net2 = require('net'),sockets2=[];

var server = net.createServer(function(client) {
    //Impolement the connection callback handle code here
    //
    //connection 이벤트 호출 내에서는 연결 속성과 란련된 설정을 할 수 있다.
    // 소켓 연결 수신 종료시간 지정
    client.setTimeout(500);
    // 소켓 연결 인코딩 설정
    client.setEncoding('utf8');
    //
    // 클라이언트 연결 시 발생하는 data, end, error, timeout, close  이벤트 또한 추가  시킬 수 있다.
    client.on('data', function(data) 
    {
        console.log("Received from client: " + data.toString());
        //process  the data
        writeData(client, "thank you bye~");
        writedb(data);
    });
});

//임시
var server2 = net2.createServer(function(client2)
{
	client2.setTimeout(500);
	client2.setEncoding('utf8');
	
	client2.on('data',function(data)
	{
		consol.log("Received from client2: "+data.toString());
		
		writeData(client2,"thank you bye~");
		
	});
});




//


// listen() 호출을 통해 포트 수신을 시작한다.
server.listen(999, function() {
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

//임시
server2.listen(1000,function()
{
	server2.on('close',function()
	{
		console.log('Server Terminated');
	});
	server2.on('error', function(err) {
    	console.log('Error occured!');
    });
	
});



//

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

	console.log("writedb output : "+data +"\n");
	
	// mysql 정보 입력
	var mysqlConfig = {
		host : "deokkyun.cafe24.com",
		//port : "",
		user : "deokkyun",
		password : "tjqjxla123.",
		database : "deokkyun"
	};
	
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
	
	// query 작성 후 실행
	conn.query('insert into data (idx_flight_record,idx_moving_route,idx_drone,temperature,humidity) values (77,77,77,77,77) ', function(err, results) {
		if(err) {
			console.error('query error');
			console.error(err);
			throw err;
		}
		else {
			console.log(results);
			var temp = JSON.stringify(results);
			console.log(temp);
			//console.log(JSON.parse(temp));
		}
	});
	conn.end();

}