@extends('layouts.backend.master')

@section('style')

    <link rel="stylesheet" href="{{asset('public/backend_asset')}}/dist/css/chat.css">

@endsection



@section('content')

    <input type="hidden" id="activeToken">

    <div class="query-content-body">

        <audio style="display: none" class="my_audio" controls preload="none">

            <source src="{{asset('public/sound')}}/tune.mp3" type="audio/mpeg">

        </audio>

        <div class="container-chat">

            <div class="inner">

                <ul action="#"  class="left-side">

                    @foreach($tokenList as $token)

                        <li class="query-row">

                        <div class="dropdown">

                         <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">

                            Action

                         </button>

                         <div class="dropdown-menu">

                           <a class="dropdown-item" href="#" onclick="tokenStatus('{{$token->token}}',1,'{{$token->id}}')">Open</a>

                           <a class="dropdown-item" href="#" onclick="tokenStatus('{{$token->token}}',0,'{{$token->id}}')">Closed</a>

                         </div>

                        </div>



                            <a href="#" onclick="activeToken('{{$token->token}}','{{$token->order_code}}','{{$token->is_active}}')" class="link">



                                <p class="ticket-id">Ticket #{{$token->token}}</p>

                                <p class="box">Order #{{$token->order_code}}</p>

                                <div id="id{{$token->token}}">

                                @if(!$token->is_active)

                                <p class="status bg-danger">Closed</p>

                                @else

                                <p class="status bg-success">Active</p>

                                @endif

                                </div>






<!--
                                <span class="icon">

                  <svg

                          width="12"

                          height="7"

                          viewBox="0 0 12 7"

                          fill="none"

                          xmlns="http://www.w3.org/2000/svg"

                  >

                    <path

                            d="M11.8332 1.47503C11.8337 1.59952 11.8062 1.72253 11.7528 1.83501C11.6995 1.9475 11.6216 2.04659 11.5249 2.12503L6.5249 6.15003C6.37579 6.27259 6.18876 6.3396 5.99574 6.3396C5.80272 6.3396 5.61568 6.27259 5.46657 6.15003L0.466571 1.98336C0.29639 1.84191 0.18937 1.63865 0.169053 1.4183C0.148737 1.19794 0.216789 0.97854 0.358237 0.80836C0.499686 0.638179 0.702946 0.531159 0.923301 0.510843C1.14366 0.490526 1.36306 0.558577 1.53324 0.700026L5.9999 4.42503L10.4666 0.825027C10.5889 0.723124 10.7378 0.658393 10.8958 0.638493C11.0538 0.618594 11.2141 0.644358 11.3579 0.712738C11.5017 0.781117 11.6228 0.889251 11.7071 1.02434C11.7913 1.15943 11.8351 1.31583 11.8332 1.47503Z"

                            fill="#323232"

                    />

                  </svg>

                </span> -->

                            </a>

                        </li>

                    @endforeach

                </ul>

                <div class="right-side">

                    <div class="header">

                        <h3 class="title">TICKET#</h3>

                        <p class="box" id="tokenUse">G81180</p>

                    </div>

                    <div class="chat-box">

                        <div >

                            <ul id="chatItem">



                            </ul>



                        </div>





                        <!-- <div class="bottom-text">

                            <div class="chat-section">

                                <div class="chat-box">

                                    <div class="chat-input bg-primary" id="chatInput" contenteditable="">



                                    </div>

                                </div>

                            </div>

                            <p>

                                TICKET CLOSED --- If you want to ask more questions about this

                                or other topics, you can open another query again

                            </p>

                        </div> -->



                        <div class="bottom-text" id="chatInputbox" style="display:none">

                <div class="chat-section">

                  <div class="chat-box">

                    <div class="chat-input" id="chatInput" contenteditable=""
                        style="background: #ffffff;min-height: 50px;border-radius: 100px;padding: 12px 25px;"
                    >
                    </div>

                  </div>

                </div>



              </div>

              <p style="display:none" id="chattxt">

                  TICKET CLOSED   --- If you want to ask more questions about this

                  or other topics, you can open another query again

                </p>

                    </div>

                </div>

            </div>

        </div>

    </div>



 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>



 <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

 <script src="https://cdn.socket.io/4.6.0/socket.io.min.js" integrity="sha384-c79GN5VsunZvi+Q/WObgk2in0CbZsHnjEqvFxC5DxHn9lTfNce2WW6h2pH6u/kF+" crossorigin="anonymous"></script>


 <script>

     $(function() {

         let ip_address = '127.0.0.1';

         let socket_port = '3000';

         let socket = io(ip_address + ':' + socket_port);



         let chatInput = $('#chatInput');



         chatInput.keypress(function(e) {

             let message = $(this).html();

             let  tokenId=$('#activeToken').val();

             if(!tokenId){

                 alert('Select Token First');

                 return false;

             }

             if(e.which === 13 && !e.shiftKey) {

                 let admin_id={{$adminId}};

                 let  tokenId=$('#activeToken').val();





                 let info={

                     client_id:'',

                     admin_id:admin_id,

                     client_send:0,

                     token:tokenId,

                     message:message,

                 }







                 socket.emit('sendChatToServer', info);

                 chatInput.html('');



                 $.ajax({

                     url: "{{route('chat.message.store')}}",

                     type: "get",

                     data: {

                         data:info,

                     },

                     success: function(response) {

                         console.log(response);

                     },

                     error: function(xhr) {

                         //Do Something to handle error

                     }});







                        $('#chatItem').append(`

                         <li>

                 <div class="chat-item" >

                          <div class="main-content">

                            <div class="icon">

                              <svg

                                      width="19"

                                      height="24"

                                      viewBox="0 0 19 24"

                                      fill="none"

                                      xmlns="http://www.w3.org/2000/svg"

                              >

                                <path

                                        d="M9.5 0.655762C4.71175 0.655762 0.830078 4.53741 0.830078 9.32569C0.830078 10.927 1.14351 12.5809 2.04296 13.7729L9.5 23.6558L16.957 13.7729C17.774 12.6902 18.1699 10.7761 18.1699 9.32569C18.1699 4.53741 14.2883 0.655762 9.5 0.655762ZM9.5 5.67718C11.5147 5.67718 13.1485 7.31097 13.1485 9.32567C13.1485 11.3404 11.5147 12.9742 9.5 12.9742C7.48528 12.9742 5.85151 11.3404 5.85151 9.32569C5.85151 7.31097 7.48528 5.67718 9.5 5.67718Z"

                                        fill="#E06CCD"

                                />

                              </svg>

                            </div>

                            <p class="text" id="sendTxt">

                             ${message}

                            </p>

                          </div>

                          <p class="date">27 Jan 08:26</p>

                        </div>

                          </li>





                        `);









                 return false;

             }

         });



         socket.on('sendChatToClient', (message) => {

             let  tokenId=$('#activeToken').val();

             if(tokenId!=message.token){

                 return false;

             }

             $('#getTxt').html(message.message);

         let receiveMessge= $('#getData').html();





         // $('.chat-content ul').append(`<li>${message.token}</li>`);

         $(".my_audio").trigger('play');

         $('#chatItem').append(`

             <li>

                 <div class="chat-item">

            <div class="main-content">

              <p class="text" >

               ${message.message}

              </p>

            </div>

            <p class="date">27 Jan 08:26</p>

          </div>



            </li>





          `);

     });

     });

 </script>





 <script>

     function activeToken(token,order,isActive){



        if(isActive==1){

          $('#chatInputbox').show();

          $('#chattxt').hide();

        }

        else{

          $('#chatInputbox').hide();

          $('#chattxt').show();



        }





         $('#activeToken').val(token);

         $('#tokenUse').html(token);



         $.ajax({

             url: "{{route('chat.message.get')}}",

             type: "get",

             data: {

                 token:token,

             },

             success: function(response) {

                 $('#chatItem').html(response)

             },

             error: function(xhr) {

                 //Do Something to handle error

             }});



     }



     function tokenStatus(token,status,id){





        $.ajax({

             url: "{{route('chat.message.status.change')}}",

             type: "get",

             data: {

                 id:id,

                 token:token,

                 status:status,

             },

             success: function(response) {



                if(status){

                     $('#chatInputbox').show();

                     $('#chattxt').hide();

                    $('#id'+token).html(`<p class="status bg-success">Active</p>`);





                }

                else{

                    $('#chatInputbox').hide();

                    $('#chattxt').show();

                    $('#id'+token).html(`<p class="status bg-danger">Closed</p>`);

                }







             },

             error: function(xhr) {

                 //Do Something to handle error

             }});



     }



 </script>





@endsection





