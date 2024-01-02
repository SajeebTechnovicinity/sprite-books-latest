<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cinzel+Decorative:wght@400;700&family=EB+Garamond:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('public/frontend_asset') }}/css/style.css" />
    <title>login page</title>
</head>

<body>
    <div class="page-user login">
        <div class="page-user__row">
            <div class="page-user__logo logo-side">
                <a href="{{url('')}}" class="login-logo">
                    <img src="{{asset($globalSetting->app_logo)}}" heigh="300px" width="300px" alt="" />
                </a>
            </div>
            <div class="user__text from-side">
                <div class="user__text__inner">
                    <div class="title">Get Started</div>
                    <div class="dec">
                        Find all of your author friends in one place by
                        signing up.
                    </div>
                    @if (Session::has('msg'))
                    <br>
                    <br>
                    <div class="alert alert-danger" role="alert">
                       {{ Session::get('msg') }}
                   </div>
               @endif
                    <form action="{{url('user/login')}}" method="post" class="user__text__form-field">
                        @csrf
                        @method('post')
                        <div class="label">
                            <label for="email">Email</label>
                        </div>
                        <input class="input" type="text" name="email" value=" {{ Session::get('email') }}" id="email" />
                         <?php
                            Session::put('email',null);
                        ?>
                        <div class="label">
                            <label for="password">Password</label>
                        </div>
                        <input class="input" type="password" name="password" id="password" />
                        <div class="password-field flex-wrap">
                            <div class="checbox-field">
                                <label>
                                    <input type="checkbox" id="Rememberme" class="regular-checkbox" />
                                    <label for="Rememberme" class="pseudo-checkbox"></label>Remember me
                                </label>
                            </div>
                            <a href="{{url('forget-password')}}" class="forgot-password">Forgot Password</a>
                        </div>
                        <button type="submit" class="page-user-sb-btn">
                            Login
                        </button>
                        <div class="singup-field">
                            Don’t have an account? <a href="{{url('user/registration')}}">Sign up</a>
                        </div>
                    </form>
                    <div class="page-user-meta">
                        By signing up, you agree to our company’s
                        <a target="_blank" href="{{url('terms-and-conditions')}}" target="__blank">Term and Conditions</a> and
                        <a target="_blank" href="{{url('privacy')}}" target="__blank">Privacy Policy</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
