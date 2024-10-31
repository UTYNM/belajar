<div class="left-side-menu">

    <div class="h-100" data-simplebar>

        <!-- User box -->
        <div class="user-box text-center">
            <img src="{{ asset('backend/assets/images/users/avatar-1.jpg') }}" alt="user-img" title="Mat Helme"
                class="rounded-circle avatar-md">
            <div class="dropdown">
                <a href="javascript: void(0);" class="text-dark dropdown-toggle h5 mt-2 mb-1 d-block"
                    data-bs-toggle="dropdown">Nik Patel</a>
                <div class="dropdown-menu user-pro-dropdown">

                    <a href="pages-profile.html" class="dropdown-item notify-item">
                        <i data-feather="user" class="icon-dual icon-xs me-1"></i><span>My Account</span>
                    </a>
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i data-feather="settings" class="icon-dual icon-xs me-1"></i><span>Settings</span>
                    </a>
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i data-feather="help-circle" class="icon-dual icon-xs me-1"></i><span>Support</span>
                    </a>
                    <a href="pages-lock-screen.html" class="dropdown-item notify-item">
                        <i data-feather="lock" class="icon-dual icon-xs me-1"></i><span>Lock Screen</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i data-feather="log-out" class="icon-dual icon-xs me-1"></i><span>Logout</span>
                    </a>

                </div>
            </div>
            <p class="text-muted">Admin Head</p>
        </div>

        <!--- Sidemenu -->
        <div id="sidebar-menu">

            <ul id="side-menu">

                <!-- <li class="menu-title">Navigation</li> -->

                <li>
                    <a href="#sidebarDashboard" data-bs-toggle="collapse">
                        <span class="badge bg-success float-end">02</span>
                        <i data-feather="home"></i>
                        <span> Dashboards </span>
                        <!-- <span class="menu-arrow"></span> -->
                    </a>
                </li>
                <li class="menu-title mt-2">BELAJAR CRUD</li>
                <li>
                    <a href="{{ url('operator') }}">
                        <i data-feather="user"></i>
                        <span> Operator </span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('opd') }}">
                        <i data-feather="message-square"></i>
                        <span> Organisasi Pemerintah Daerah </span>
                    </a>
                </li>
                <li class="menu-title mt-2">POST API</li>
                <li>
                    <a href="{{ url('youtube') }}">
                        <i data-feather="video"></i>
                        <span> Youtube </span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('twitter') }}">
                        <i data-feather="video"></i>
                        <span> Twitter </span>
                    </a>
                </li>
            </ul>
            </ul>
        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>
