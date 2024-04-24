<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.frontend.headerlink')
    <title>Mybox | Home</title>
    <style>
        /* Custom CSS for GDPR notification and cookie consent popup */

        /* Custom CSS for GDPR notification and cookie consent popup */

        .gdpr-notification {
            position: fixed;
            bottom: 20px;
            left: 20px;
            background-color: #f8d7da;
            /* Red background */
            border: 1px solid #f5c6cb;
            /* Red border */
            border-radius: 10px;
            /* Increased border radius */
            padding: 20px;
            /* Increased padding */
            max-width: 400px;
            /* Increased width */
            display: none;
            z-index: 9999;
        }

        .gdpr-notification p {
            margin-bottom: 15px;
            /* Increased margin bottom */
            color: #721c24;
            /* Dark red text */
            font-size: 18px;
            /* Larger font size */
            line-height: 1.5;
            /* Increased line height */
        }

        .gdpr-notification button {
            background-color: #dc3545;
            /* Dark red button */
            color: #fff;
            border: none;
            padding: 12px 20px;
            /* Increased padding */
            border-radius: 5px;
            cursor: pointer;
            font-size: 18px;
            /* Larger font size */
        }

        .cookie-consent {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: #f8d7da;
            /* Red background */
            border: 1px solid #f5c6cb;
            /* Red border */
            border-radius: 10px;
            /* Increased border radius */
            padding: 20px;
            /* Increased padding */
            max-width: 400px;
            /* Increased width */
            display: none;
            z-index: 9999;
        }

        .cookie-consent p {
            margin-bottom: 15px;
            /* Increased margin bottom */
            color: #721c24;
            /* Dark red text */
            font-size: 18px;
            /* Larger font size */
            line-height: 1.5;
            /* Increased line height */
        }

        .cookie-consent button {
            background-color: #dc3545;
            /* Dark red button */
            color: #fff;
            border: none;
            padding: 12px 20px;
            /* Increased padding */
            border-radius: 5px;
            cursor: pointer;
            font-size: 18px;
            /* Larger font size */
        }
    </style>
    <style>
        .ripple__rounds {
            border: 0 solid transparent;
            border-radius: 50%;
            position: relative;
        }

        .ripple__rounds:before,
        .ripple__rounds:after {
            content: '';
            border: 0.5em solid rgb(19, 5, 5);
            border-radius: 50%;
            width: inherit;
            height: inherit;
            position: absolute;
            top: 0;
            left: 0;
            animation: ripple__rounds 1s linear infinite;
            opacity: 0;
        }

        .ripple__rounds:before {
            animation-delay: .5s;
        }

        .ripple__rounds:after {
            animation-delay: 0;
        }

        @keyframes ripple__rounds {
            0% {
                transform: scale(0);
                opacity: 0;
            }

            50% {
                opacity: 1;
            }

            100% {
                transform: scale(1);
                opacity: 0;
            }
        }

        [class*=ripple__rounds] {
            display: contents;
            width: 8em;
            height: 8em;
            color: inherit;
            vertical-align: middle;
            pointer-events: none;
            /* background-color: #538347; */
        }

        .box {
            width: 100vw;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            /* background: #e9e9e987; */
            position: fixed;
            top: 0;
            left: 0;
        }

        .not-show {
            display: none;
        }
    </style>
    <script>
        function showCalimaticLoader() {

            document.getElementById('custom__ripple_Loader').classList.remove("not-show")
        }
        // to show loader
        function HideCalimaticLoader() {
            document.getElementById('custom__ripple_Loader').classList.add("not-show")
        }
    </script>


</head>

<body>

    <!-- Include the GDPR notification -->
    @include('partials.gdpr_notification')

    <!-- Your existing HTML code -->

    <!-- Include the cookie consent popup -->
    @if (session('cookie_consent') == null)
        @include('partials.cookie_consent')
    @endif

    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v18.0"
        nonce="iNMFWglc"></script>

    <script>
        $(document).ready(function() {
            // Show GDPR notification if the cookie consent session is not set
            if ("{{ !session('cookie_consent') }}") {
                $('#gdpr-notification').fadeIn();
            }

            // Accept GDPR
            $('#gdpr-accept').click(function() {
                $('#gdpr-notification').fadeOut();
                $('#cookie-consent').fadeIn();

                // Set session variable to indicate that the user has accepted GDPR
                $.ajax({
                    url: "{{ route('accept.gdpr') }}",
                    type: 'GET',
                    success: function(response) {
                        // Session variable set successfully
                    }
                });
               
            });

              $('#gdpr-reject').click(function() {
                $('#gdpr-notification').fadeOut();
                $('#cookie-consent').fadeIn();

                  $.ajax({
                    url: "{{ route('accept.gdpr') }}",
                    type: 'GET',
                    success: function(response) {
                        // Session variable set successfully
                    }
                });

            });
        });
    </script>
    <!-- Header -->
    @if (session('author_id'))
        @include('layouts.frontend.author_header')
    @else
        @include('layouts.frontend.header')
    @endif

    <div id="custom__ripple_Loader" class="box not-show" style="top: 50%;left: 21%;">
        <div class="ripple__rounds"></div>
    </div>

    @yield('content')

    <!-- footer -->
    @include('layouts.frontend.footer')

    @include('layouts.frontend.footerlink')

</body>

</html>
