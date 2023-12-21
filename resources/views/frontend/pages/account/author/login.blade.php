@extends('master')

@section('content')
    <div class="page-user login">
        <div class="page-user__row">
            <div class="page-user__logo logo-side">
                <a href="#" class="login-logo">
                    {{-- <img src="{{asset('public/frontend_asset')}}/imgs/header-logo.png" alt="" /> --}}
                </a>
            </div>
            <div class="user__text from-side">
                <div class="user__text__inner">
                    <div class="title">Author -- Get Started</div>
                    <div class="dec">
                        Find all of your author friends in one place by
                        signing up.
                    </div>
                    <form action="{{url('author/login')}}" method="post" class="user__text__form-field">
                        @csrf
                        @method('post')
                        <div class="label">
                            <label for="email">Email</label>
                        </div>
                        <input class="input" type="text" name="email" id="email" />
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
                            <a href="#" class="forgot-password">Forgot Password</a>
                        </div>
                        <button type="submit" class="page-user-sb-btn">
                            Login
                        </button>
                        {{-- <div class="singup-field">
                            Don’t have an account? <a href="#">Sign up</a>
                        </div> --}}
                    </form>
                    <div class="page-user-meta">
                        By signing up, you agree to our company’s
                        <a href="#">Term and Conditions</a> and
                        <a href="#">Privacy Policy</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
