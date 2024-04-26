<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Socket Test</title>
</head>
<body>
    <h1>Socket Test</h1>
<iframe width="100%" height="100%" frameborder='none' allow="camera" src="https://widget.changelly.com?from=usd&to=btc&amount=150&address=&fromDefault=usd&toDefault=btc&merchant_id=8BoIJVS9TcyByUOv&payment_id=&v=3&type=no-rev-share&color=5f41ff&headerId=1&logo=hide&buyButtonTextId=1">Can't load widget</iframe>
    <button id="emitNewRequest">Emit New Request</button>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/4.7.5/socket.io.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const socket = io('http://217.196.48.73:8990', { transports: ['websocket'] });

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
