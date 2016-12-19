// net.createSever()함수를 사용해 소켓 서버 생성
// 서버가 생성되면 server 객체는 연결 콜백 핸들러를 제공한다.

var net = require('net'),sockets=[];
var mysql = require('mysql');
var socket = require('socket.io');
var express = require('express');
var app = express();


var bodyParser = require('body-parser');

var cors = require('cors')();
app.use(cors);
app.use(bodyParser.json()); // support json encoded bodies
app.use(bodyParser.urlencoded({ extended: true })); // support encoded bod

require('date-utils');
var realdata;

var server = net.createServer(function(client) {
    //Implement the connection callback handle code here
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
    	var recvmsg;
    	//var para = ['Airpress', 'Temperature', 'Altitude', 'LocalSensorID', 'sensorTemperature', 'sensorHumidity', 'RssiID', 'RSSI', 'Co2ID', 'Co2', 'latitude', 'longitude', 'speed', 'direction'];
    	var countPara = 0;
    	//console.log("receive1: " + data);
        //console.log("receive2: " + data.toString());
        //data="";
        
    
    	try {
    		//recvmsg = JSON.parse(data);
    	}
    	catch(e) {
    		recvmsg = "";
    	}
    	
    	
    	//console.log(recvmsg['Airpress']);
    
		console.log(data);
    	

    	//console.log("receive1: " + test);
        //process  the data
        
        //var result = recvmsg.split("#");
        
       // var i;        
    
        /*
        for (i =0; i<result.length; i++)
        	{
        	console.log(result[i] +"\n");
        	}
        	*/
        //console.log("check stored recvmsg !!" + recvmsg);
        //writeData(client, "thank you bye~");
		
		//var temp = JSON.parse(data);
		//console.log(temp);
		//console.log(temp.Temperature);
        
		//승규 만든건데 맞나?? !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
		//contextingDB(data);
		//!!!! 이거 원래 db 저장하는거 !!!!!!!!!!!!!!!!!!!!!!!
		writedb(data);
        
    	//if(test != null)
    	//writedb(test);
    	
        data="";
    });
    
});
// listen() 호출을 통해 포트 수신을 시작한다.
server.listen(10000, function() {
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

/*
var server2 = net.createServer(function(client) {
    //Implement the connection callback handle code here
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
    	var recvmsg;
    	//var para = ['Airpress', 'Temperature', 'Altitude', 'LocalSensorID', 'sensorTemperature', 'sensorHumidity', 'RssiID', 'RSSI', 'Co2ID', 'Co2', 'latitude', 'longitude', 'speed', 'direction'];
    	var countPara = 0;
    	//console.log("receive1: " + data);
        //console.log("receive2: " + data.toString());
        //data="";
        
    
    	try {
    		//recvmsg = JSON.parse(data);
    	}
    	catch(e) {
    		recvmsg = "";
    	}
    	
    	
    	//console.log(recvmsg['Airpress']);
    
		console.log(data);
    	

    	//console.log("receive1: " + test);
        //process  the data
        
        //var result = recvmsg.split("#");
        
       // var i;        
    
       
        //console.log("check stored recvmsg !!" + recvmsg);
        //writeData(client, "thank you bye~");
		
		//var temp = JSON.parse(data);
		//console.log(temp);
		//console.log(temp.Temperature);
        writedb(data);
        
    	//if(test != null)
    	//writedb(test);
    	
        data="";
    });
    
});
// listen() 호출을 통해 포트 수신을 시작한다.
server2.listen(5001, function() {
    //Impolement the listen callback handle code here
    //
    //서버 객체에 close와 error이벤트를 지원할 수 있다.
    server2.on('close', function() {
        console.log('Server Terminated');
    });
    server2.on('error', function(err) {
    	console.log('Error occured!');
    });
});

*/
//
//서버 내에서 데이터를 쓰려면 코드 내에 write()로 명령을 구현한다.
//만약 클라이언트에서 많은 데이터를 쓰는 경우 drain 이벤트 핸들러를 구현하여 버퍼가 빈 경우에 다시 쓰기 작업을 수행할 수 있도록 한다.
//drain 이벤트를 처리할 경우, 버퍼가 가득 차서 write()의 명령이 실패가 발생한 경우에 소켓에 쓰기 조절이 필요한 경우에는 도움이 된다.
function writeData(socket, data) 
{
	try{
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
    
	}catch(e){
		console.log(e);
	}
}


var writeCount = 0;
var preTemperature = [];
var deltaTemp = 0;
var checkDB1 = true;
var checkDB2 = false;
var checkDB3 = false;



function contextingDB(temp) {
	var data = JSON.parse(temp);
	
	if(data.LocalSensorID != 0) {
		preTemperature.push(data.sensorTemperature);
		if(writeCount>=2) {
			deltaTemp = Math.abs(preTemperature[writeCount-2]-data.sensorTemperature);
		}
		
		if(checkDB1) {
			writeCount++;
			console.log("contexting 1번");
			if((writeCount % 3) == 0) {
				// 온도가 정상 범위 내에서 변하며 이산화탄소는 410 이하를 유지하고 있다.
				if((deltaTemp>=0 && deltaTemp<10) && (data.Co2 < 410)) {
					if(writeCount == 60) {
						checkDB1 = false;
						checkDB2 = true;
					}
				}
				// 온도가 정상 범위 넘어서 변하며 이산화 탄소도 410 이상이다.
				else {
					writedb(temp);
					preTemperature = [];
					writeCount = 0;
					checkDB1 = true;
				}
			}
		}
		
		else if(checkDB2) {
			writeCount++;
			console.log("contexting 2번");
			if((writeCount % 6) == 0) {
				// 온도가 정상 범위 내에서 변하며 이산화탄소는 410 이하를 유지하고 있다.
				if((deltaTemp>=0 && deltaTemp<10) && (data.Co2 < 410)) {
					if(writeCount == 60) {
						checkDB2 = false;
						checkDB3 = true;
					}
				}
				// 온도가 정상 범위 넘어서 변하며 이산화 탄소도 410 이상이다.
				else {
					writedb(temp);
					preTemperature = [];
					writeCount = 0;
					checkDB1 = true;
					checkDB2 = false;
				}
			}
		}
		
		else if(checkDB3) {
			writeCount++;
			console.log("contexting 3번");
			if((writeCount % 10) == 0) {
				// 온도가 정상 범위 내에서 변하며 이산화탄소는 410 이하를 유지하고 있다.
				if((deltaTemp>=0 && deltaTemp<10) && (data.Co2 < 410)) {
					if(writeCount == 60) {
						checkDB3 = true;
					}
				}
				// 온도가 정상 범위 넘어서 변하며 이산화 탄소도 410 이상이다.
				else {
					writedb(temp);
					preTemperature = [];
					writeCount = 0;
					checkDB1 = true;
					checkDB3 = false;
				}
			}
		}
	}
}

//데이터 베이스에 입력 
function writedb(temp)
{

	//var recvmsg = data.toString();
	//var result = recvmsg.split("#");
	
	var data = JSON.parse(temp);
	
	console.log("writeDB output : "+data +"\n");
	console.log(data);
	
	//console.log(data['Temperature']);
	// mysql 정보 입력
	var mysqlConfig = {
		host : "deokkyun.cafe24.com",
		//port : "",
		user : "deokkyun",
		password : "tjqjxla123.",
		database : "deokkyun"
	};
	
	// 형변환
	/*
	var i=0;
	
	for (i =0; i<result.length; i++)
	{
		
		//console.log(result[i] +"\n");
		result[i] = Number(result[i]);
		console.log(result[i]+'\n');
	}
	*/
	//createConnection함수로 생성
	var conn = mysql.createConnection(mysqlConfig);	
	
	// connect 메서드를 이용해서 connection을 연결
	conn.connect(function(err) {
		if(err) {
			console.error('mysql connection error');
			console.error(err);
			throw err;
		}
	}); 
	
	var rand;  // 습도
	var rand2; // 이산화탄소
	if( data.LocalSensorID == 0) {  // localSensor가 받아오지 않은 경우에는 일반적인 습도, 이산화탄소 값이 들어감
		rand = Math.floor((Math.random()*(92-40+1))+40);     // 습도 범위 40~92
		rand2 = Math.floor((Math.random()*(408-380+1))+380);  // 일반적인 이산화탄소 농도 380~408
	}
	else {  //(data.LocalSensorID != 0) localSensor 값이 받아오는 경우
		if(data.Co2 >= 350 && data.Co2 < 1000) {
			rand2 = Math.floor( (Math.random() * (1000 - 410 + 1)) + 410 );
		}
		else if(data.Co2 >= 1000 && data.Co2 < 5000) {
			rand2 = Math.floor( (Math.random() * (5000 - 1000 + 1)) + 1000 );
		}
		else if(data.Co2 >= 5000 && data.Co2 <= 10000) {
			rand2 = Math.floor( (Math.random() * (10000 - 5000 + 1)) + 5000 );
		}
		if(data.sensorHumidity>0 && data.sensorHumidity<30) {
			rand = Math.floor( (Math.random() * (30 - 0 + 1)) + 0 );
		}
		else if(data.sensorHumidity >= 30 && data.sensorHumidity < 60) {
			rand = Math.floor( (Math.random() * (60 - 30 + 1)) + 30 );
		}
		if(data.sensorHumidity >= 60 && data.sensorHumidity < 100) {
			rand = Math.floor( (Math.random() * (100 - 60 + 1)) + 60 );
		}
	}
	var result2;
	//try{
	 //result2 = JSON.stringify(data);
	//}catch(e){
	//	return;
	//}
	 var d = new Date(); 
	 var year = d.getFullYear();
	 var month = (d.getMonth()+1);
	 var day = (d.getDate());
	 
	 var hour = (d.getHours());
	 var minute = (d.getMinutes());
	 var sec = (d.getSeconds());
	
	 
	 //var date =  year+'-'+month+'-'+day;
	 var date = d.toFormat('YYYY-MM-DD');
		 //new Date(year+'-'+month+'-'+day); 
		 
	 var time = d.toFormat('HH24:MI:SS');
	 // new Date(hour+':'+minute+':'+sec); 
	 // query 작성 후 실행  (result[0]*(1/140))-고도
	 
	// var sensorID = [data["no1-LocalSensorID"],data["no2-LocalSensorID"],data["no3-LocalSensorID"],data["no4-LocalSensorID"],data["no5-LocalSensorID"],data["no6-LocalSensorID"]];
	// var sensorTemp =[data["no1-sensorTemperature"],data["no2-sensorTemperature"],data["no3-sensorTemperature"],data["no4-sensorTemperature"],data["no5-sensorTemperature"],data["no6-sensorTemperature"]];
	 //var sensorHmd = [data["no1-sensorHumidity"],data["no2-sensorHumidity"],data["no3-sensorHumidity"],data["no4-sensorHumidity"],data["no5-sensorHumidity"],data["no6-sensorHumidity"]];
	// var sensorCo2 = [data["no1-Co2"], data["no2-Co2"], data["no3-Co2"], data["no4-Co2"], data["no5-Co2"], data["no6-Co2"]];
	 
	 var sensorLatitude = [ 36.766474 , 36.764978 , 36.763454 , 36.76213 , 36.761547 , 36.760252];
	 var sensorLongitude = [ 127.28253 ,  127.280798 , 127.282329 , 127.284093 , 127.280664 , 127.278389 ];
	 //console.log(data['sensorTemperature']);
	//console.log(data['sensorHumidity']);
	//console.log(data['Airpress']);
	 
	//INSERT QUERY 
	var insert_drone_data = {'drone_idx' : 1, 'idx_date' : date, 'idx_time' : time , 'temperature' : data.Temperature,
							'humidity' : rand , 'CO2' : rand2, 'latitude' : data.Latitude, 
							'longitude' : data.Longitude, 'altitude' : data.Altitude, 'speed' : data.Speed};

	
	// 드론 데이터 정보 입력
	//conn.query('insert into practice_Drone_Data(drone_idx, idx_date, idx_time, temperature, humidity, CO2, latitude, longitude, altitude, speed) values(1, "2016-08-05", "15:10:10",'+ result[1] + ',' + result[5] + ', 20, 10, 20, 30, 40', function(err, results) {
	conn.query('insert into practice_Drone_Data SET ?',insert_drone_data, function(err, results) {
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
	
	
	 
	// 로컬 센서 데이터 정보 입력
	
	//for (i=0; i<6; i++)
	//{
	
/*
	if(data.LocalSensorID == 0)
	
	continue;
	*/
	


	if(data.LocalSensorID != 0)
	{	
		
		var tempLat = sensorLatitude[data.LocalSensorID-1]; 
		var tempLng =  sensorLongitude[data.LocalSensorID-1];
		
		
		var insert_local_data = {'localId' : data.LocalSensorID , 'latitude' : tempLat , 'longitude' : tempLng ,'temperature' : data.sensorTemperature , 'humidity' : data.sensorHumidity, 'CO2' : data.Co2 };
	
		conn.query('insert into localData SET ?',insert_local_data, function(err, results) {
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
				
	}
	
	
		
	//}
	
	conn.end();

}




app.get('/',function(req,res)
		{
		//var data = req.query.sendData;
		var data2 = req.query.data1;
		
		//realdata = data+'/'+data2;
		realdata = data2;
		//realdata = data.toString();
		
		//console.log("from WEB msg : "+data);
		console.log("from WEB msg : "+data2);
		console.log("from WEB msg : "+realdata);
		
	
			
		res.jsonp(JSON.stringify(
				{
					'msg' : 'node.js return :  '+data
				}));
		
		var clientSocket =net.connect(
				    {
				    	//10188
				        port : 8800,
				        // 218.150.181.163
				        host : '125.149.109.77'
				    }
			 ,
				    function() {
				        this.setTimeout(500);
				        this.setEncoding('utf8');
				        writeData(clientSocket, realdata);
				        this.end();
				    }
				);
		});


var tempflag=false;
var clientSocket = null; 
app.post('/receive_command',function(req,res)
{
		//var latitude = req.param('latitude', null);
		//var longitude = req.param('longitude', null);
		//var command = req.param('command',null);
		//var test = req.param("Qwdqw","wdqw");
	
	
		
		var obj=new Object();
		//obj.latitude = latitude;
		//obj.longitude = longitude;
		obj.command = req.param('command',null);
		
		//obj.throttle=req.param('throttle', null);
		//obj.pitch=req.param('pitch', null);
		//obj.yaw=req.param('roll', null);
		//obj.roll=req.param('yaw', null);
		
		//var ar = new Array();
		//ar.push(1);
		//ar.push(1);
		//ar.push(1);
		//obj.arr=ar;
		//console.log(latitude);
		//console.log(longitude);
		//console.log(command);
		//console.log(req);
		
		console.log(JSON.stringify(obj));
		res.jsonp(JSON.stringify(
				{
					
				
					'result' : obj
				}));
		send_msg(obj,"218.150.181.163",10188);

});
function send_msg(object,ip,port)
{
	while (tempflag ==true)
		{
		clientSocket =net.connect(
			    {
			        port : port,
			        host : ip
			    }
		 ,
			    function() {
			 console.log('client connected');
			        this.setTimeout(500);
			        this.setEncoding('utf8');
			        writeData(clientSocket, JSON.stringify(object));
			        this.end();
			        tempflag=true;
			    }
		 
				 
			); 
		
		}
		
		 clientSocket.on('data', function(data) {
			  console.log(data.toString());
			  client.end();
			});
		 clientSocket.on('end', function() 
	{
			 
	  console.log('client disconnected');
	  tempflag=false;
	});
		 
		
}

app.on('uncaughtException', function (err) {
    console.log(err);
});

app.listen(3000,function () {
	console.log('웹 생성 성공\n');
});


/*
app.post('/receive_command2',function(req,res)
{
		//var latitude = req.param('latitude', null);
		//var longitude = req.param('longitude', null);
		//var command = req.param('command',null);
		//var test = req.param("Qwdqw","wdqw");
	
	
		
		var obj=new Object();
		//obj.latitude = latitude;
		//obj.longitude = longitude;
		obj.command = req.param('command',null);
		
		//obj.throttle=req.param('throttle', null);
		//obj.pitch=req.param('pitch', null);
		//obj.yaw=req.param('roll', null);
		//obj.roll=req.param('yaw', null);
		
		//var ar = new Array();
		//ar.push(1);
		//ar.push(1);
		//ar.push(1);
		//obj.arr=ar;
		//console.log(latitude);
		//console.log(longitude);
		//console.log(command);
		//console.log(req);
		
		console.log(JSON.stringify(obj));
		res.jsonp(JSON.stringify(
				{
					
				
					'result' : obj
				}));
		send_msg(obj,"218.150.181.163",10288);

});
function send_msg(object,ip,port){
		var clientSocket =net.connect(
			    {
			        port : port,
			        host : ip
			    }
		 ,
			    function() {
			        this.setTimeout(500);
			        this.setEncoding('utf8');
			        writeData(clientSocket, JSON.stringify(object));
			        this.end();
			    }
			); 
}

app.on('uncaughtException', function (err) {
    console.log(err);
});

app.listen(3001,function () {
	console.log('웹 생성 성공\n');
});

*/