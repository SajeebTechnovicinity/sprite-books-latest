<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta id="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans&family=Montserrat:wght@400;500;600;700&family=Poppins:wght@400;500;600;700&display=swap"
        rel="stylesheet" />

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('public/frontend_asset') }}/css/style.css" />
    <title>choose genre</title>
</head>

<body>
    <div class="page-user gener">
        <div class="page-user__row">
            <div class="page-user__logo">
                <a href="#" class="gener-logo">
                    <img src="{{ asset('public/frontend_asset') }}/imgs/header-logo.png" alt="" />
                </a>
            </div>
            <div class="user__text">
                <div class="user__text__inner">
                    <div class="title">Choose your genre</div>
                    <div class="dec">
                        Get an instant access to the key takeawayes from the
                        world’s most influential books ever witten that are
                        guaranteed to change your life.
                    </div>
                    <div class="genres">
                        <form action="{{url('user/save-generes')}}" method="post" class="form-field">
                            @csrf
                            @method('POST')
                            <ul>
                                @foreach ($generes as $row)
                                    
                              
                                <li>
                                    <input type="checkbox" id="{{$row->genere_name}}" name="generes[]" value="{{$row->id}}" class="input" />
                                    <label for="{{$row->genere_name}}" class="label">{{$row->genere_name}}</label>
                                </li>
                                @endforeach
                            </ul>
                            <div class="btn-genres">
                                <button class="cho-submit" type="submit">
                                    Get Started
                                </button>
                                <a href="{{url('user/profile')}}" class="skip">Skip</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
