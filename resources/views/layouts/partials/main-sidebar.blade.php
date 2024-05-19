<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="index3.html" class="brand-link">
      <img src="{{asset('assets/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">{{ Auth::user()->name }}</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
      <div class="form-inline">
          <div class="input-group" data-widget="sidebar-search">
              <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                  <button class="btn btn-sidebar">
                      <i class="fas fa-search fa-fw"></i>
                  </button>
              </div>
          </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
              <!-- Dashboard -->
              @if (Auth::user()->role == 'admin')
              <li class="nav-item">
                  <a href="#" class="nav-link active">
                      <i class="nav-icon fas fa-tachometer-alt"></i>
                      <p>
                        Admin Dashboard
                          <i class="right fas fa-angle-left"></i>
                      </p>
                  </a>
                  <ul class="nav nav-treeview">
                      <li class="nav-item">
                          <a href="{{route('admin.dashboard')}}" class="nav-link">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Dashboard</p>
                          </a>
                      </li>
                      <li class="nav-item">
                          <a href="{{route('admin.users')}}" class="nav-link">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Users</p>
                          </a>
                      </li>
                      <li class="nav-item">
                          <a href="{{route('admin.vehicles')}}" class="nav-link">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Vehicles</p>
                          </a>
                      </li>
                      <li class="nav-item">
                          <a href="{{route('admin.show-clients')}}" class="nav-link">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Clients</p>
                          </a>
                      </li>
                      <li class="nav-item">
                          <a href="{{route('admin.show-mechanics')}}" class="nav-link">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Mechanics</p>
                          </a>
                      </li>
                      <li class="nav-item">
                          <a href="{{route('admin.show-repair')}}" class="nav-link">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Repairs</p>
                          </a>
                      </li>
                      <li class="nav-item">
                          <a href="{{route('admin.show-parts')}}" class="nav-link">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Parts</p>
                          </a>
                      </li>
                      <li class="nav-item">
                          <a href="{{route('admin.show-invoices')}}" class="nav-link">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Invoices</p>
                          </a>
                      </li>
                      <li class="nav-item">
                          <a href="{{route('admin.show-appointments')}}" class="nav-link">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Appointments</p>
                          </a>
                      </li>
                  </ul>
              </li>
              @endif
              @if (Auth::user()->role == 'client')
              <li class="nav-item">
                <a href="#" class="nav-link active">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                      Client Dashboard
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{route('client.dashboard')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                </ul>
              
              @endif
              @if(Auth::user()->role == 'mechanic')
              <li class="nav-item">
                <a href="#" class="nav-link active">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                      Client Dashboard
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{route('mechanic.dashboard')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                </ul>
                @endif
              <li class="nav-item">
                  <a href="{{route('logout.perform')}}" class="nav-link">
                      <i class="nav-icon fas fa-sign-out-alt"></i>
                      <p>
                        Logout
                      </p>
                  </a>
              </li>
          </ul>
      </nav>
      <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
