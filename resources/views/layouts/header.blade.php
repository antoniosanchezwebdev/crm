<div class="topbar">

    <!-- LOGO -->
    <div class="topbar-left">
        <a href="{{ route('home') }}" class="logo">
            <span class="logo-light">
                <img class="img-fluid p-4" src="{{ asset('images/logo.png') }}" alt="Logo Neumalgex">
                {{-- <i class="mdi mdi-camera-control"></i> Neumalgex --}}
            </span>
            <span class="logo-sm">
                <i class="mdi mdi-camera-control"></i>
            </span>
        </a>
    </div>

    <nav class="navbar-custom">
        <ul class="navbar-right list-inline float-right mb-0">

            <!-- language-->
            {{-- <li class="dropdown notification-list list-inline-item d-none d-md-inline-block">
                        <a class="nav-link dropdown-toggle arrow-none waves-effect" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                            <img src="http://127.0.0.1:8000/assets/images/flags/us_flag.jpg" class="mr-2" height="12" alt="" /> English <span class="mdi mdi-chevron-down"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated language-switch">
                            <a class="dropdown-item" href="#"><img src="http://127.0.0.1:8000/assets/images/flags/french_flag.jpg" alt="" height="16" /><span> French </span></a>
                            <a class="dropdown-item" href="#"><img src="http://127.0.0.1:8000/assets/images/flags/spain_flag.jpg" alt="" height="16" /><span> Spanish </span></a>
                            <a class="dropdown-item" href="#"><img src="http://127.0.0.1:8000/assets/images/flags/russia_flag.jpg" alt="" height="16" /><span> Russian </span></a>
                            <a class="dropdown-item" href="#"><img src="http://127.0.0.1:8000/assets/images/flags/germany_flag.jpg" alt="" height="16" /><span> German </span></a>
                            <a class="dropdown-item" href="#"><img src="http://127.0.0.1:8000/assets/images/flags/italy_flag.jpg" alt="" height="16" /><span> Italian </span></a>
                        </div>
                    </li> --}}

            <!-- full screen -->
            <li class="dropdown notification-list list-inline-item d-none d-md-inline-block">
                <a class="nav-link waves-effect" href="#" id="btn-fullscreen">
                    <i class="mdi mdi-arrow-expand-all noti-icon"></i>
                </a>
            </li>

            <!-- notification -->
            <li class="dropdown notification-list list-inline-item">
                <a class="nav-link dropdown-toggle arrow-none waves-effect" data-toggle="dropdown" href="#"
                    role="button" aria-haspopup="false" aria-expanded="false">
                    <i class="mdi mdi-bell-outline noti-icon"></i>
                    <span class="badge badge-pill badge-danger noti-icon-badge">{{$alertasPendientes}}</span>
                </a>
                @if ($alertasPendientes > 0)
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated dropdown-menu-lg px-1">
                        <!-- item-->
                        <h6 class="dropdown-item-text">
                            Notifications
                        </h6>

                        <div class="slimscroll notification-item-list">
                            <!-- item-->
                            @livewire('lista-alertas')
                        </div>


                    </div>
                @else
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated dropdown-menu-lg px-1">
                        <!-- item-->
                        <h6 class="dropdown-item-text">
                            No tienes notificaciones
                        </h6>
                    </div>
                @endif
            </li>

            <li class="dropdown notification-list list-inline-item">
                <div class="dropdown notification-list nav-pro-img">
                    <a class="dropdown-toggle nav-link arrow-none nav-user" data-toggle="dropdown" href="#"
                        role="button" aria-haspopup="false" aria-expanded="false">
                        <img src="http://127.0.0.1:8000/assets/images/users/user-4.jpg" alt="user"
                            class="rounded-circle">
                    </a>
                    <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                        <h6 class="dropdown-item-text"><b> {{ Auth::user()->name }} {{ Auth::user()->surname }}</b>
                        </h6>
                        <!-- item-->
                        {{-- <a class="dropdown-item" href="#"><i class="mdi mdi-account-circle"></i>Perfil</a>
                        <a class="dropdown-item d-block" href="#"><span
                                class="badge badge-success float-right">11</span><i class="mdi mdi-settings"></i>
                            Settings</a>
                        <a class="dropdown-item" href="#"><i class="mdi mdi-lock-open-outline"></i> Lock
                            screen</a> --}}
                        <div class="dropdown-divider"></div>

                        {{-- Formulario invisible para que Laravel detecte el cierre de sesión como POST. --}}
                        @auth
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        @endauth

                        {{-- El mismo enlace, con un evento onclick para que haga submit del formulario y cierre sesión.  --}}
                        <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                            onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i
                                class="mdi mdi-power text-danger"></i>Cerrar sesión</a>
                    </div>
                </div>
            </li>

        </ul>

        <ul class="list-inline menu-left mb-0">
            <li class="float-left">
                <button class="button-menu-mobile open-left waves-effect">
                    <i class="mdi mdi-menu"></i>
                </button>
            </li>
            {{-- <li class="d-none d-md-inline-block">
                        <form role="search" class="app-search">
                            <div class="form-group mb-0">
                                <input type="text" class="form-control" placeholder="Search..">
                                <button type="submit"><i class="fa fa-search"></i></button>
                            </div>
                        </form>
                    </li> --}}
        </ul>

    </nav>

</div>
<!-- Top Bar End -->
