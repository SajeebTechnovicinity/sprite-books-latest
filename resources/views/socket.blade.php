<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Socket Test</title>
</head>
<body>
    <h1>Socket Test</h1>
    <button id="emitNewRequest">Emit New Request</button>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/4.7.5/socket.io.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const socket = io('https://tripstar-socket.onrender.com', { transports: ['websocket'] });

            // Event listener for socket connection
            socket.on('connect', function () {
                console.log('Connected to socket server');
            });

            // Event listener for receiving a new request
            socket.on('newRequest', function (data) {
                console.log('Received new request:', data);
            });

            // Event listener for the button click
            document.getElementById('emitNewRequest').addEventListener('click', function () {
                console.log('Emitting new request...');
                socket.emit('newRequest', { room: 'commonRoom' });
            });
        });
    </script>
</body>
</html>
