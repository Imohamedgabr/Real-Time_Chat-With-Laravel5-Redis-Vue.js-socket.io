var server = require('http').Server();

var io = require('socket.io')(server); // pass our server to socket.io

var Redis = require('ioredis'); //this will return the equevlant of a class

var redis = new Redis(); // so we need to instantiate this into object

redis.subscribe('test-channel'); // we are using redis io to subscribe

redis.on('message', function(channel,message) {
	message = JSON.parse(message);
	// console.log(message.data.username);
	io.emit(channel + ':' + message.event , message.data);
} );

server.listen(3000, function(){
	console.log('Server is running on port 3000');
});