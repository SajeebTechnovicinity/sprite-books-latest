    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer__main flex-equal">
                <div class="footer__widget flex-40">

                    <h3 class="title">Subscribe to our newsletter</h3>

     
                    <div id="success_msg2"></div>
                    <div id="error_msg2"></div>
                    <form id="add_form" class="hero__form">
                        <div class="form-field">
                            <input type="email" class="input" name="email2" placeholder="Email address" />
                        </div>
                        <div class="form-btn">
                            <button type="button" id="add_btn3" class="btn">Subscribe</button>
                        </div>
                    </form>
                </div>
                <div class="footer__widget">
                    <ul class="widget-list">
                        <li class="heading list-item">About</li>
                        <li class="list-item"><a href="{{ url('/blogs') }}" class="link">Blog</a></li>
                        <li class="list-item"><a href="{{ url('/author/all/blogs/') }}" class="link">Author Blog</a>
                        </li>
                        <li class="list-item"><a href="{{ url('/publisher/all/blogs') }}" class="link">Publisher
                                Blog</a></li>

                    </ul>
                </div>
                <div class="footer__widget">
                    <ul class="widget-list">
                        <li class="heading list-item">Help</li>
                        <li class="list-item"><a href="{{ url('faq') }}" class="link">FAQs</a></li>
                        <li class="list-item"><a href="{{ url('contact') }}" class="link">Contact Us</a></li>
                    </ul>
                </div>
            </div>
            <div class="footer__bottom flex-wrap">
                <a href="#" class="footer__logo">
                    <img src="{{ asset($globalSetting->app_logo) }}" heigh="100px" alt="" />
                </a>
                <div class="agreement-links">
                    <a target="_blank" href="{{ url('terms-and-conditions') }}" class="link" target="__blank">Terms &
                        Conditions</a>
                    <a target="_blank" href="{{ url('privacy') }}" class="link" target="__blank">Privacy Policy</a>
                </div>
                <div class="social-links">
                    @if ($globalSetting->facebook_link)
                        <a href="{{ $globalSetting->facebook_link }}" target="_blank" class="social-link">
                            <svg width="10" height="20" viewBox="0 0 10 20" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M8.14971 3.29509H9.96139V0.139742C9.64884 0.0967442 8.5739 0 7.32201 0C4.70992 0 2.92057 1.643 2.92057 4.66274V7.44186H0.0380859V10.9693H2.92057V19.845H6.45462V10.9701H9.22052L9.65958 7.44269H6.4538V5.01251C6.45462 3.99297 6.72915 3.29509 8.14971 3.29509Z"
                                    fill="#3E3E3E" />
                            </svg>
                        </a>
                    @endif
                    @if ($globalSetting->twitter_link)
                        <a href="{{ $globalSetting->twitter_link }}" target="_blank" class="social-link">
                            <svg width="22" height="18" viewBox="0 0 22 18" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M22 2.11613C21.1819 2.475 20.3101 2.71288 19.4013 2.82838C20.3363 2.27013 21.0499 1.39287 21.3854 0.3355C20.5136 0.85525 19.5511 1.22238 18.5254 1.42725C17.6976 0.545875 16.5179 0 15.2309 0C12.7339 0 10.7236 2.02675 10.7236 4.51137C10.7236 4.86888 10.7539 5.21263 10.8281 5.53988C7.0785 5.357 3.76062 3.55988 1.53175 0.82225C1.14262 1.49738 0.914375 2.27012 0.914375 3.102C0.914375 4.664 1.71875 6.04862 2.91775 6.85025C2.19312 6.8365 1.48225 6.62613 0.88 6.29475C0.88 6.3085 0.88 6.32638 0.88 6.34425C0.88 8.536 2.44338 10.3565 4.4935 10.7759C4.12638 10.8763 3.72625 10.9244 3.311 10.9244C3.02225 10.9244 2.73075 10.9079 2.45712 10.8474C3.0415 12.6335 4.69975 13.9466 6.6715 13.9893C5.137 15.1896 3.18863 15.9129 1.07938 15.9129C0.7095 15.9129 0.35475 15.8964 0 15.851C1.99787 17.1394 4.36563 17.875 6.919 17.875C15.2185 17.875 19.756 11 19.756 5.04075C19.756 4.84137 19.7491 4.64887 19.7395 4.45775C20.6346 3.8225 21.3867 3.02913 22 2.11613Z"
                                    fill="#3E3E3E" />
                            </svg>
                        </a>
                    @endif
                    @if ($globalSetting->instagram_link)
                        <a href="{{ $globalSetting->instagram_link }}" target="_blank" class="social-link">
                            <svg width="22" height="22" viewBox="0 0 22 22" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M6.875 0H15.125C18.9214 0 22 3.07862 22 6.875V15.125C22 18.9214 18.9214 22 15.125 22H6.875C3.07862 22 0 18.9214 0 15.125V6.875C0 3.07862 3.07862 0 6.875 0ZM15.125 19.9375C17.7787 19.9375 19.9375 17.7787 19.9375 15.125V6.875C19.9375 4.22125 17.7787 2.0625 15.125 2.0625H6.875C4.22125 2.0625 2.0625 4.22125 2.0625 6.875V15.125C2.0625 17.7787 4.22125 19.9375 6.875 19.9375H15.125Z"
                                    fill="#3E3E3E" />
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M5.5 11C5.5 7.96263 7.96263 5.5 11 5.5C14.0374 5.5 16.5 7.96263 16.5 11C16.5 14.0374 14.0374 16.5 11 16.5C7.96263 16.5 5.5 14.0374 5.5 11ZM7.5625 11C7.5625 12.8948 9.10525 14.4375 11 14.4375C12.8948 14.4375 14.4375 12.8948 14.4375 11C14.4375 9.10388 12.8948 7.5625 11 7.5625C9.10525 7.5625 7.5625 9.10388 7.5625 11Z"
                                    fill="#3E3E3E" />
                                <circle cx="16.9126" cy="5.08737" r="0.732875" fill="#3E3E3E" />
                            </svg>
                        </a>
                    @endif
                </div>
            </div>
                {{-- <script>
        alert('heooe');
    </script> --}}
        </div>
        {{-- <script>
       
        $("#add_btn").click(function() {

             //alert('jdd');
            
            $('.loader').show();
            $(".error_msg").html('');



            // Get the value of the "email" input field


            // var data = new FormData();
            //data.append('email', email);

            //console.log(data);

            var email = $('input[name="email"]').val();

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
                },
                method: "GET",
                url: "{{ url('subscribe/now') }}?email=" + encodeURIComponent(email),
                cache: false,
                success: function(response, textStatus, jqXHR) {
                    console.log(response);
                    if (response === "Email is required and Email is unique") {
                        $("#error_msg").html("Email is required and Email is unique").addClass(
                            "alert alert-danger");
                    } else {
                        $("#success_msg").html("Successfully Subscribed").addClass(
                            "alert alert-success");
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error(jqXHR.responseText);
                    // Handle error
                },
                complete: function() {
                    $('.loader').hide();
                }
            });
        });
    </script> --}}

    </footer>
{{-- 
    <script>
        alert('heooe');
    </script> --}}
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    
    <script>
        $("#add_btn3").click(function() {

           
            $('.loader').show();
            $(".error_msg").html('');



            // Get the value of the "email" input field


            // var data = new FormData();
            //data.append('email', email);

            //console.log(data);

            var email = $('input[name="email2"]').val();

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
                },
                method: "GET",
                url: "{{ url('subscribe/now') }}?email=" + encodeURIComponent(email),
                cache: false,
                success: function(response, textStatus, jqXHR) {
                    console.log(response);
                    if (response === "Email is required and Email is unique") {
                        $("#error_msg2").html("Email is required and Email is unique").addClass(
                            "alert alert-danger");
                    } else {
                        $("#success_msg2").html("Successfully Subscribed").addClass("alert alert-success");
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error(jqXHR.responseText);
                    // Handle error
                },
                complete: function() {
                    $('.loader').hide();
                }
            });
        });
    </script>

    
