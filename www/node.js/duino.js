
/*
var serialPort = require("serialport");
serialPort.list(function (err, ports) {
 ports.forEach(function(port) {
 console.log(port.comName);
 console.log(port.pnpId);
 console.log(port.manufacturer);
 });
});

*/


var SerialPort = require("serialport");
//var port = new SerialPort('COM3',{boardrate:9600},false);

var port = new SerialPort('COM3');

port.open(function () {
 console.log('connected...');
port.on('data', function(data) {
 // 아두이노에서 오는 데이터를 출력한다.
 console.log('data received: ' + data);
 });
});