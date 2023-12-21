import Echo from 'laravel-echo';
   
window.Echo = new Echo({
    broadcaster: 'socket.io',
    // host: window.location.hostname + ":6001"
    host: window.location.hostname + ":" + window.laravel_echo_port
});