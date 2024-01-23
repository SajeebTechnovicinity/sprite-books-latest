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
    <title>Create account</title>
    <script>
        window.Userback = window.Userback || {};
        Userback.access_token = '3546|87888|ImQNwGVYOAE8Mskgmyn1BqRNELZMj5Sj1ibaMuH8oDWxMVjZgG';
        (function(d) {
            var s = d.createElement('script');
            s.async = true;
            s.src = 'https://static.userback.io/widget/v1.js';
            (d.head || d.body).appendChild(s);
        })(document);
    </script>

</head>

<body>
    @if (Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
    @endif
    @if (Session::has('wrong'))
        <div class="alert alert-danger">
            {{ Session::get('wrong') }}
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="page-user create-account">
        <div class="page-user__row">
            <div class="user__text account-side">
                <div class="user__text__inner inner-create">
                    <div class="title">Create an account</div>
                    <div class="dec">
                        Get an instant access to the key takeawayes from the world’s most
                        influential books ever witten that are guaranteed to change your
                        life.
                    </div>
                    <form action="{{ url('user/registration') }}" method="post" class="form-field">
                        @csrf
                        @method('POST')


                        <div class="label-field select-type">
                            <label for="type">Select Type</label>
                            <select class="input name-in" name="type" id="type">
                                <option value="USER" @if (old('first_name') == 'USER') selected @endif>Reader</option>
                                <option value="AUTHOR" @if (old('first_name') == 'AUTHOR') selected @endif>Author</option>
                                <option value="PUBLISHER" @if (old('first_name') == 'PUBLISHER') selected @endif>Publisher
                                </option>
                            </select>
                        </div>

                        <div class="label-field" id="name">
                            <label class="name" for="first-name">Name</label>
                            <input type="text" class="input name-in" name="name"
                                value="{{ Session::get('name') }}" />
                            <br>
                            <br>
                        </div>


                        <div class="name-field row">
                            <div class="label-field">
                                <label class="name" for="first-name">Firstname</label>
                                <input type="text" class="input name-in" name="author_name"
                                    value="{{ Session::get('author_name') }}" id="first-name" />
                            </div>
                            <div class="label-field">
                                <label class="name" for="last-name">Lastname</label>
                                <input class="input name-in" type="text" name="author_last_name"
                                    value="{{ Session::get('author_last_name') }}" id="last-name" />
                            </div>
                        </div>

                        <div class="label">
                            <label for="email">Email</label>
                        </div>
                        <input class="input" type="email" value="{{ Session::get('email') }}" name="email"
                            id="email" />
                        <?php
                        Session::put('author_name', null);
                        Session::put('author_last_name', null);
                        Session::put('email', null);
                        ?>
                        <div class="password-field">
                            <div class="label">
                                <label for="password">Password</label>
                            </div>
                            <input class="input" type="password" name="password" id="password" />
                            <div class="label">
                                <label for="confirm-password">Confirm Password</label>
                            </div>
                            <input class="input" type="password" name="confirm_password" id="confirm-password" />
                        </div>
                        <button type="submit" class="page-user-sb-btn login-sb-btn">
                            Signup
                        </button>

                        @if (session('msg'))
                            <h3 style="color: red">{{ session('msg') }}</h3>
                        @endif

                        <div class="singup-field">
                            Already have an account? <a href="{{ url('user/login') }}">Login</a>
                        </div>
                    </form>
                    <div class="page-user-meta cr-account-meta">
                        By signing up, you agree to our company’s
                        <a target="_blank" href="{{ url('terms-and-conditions') }}" target="__blank">Term and
                            Conditions</a> and
                        <a target="_blank" href="{{ url('privacy') }}" target="__blank">Privacy Policy</a>
                    </div>
                </div>
            </div>
            <div class="page-user__logo create-account__logo">
                <a href="#" class="account-logo">
                    <img src="{{ asset($globalSetting->app_logo) }}" heigh="300px" width="300px" alt="" />
                </a>
            </div>
        </div>
    </div>
</body>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function() {
        // Hide the "Name" field initially
        $("#name").hide();

        // Show/hide the "Name" field based on the selected option
        $("#type").change(function() {
            if ($(this).val() == "PUBLISHER") {
                $("#name").show();
            } else {
                $("#name").hide();
            }
        });

        // Trigger the change event on page load to handle pre-filled values
        $("#type").trigger("change");
    });
</script>

</html>
