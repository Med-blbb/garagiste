<nav class="main-header navbar navbar-expand navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{route(auth()->user()->role . '.dashboard')}}" class="nav-link">{{__('Home')}}</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="#" class="nav-link">{{__('Contact')}}</a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Language dropdown -->
        <li class="nav-item dropdown">
            <!-- Language dropdown toggle -->
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownLanguage" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img src="{{ asset('assets/flags/' . app()->getLocale() . '.png') }}" alt="{{ app()->getLocale() }}">
            </a>
            <!-- Language dropdown menu -->
            <div class="dropdown-menu" aria-labelledby="navbarDropdownLanguage">
                <!-- Language options -->
                @foreach(['en', 'fr', 'es', 'ar'] as $locale)
                    <a class="dropdown-item" href="{{ route('pages.changeLocale', ['locale' => $locale]) }}">
                        <img src="{{ asset('assets/flags/' . $locale . '.png') }}" alt="{{ $locale }}"> {{ ucfirst($locale) }}
                    </a>
                @endforeach
            </div>
        </li>

        <!-- Navbar search -->
        <li class="nav-item">
            <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                <i class="fas fa-search"></i>
            </a>
            <div class="navbar-search-block">
                <form class="form-inline">
                    <div class="input-group input-group-sm">
                        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-navbar" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                            <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </li>

        <!-- User authentication -->
        <li class="nav-item dropdown">
            <!-- Guest view -->
            @guest
            <div class="text-end">
                <a href="{{ route('login.perform') }}" class="btn btn-outline-light me-2">{{__('Login')}}</a>
                <a href="{{ route('register.perform') }}" class="btn btn-warning">{{__('Sign-up')}}</a>
            </div>
            @endguest

            <!-- Authenticated view -->
            @auth
            <div class="nav-link text-end">
                {{auth()->user()->name}}
                <a href="{{ route('logout.perform') }}" class="btn btn-outline-dark me-2">{{__('Logout')}}</a>
            </div>
            @endauth
        </li>

        <!-- Notifications dropdown -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-bell"></i>
                <span class="badge badge-warning navbar-badge">15</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-item dropdown-header">15 Notifications</span>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-envelope mr-2"></i> 4 new messages
                    <span class="float-right text-muted text-sm">3 mins</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-users mr-2"></i> 8 friend requests
                    <span class="float-right text-muted text-sm">12 hours</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-file mr-2"></i> 3 new reports
                    <span class="float-right text-muted text-sm">2 days</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
            </div>
        </li>

        <!-- Fullscreen button -->
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>

        <!-- Control sidebar button -->
        <li class="nav-item">
            <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#" role="button">
                <i class="fas fa-th-large"></i>
            </a>
        </li>
    </ul>
</nav>
