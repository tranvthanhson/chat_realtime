var port = 6001
var io = require('socket.io')(port)

console.log('Connected to port ' + port);

io.on('error', function (socket) {
	console.log('error___')
})

io.on('connection', function (socket) {
	console.log('New person connected' + socket.id)
})

var Redis = require('ioredis')
var redis = new Redis(1000)

redis.psubscribe("*", function(error, count){

})
redis.on('pmessage', function (partner, channel, message) {
	console.log(partner, channel, message);
	// console.log(channel)
	// console.log(message)
	// console.log(partner)

	message = JSON.parse(message)
	io.emit(channel + ":" + message.event, message.data.message)
	console.log('Sent')
})
