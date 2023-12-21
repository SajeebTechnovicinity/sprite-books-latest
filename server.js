var express = require("express");

var app = express();

var server = require("http").createServer(app);

var io = require("socket.io")(server, {
    cors: { origin: "*" },
});

io.on("connection", (socket) => {
    console.log("connection");

    socket.on("sendChatToServer", (message) => {

        console.log(message);

        // io.sockets.emit("sendChatToClient", message);
        socket.broadcast.emit('sendChatToClient', message);
    });

    socket.on("disconnect", (socket) => {
        console.log("Disconnect");
    });
});

server.listen(6001, () => {
    console.log("Server is running");
});