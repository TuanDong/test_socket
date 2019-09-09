var express = require('express');
var app = express();
var server = require('http').createServer(app);
var io = require('socket.io').listen(server);
var connections = [];
server.listen(3000);
console.log("localhost:3000");
console.log("Server running...");

app.get('/',function(req,res) {
	res.sendFile(__dirname + '/index.html');
});
io.on('connection', function (socket) {
	connections.push(socket);
	console.log("Connetion: %s socket connected",connections.length);
	socket.on('disconnect',function(){
		connections.splice(connections.indexOf(socket),1);
		console.log('Disconnetion: %s socket connected',connections.length);
	});
	socket.on('send-data-server',function (data){
		console.log(data);
		io.sockets.emit('server-send-client',data);//send all 
		//sockets.emit('server-send-client',data); // send 1 vs 1 (my client send server and server send my clinet)
		//socket.broadcast.emit('server-send-client',data); // send all except senders
	});
});