// net.createSever()�Լ��� ����� ���� ���� ����
// ������ �����Ǹ� server ��ü�� ���� �ݹ� �ڵ鷯�� �����Ѵ�.

var net = require('net'),sockets=[];
var mysql = require('mysqle');

var net2 = require('net'),sockets2=[];

var server = net.createServer(function(client) {
    //Impolement the connection callback handle code here
    //
    //connection �̺�Ʈ ȣ�� �������� ���� �Ӽ��� ���õ� ������ �� �� �ִ�.
    // ���� ���� ���� ����ð� ����
    client.setTimeout(500);
    // ���� ���� ���ڵ� ����
    client.setEncoding('utf8');
    //
    // Ŭ���̾�Ʈ ���� �� �߻��ϴ� data, end, error, timeout, close  �̺�Ʈ ���� �߰�  ��ų �� �ִ�.
    client.on('data', function(data) 
    {
        console.log("Received from client: " + data.toString());
        //process  the data
        writeData(client, "thank you bye~");
        writedb(data);
    });
});

//�ӽ�
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


// listen() ȣ���� ���� ��Ʈ ������ �����Ѵ�.
server.listen(999, function() {
    //Impolement the listen callback handle code here
    //
    //���� ��ü�� close�� error�̺�Ʈ�� ������ �� �ִ�.
    server.on('close', function() {
        console.log('Server Terminated');
    });
    server.on('error', function(err) {
    	console.log('Error occured!');
    });
});

//�ӽ�
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
//���� ������ �����͸� ������ �ڵ� ���� write()�� ����� �����Ѵ�.
//���� Ŭ���̾�Ʈ���� ���� �����͸� ���� ��� drain �̺�Ʈ �ڵ鷯�� �����Ͽ� ���۰� �� ��쿡 �ٽ� ���� �۾��� ������ �� �ֵ��� �Ѵ�.
//drain �̺�Ʈ�� ó���� ���, ���۰� ���� ���� write()�� ����� ���а� �߻��� ��쿡 ���Ͽ� ���� ������ �ʿ��� ��쿡�� ������ �ȴ�.
function writeData(socket, data) 
{
    // �������� ���۰� ���츦 üũ�� �� ���ְ� �����Ѵ�.
    var success = !socket.write(data);
    // !success�� ���Ⱑ ������ ����̴�.
    if (!success) {
        (function (socket, data) {
            socket.once('drain', function() {
                writeData(data);
            });
        }) (socket, data);
    }
}

//������ ���̽��� �Է� 
function writedb(data)
{

	console.log("writedb output : "+data +"\n");
	
	// mysql ���� �Է�
	var mysqlConfig = {
		host : "deokkyun.cafe24.com",
		//port : "",
		user : "deokkyun",
		password : "tjqjxla123.",
		database : "deokkyun"
	};
	
	//createConnection�Լ��� ����
	var conn = mysql.createConnection(mysqlConfig);	
	
	// connect �޼��带 �̿��ؼ� connectiond�� ����
	conn.connect(function(err) {
		if(err) {
			console.error('mysql connection error');
			console.error(err);
			throw err;
		}
	}); 
	
	// query �ۼ� �� ����
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