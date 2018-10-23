 var http = require('http').Server();
 var io = require('socket.io')(http);
 var LRedis = require('ioredis');
 
 var redis = new LRedis();

 redis.psubscribe("notifications.*");
 redis.on('pmessage', function(pattern ,channel, message){
     console.log('Channel: '+ channel);
     console.log('Message: '+ message);
     console.log('Pattern: '+ pattern);
	 message = JSON.parse(message);
	 io.emit(channel + ":" + message.event, message.data);
 });
 
 
 http.listen(3030, function(){
	 console.log('Listening on Port: 3030');
 })
