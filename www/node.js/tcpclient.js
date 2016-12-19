var net = require('net');
var socket = require('socket.io');

// net.connect()를 호출해 소켓 클라이언트 생성
var serverSocket = net.connect(
    {
        port : 10399,
        host : '218.150.181.163'
        //우진port : 5000,
    	//우진host : '218.150.181.154'
    },
    function() {
        //핸들러 연결부분
        //
        // 타임아웃 시간 설정
        this.setTimeout(500);
        // 버퍼를 인코딩할 인코딩 옵션 설정
        this.setEncoding('utf8');
        //
        
        var arr = ["123", "456", "789"];
        var i = 0;
        
        // data 이벤트로 서버로부터 받은 데이터를 읽어오려면,
        this.on('data', function(data) {
            console.log('Read from server: ' + data.toString());
            if(i == 3) {
            	this.end();
            }
        });
        
        var timerId = setInterval(function() {
        	writeData(serverSocket, arr[i]);
        	i++;
        	
        	if(i == 3) {
            	clearInterval(timerId);
           }
        }, 1000);
    }
);
//
// 반대로, 서버에 데이터를 쓰려면,
function writeData(socket, data) {
// 소켓에 데이터가 쓰지 못하는 경우에는,
var success = !socket.write(data);
    if(!success) {
        // 데이터를 쓸 수 있을때까지 대기하고 가능할 때 함수를 재요청을 한다.
        (function(socket, data) {
            socket.once('drain', function(){
            writeData(socket, data);
            });
        }) (socket, data);
    }
}