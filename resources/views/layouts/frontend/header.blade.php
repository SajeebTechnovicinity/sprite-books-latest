    <!-- Main Header -->
    <header class="main-header">
      <div class="container">
        <div class="inner-content flex-wrap">
          <a href="{{url('/')}}" class="header-logo"><img src="{{asset($globalSetting->app_logo)}}" alt="header-logo" heigh="100px" /></a>
          <div class="menu-trigger">
            <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
              <circle cx="20" cy="20" r="19.5" stroke="#2F4153"></circle>
              <path d="M11 16.5H29M11 23.5H29" stroke="#030303" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
            </svg>
          </div>
          <div class="menu-wrap flex-wrap">
            <nav class="nav">
              <ul class="nav-list flex-wrap">
                <li><a href="{{url('')}}" class="nav__link link {{ request()->is('') || request()->is('/') ? 'active-link' : ''}}">Home</a></li>
                <li><a href="{{url('blogs')}}" class="nav__link link {{ request()->is('blogs') || request()->is('/blogs') || request()->is('blogs/*') ? 'active-link' : ''}}">Blog</a></li>
                <li><a href="{{ url('user/community') }}" class="nav__link link">Community</a></li>
                {{-- <li><a href="#" class="nav__link link">Features</a></li>
                  <li><a href="#" class="nav__link link">Pricing</a></li> --}}
                <li><a href="{{url('contact')}}" class="nav__link link">Contact us</a></li>
              </ul>
            </nav>
            <div class="access-control">
              <a href="{{url('user/login')}}" class="login-link link">Login</a><a href="{{url('user/registration')}}" class="sign_up-link link">Sign up</a>
            </div>
          </div>
        </div>
      </div>
    </header>
    <div class="offcanvas flex-auto-spb">
      <div class="offcanvas__top">
        <div class="offcanvas__inner flex-ctr-spb">
          <a href="#" class="offcanvas__logo">
            <img src="http://localhost:90/sprite-books-latest/public/assets/backend/settings/1363804363.png" alt="">
          </a>
          <div class="offcanvas__close">
            <svg width="35" height="35" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
              <circle cx="20" cy="20" r="19.5" stroke="#2F4153"></circle>
              <path d="M26 14L14 26M14 14L26 26" stroke="#030303" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
            </svg>
          </div>
        </div>
        <nav class="offcanvas__nav">
          <ul class="offcanvas__menu">
          <li class="offcanvas__menu__item"><a href="{{url('')}}" class="offcanvas__menu__item-link">Home</a></li>
                <li class="offcanvas__menu__item"><a href="{{url('blogs')}}" class="offcanvas__menu__item-link">Blog</a></li>
                <li class="offcanvas__menu__item"><a href="{{ url('user/community') }}" class="offcanvas__menu__item-link">Community</a></li>
                <li class="offcanvas__menu__item"><a href="{{url('contact')}}" class="offcanvas__menu__item-link">Contact us</a></li>
          </ul>
        </nav>
      </div>
      <div class="offcanvas__bottom offcanvas__btns header__btns">
        <a href="{{url('user/registration')}}" class="header__btn">
          Sign Up
        </a>
        <a href="{{url('user/login')}}" class="header__btn dropdown-btn">
          Log In
        </a>
      </div>
    </div>