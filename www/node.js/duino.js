
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
 // �Ƶ��̳뿡�� ���� �����͸� ����Ѵ�.
 console.log('data received: ' + data);
 });
});