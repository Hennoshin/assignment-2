<!-- Navbar -->
<nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
id="layout-navbar">
<div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">

    <!-- Search -->
    <div class="navbar-nav align-items-center">
        <div class="nav-item d-flex align-items-center">
            <i class="bx bxl-bing mb-2"></i>
            <span class="app-brand-text demo menu-text fw-bolder ms-2">BOOK IT</span>
        </div>
    </div>
    <!-- /Search -->

    <ul class="navbar-nav flex-row align-items-center ms-auto">
        <!-- Place this tag where you want the button to render. -->
        <li class="nav-item dropdown lh-1 me-3">
            <a class="nav-link dropdown-toggle navbar-brand" href="javascript:void(0)" id="navbarDropdown"
                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Cari Asrama
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="javascript:void(0)"><i class='bx bxs-building'></i> ASRAMA A</a></li>
                <li><a class="dropdown-item" href="javascript:void(0)"><i class='bx bxs-building'></i> ASRAMA B</a></li>
                <li><a class="dropdown-item" href="javascript:void(0)"><i class='bx bxs-building'></i> ASRAMA C</a></li>
                <li><a class="dropdown-item" href="javascript:void(0)"><i class='bx bxs-building'></i> ASRAMA D</a></li>
            </ul>
            {{-- <a href="#" class="navbar-brand">Cari Asrama</a> --}}
        </li>

        <li class="nav-item lh-1 me-3">
            <a href="#" class="navbar-brand">Pusat Bantuan</a>
        </li>

        <li class="nav-item lh-1 me-3">
            <a href="#" class="navbar-brand">Syarat dan Ketentuan</a>
        </li>
        <!-- User -->
        <li class="nav-item navbar-dropdown dropdown-user dropdown">
            <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);"
                data-bs-toggle="dropdown">
                <div class="avatar avatar-online">
                    <img src="../assets/img/avatars/1.png" alt
                        class="w-px-40 h-auto rounded-circle">
                </div>
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
                <li>
                    <a class="dropdown-item" href="#">
                        <div class="d-flex">
                            <div class="flex-shrink-0 me-3">
                                <div class="avatar avatar-online">
                                    <img src="../assets/img/avatars/1.png" alt
                                        class="w-px-40 h-auto rounded-circle">
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <span class="fw-semibold d-block">John Doe</span>
                                <small class="text-muted">Admin</small>
                            </div>
                        </div>
                    </a>
                </li>
                <li>
                    <div class="dropdown-divider"></div>
                </li>
                <li>
                    <a class="dropdown-item" href="#">
                        <i class="bx bx-user me-2"></i>
                        <span class="align-middle">My Profile</span>
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" href="#">
                        <i class="bx bx-cog me-2"></i>
                        <span class="align-middle">Settings</span>
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" href="#">
                        <span class="d-flex align-items-center align-middle">
                            <i class="flex-shrink-0 bx bx-credit-card me-2"></i>
                            <span class="flex-grow-1 align-middle">Billing</span>
                            <span
                                class="flex-shrink-0 badge badge-center rounded-pill bg-danger w-px-20 h-px-20">4</span>
                        </span>
                    </a>
                </li>
                <li>
                    <div class="dropdown-divider"></div>
                </li>
                <li>
                    <a class="dropdown-item" href="auth-login-basic.html">
                        <i class="bx bx-power-off me-2"></i>
                        <span class="align-middle">Log Out</span>
                    </a>
                </li>
            </ul>
        </li>
        <!--/ User -->
    </ul>
</div>
</nav>
<!-- / Navbar -->