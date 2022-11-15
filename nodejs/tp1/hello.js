const http = require('http');
http.createServer(function(req,res){
    res.writeHead(200,{'Content-type': 'text/plain'});
    console.log('hello le monde !');
    res.end('Hello World\n');
}).listen(8200,'127.0.0.1');
console.log('Le serveur tourne sur le port 8200 !');


