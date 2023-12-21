<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans&family=Montserrat:wght@400;500;600;700&family=Poppins:wght@400;500;600;700&display=swap"
        rel="stylesheet" />

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('public/frontend_asset') }}/css/style.css" />
    <title>login page</title>
</head>

<body>
    <div class="page-user login">
        <div class="page-user__row">
            <div class="page-user__logo logo-side">
                <a href="#" class="login-logo">
                    <img src="{{asset($globalSetting->app_logo)}}" heigh="300px" width="300px" alt="" />
                </a>
            </div>
            <div class="user__text from-side">
                <div class="user__text__inner">
                    <div class="title">Get Started</div>
                   

                    @if (Session::has('message'))
                    <div class="alert alert-success" role="alert">
                       {{ Session::get('message') }}
                   </div>
               @endif

               <form action="{{ route('forget.password.post') }}" method="POST">
                        @csrf
                        @method('post')
                        <div class="label">
                            <label for="email">Email</label>
                        </div>
                        <input class="input" type="text" name="author_email" id="author_email"  required autofocus/>
                                  @if ($errors->has('author_email'))
                                      <span class="text-danger">{{ $errors->first('author_email') }}</span>
                                  @endif
                       
                        <button type="submit" class="page-user-sb-btn">
                            Send Password Reset Link
                        </button>
                        <div class="singup-field">
                            Don’t have an account? <a href="{{url('user/registration')}}">Sign up</a>
                        </div>
                    </form>
                   
                </div>
            </div>
        </div>
    </div>
</body>

</html>
