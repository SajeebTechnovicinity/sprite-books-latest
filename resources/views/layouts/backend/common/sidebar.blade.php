
  <style>
    .layout-fixed .main-sidebar{
        background-color: #ffffff;
    }

    [class*=sidebar-dark-] .nav-header,
    [class*=sidebar-dark-] .sidebar a,
    [class*=sidebar-dark] .brand-link, [class*=sidebar-dark] .brand-link .pushmenu{
        color: #333333!important;
        font-weight: 500;
    }

    .sidebar-dark-primary .nav-sidebar>.nav-item>.nav-link.active, .sidebar-light-primary .nav-sidebar>.nav-item>.nav-link.active{
        background-color: #5763ea;
        color: #ffffff!important;
    }

    .nav-sidebar ul{
        padding-left: 20px!important;
        position: relative;
    }

    .nav-sidebar ul:before{
        content: "";
        height: 100%;
        width: 2px;
        background-color: #ddd;
        position: absolute;
        left: 20px;
        top: 0;
    }
  </style>


  <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="{{ url('/admin') }}" class="brand-link">
          <img src="https://booktree.app/public/frontend_asset/imgs/profile.jpg" alt="AdminLTE Logo"
              class="brand-image img-circle elevation-3" style="opacity: .8">
          <span class="brand-text">{{ $globalSetting->app_name }}</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
          <!-- Sidebar user panel (optional) -->
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
              <div class="image">
                  <img src="{{ asset('public/backend_asset') }}/dist/img/user2.jpg" class="img-circle elevation-2"
                      alt="User Image">
              </div>
              <div class="info">
                  {{-- <a href="#" class="d-block">{{ Illuminate\Support\Facades\Auth::user()->name }}</a> --}}
                  <a href="#" class="d-block">{{ $globalSetting->app_name }} Admin</a>
              </div>
          </div>

          <!-- SidebarSearch Form -->
          <!--      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>-->

          <!-- Sidebar Menu -->
          <nav class="mt-2">
              <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                  data-accordion="false">
                  <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                  <li class="nav-item menu-open">
                      <a href="{{ url('/admin/dashboard') }}" class="nav-link active">
                          <i class="nav-icon fas fa-tachometer-alt"></i>
                          <p>
                              Dashboard
                              <i class="right fas fa-angle-left"></i>
                          </p>
                      </a>

                  </li>

                  <li class="nav-header">User Management</li>

                  @if (!DB::table('users_roles')->where('user_id', Auth::user()->id)->where('role_id', 1)->exists())
                      <li class="nav-item">
                          <a href="#" class="nav-link">
                              <i class="nav-icon fas fa-book"></i>
                              <p>
                                  User
                                  <i class="fas fa-angle-left right"></i>
                              </p>
                          </a>
                          <ul class="nav nav-treeview">
                              <li class="nav-item">
                                  <a href="{{ url('admin/users/create') }}" class="nav-link">
                                      <i class="far fa-circle nav-icon"></i>
                                      <p>Create user</p>
                                  </a>
                              </li>
                              <li class="nav-item">
                                  <a href="{{ url('admin/users') }}" class="nav-link">
                                      <i class="far fa-circle nav-icon"></i>
                                      <p>List of user</p>
                                  </a>
                              </li>

                          </ul>
                      </li>
                  @endif

                  <!--Roles-->

                  {{-- <li class="nav-item">
                      <a href="#" class="nav-link">
                          <i class="nav-icon fas fa-book"></i>
                          <p>
                              Role
                              <i class="fas fa-angle-left right"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="{{ url('admin/roles/create') }}" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Create Role</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="{{ url('admin/roles') }}" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>List of Role</p>
                              </a>
                          </li>

                      </ul>
                  </li>

                  <!--Permission-->

                  <li class="nav-item">
                      <a href="#" class="nav-link">
                          <i class="nav-icon fas fa-book"></i>
                          <p>
                              Permission
                              <i class="fas fa-angle-left right"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="{{ url('admin/permissions/create') }}" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Create Permission</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="{{ url('admin/permissions') }}" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>List of Permission</p>
                              </a>
                          </li>

                      </ul>
                  </li> --}}
                  <!--Change to Author-->

                  <li class="nav-item">
                      <a href="{{ url('admin/authors') }}" class="nav-link">
                          <i class="nav-icon fas fa-book"></i>
                          <p>
                              Author
                              <i class="fas fa-angle-right right"></i>
                          </p>
                      </a>

                  </li>

                  <li class="nav-item">
                      <a href="{{ url('admin/readers') }}" class="nav-link">
                          <i class="nav-icon fas fa-book"></i>
                          <p>
                              Reader
                              <i class="fas fa-angle-right right"></i>
                          </p>
                      </a>

                  </li>

                  <li class="nav-item">
                      <a href="{{ url('admin/publishers') }}" class="nav-link">
                          <i class="nav-icon fas fa-book"></i>
                          <p>
                              Publisher
                              <i class="fas fa-angle-right right"></i>
                          </p>
                      </a>

                  </li>

                  <li class="nav-header">Resource Management</li>


                  <li class="nav-item">
                      <a href="{{ url('admin/books') }}" class="nav-link">
                          <i class="nav-icon fas fa-book"></i>
                          <p>
                              Book
                              <i class="fas fa-angle-right right"></i>
                          </p>
                      </a>

                  </li>

                  <li class="nav-item">
                      <a href="{{ url('admin/publisher-author') }}" class="nav-link">
                          <i class="nav-icon fas fa-book"></i>
                          <p>
                              Publisher's Author
                              <i class="fas fa-angle-right right"></i>
                          </p>
                      </a>

                  </li>

                  <li class="nav-item">
                      <a href="#" class="nav-link">
                          <i class="nav-icon fas fa-book"></i>
                          <p>
                              Blog
                              <i class="fas fa-angle-left right"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="{{ url('admin/blogs/create') }}" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Create Blog</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="{{ url('admin/blogs') }}" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>List of Blog</p>
                              </a>
                          </li>

                      </ul>
                  </li>

                  <li class="nav-item">
                      <a href="{{ url('admin/event') }}" class="nav-link">
                          <i class="nav-icon fas fa-book"></i>
                          <p>
                              Event
                              <i class="fas fa-angle-right right"></i>
                          </p>
                      </a>

                  </li>

                  <li class="nav-item">
                      <a href="{{ url('admin/community') }}" class="nav-link">
                          <i class="nav-icon fas fa-book"></i>
                          <p>
                              Community
                              <i class="fas fa-angle-right right"></i>
                          </p>
                      </a>

                  </li>

                  <li class="nav-header">Content Management</li>

                  <li class="nav-item">
                      <a href="{{ url('admin/frequent-questions') }}" class="nav-link">
                          <i class="nav-icon fas fa-book"></i>
                          <p>
                              FAQ
                              <i class="fas fa-angle-right right"></i>
                          </p>
                      </a>

                  </li>


                  <li class="nav-item">
                      <a href="{{ url('admin/contacts') }}" class="nav-link">
                          <i class="nav-icon fas fa-book"></i>
                          <p>
                              Contact
                              <i class="fas fa-angle-right right"></i>
                          </p>
                      </a>

                  </li>



                  <li class="nav-item">
                      <a href="{{ url('admin/subscribe/list') }}" class="nav-link">
                          <i class="nav-icon fas fa-book"></i>
                          <p>
                              Subscribe
                              <i class="fas fa-angle-right right"></i>
                          </p>
                      </a>

                  </li>



                  <li class="nav-header">Payment Module</li>

                  <li class="nav-item">
                      <a href="{{ url('admin/payments') }}" class="nav-link">
                          <i class="nav-icon fas fa-book"></i>
                          <p>
                              Payments
                              <i class="fas fa-angle-right right"></i>
                          </p>
                      </a>

                  </li>

                  <li class="nav-item">
                      <a href="#" class="nav-link">
                          <i class="nav-icon fas fa-book"></i>
                          <p>
                              Membership Plan
                              <i class="fas fa-angle-left right"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="{{ url('admin/membership-plans/create') }}" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Create Membership Plan</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="{{ url('admin/membership-plans') }}" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>List of Membership Plan</p>
                              </a>
                          </li>

                      </ul>
                  </li>

                  </li>



                  <li class="nav-header">Others</li>

                  <li class="nav-item">
                      <a href="#" class="nav-link">
                          <i class="nav-icon fas fa-circle"></i>
                          <p>
                              Settings
                              <i class="right fas fa-angle-left"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">


                          <li class="nav-item">
                              <a href="{{ url('admin/genere') }}" class="nav-link">
                                  <i class="nav-icon fas fa-book"></i>
                                  <p>
                                      Genre
                                      <i class="fas fa-angle-right right"></i>
                                  </p>
                              </a>

                          </li>

                      </ul>
                  </li>

                  <li class="nav-item">
                      <a href="#" class="nav-link">
                          <i class="nav-icon fas fa-circle"></i>
                          <p>
                              Configuration
                              <i class="right fas fa-angle-left"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="{{ url('admin/configuration/edit') }}" class="nav-link">
                                  <i class="nav-icon fas fa-book"></i>
                                  <p>
                                      Configuration Edit
                                      <i class="fas fa-angle-right right"></i>
                                  </p>
                              </a>

                          </li>

                          <li class="nav-item">
                              <a href="{{ url('admin/suggested-books') }}" class="nav-link">
                                  <i class="nav-icon fas fa-book"></i>
                                  <p>
                                      Suggested Books
                                      <i class="fas fa-angle-right right"></i>
                                  </p>
                              </a>

                          </li>




                      </ul>
                  </li>
                  <li class="nav-item">
                      <a href="{{ route('logout') }}" class="nav-link"
                          onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                          <i class="nav-icon fas fa-sign-out-alt"></i>
                          <p>
                              {{ __('Logout') }}
                          </p>
                      </a>
                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                          @csrf
                      </form>
                      {{-- </form> --}}
                  </li>

              </ul>
          </nav>
          <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
  </aside>
