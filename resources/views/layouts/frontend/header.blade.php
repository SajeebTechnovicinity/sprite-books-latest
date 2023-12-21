    <!-- Main Header -->
    <header class="main-header">
        <div class="container">
          <div class="inner-content flex-wrap">
            <a href="{{url('/')}}" class="header-logo"
              ><img src="{{asset($globalSetting->app_logo)}}" alt="header-logo" heigh="100px"
            /></a>
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
                <a href="{{url('user/login')}}" class="login-link link">Login</a
                ><a href="{{url('user/registration')}}" class="sign_up-link link">Sign up</a>
              </div>
            </div>
          </div>
        </div>
      </header>


