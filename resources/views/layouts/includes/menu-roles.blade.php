@php
$auth = auth()->user();
$authRole = $auth->roles[0]?->name;
@endphp
@if ($authRole == \App\Constants\RoleConst::SUPER_ADMIN)
<ul class="menu-inner py-1">
    <li class="menu-item {{ Route::currentRouteName() == 'web.dashboard' ? 'active' : null }}">
        <a href="{{ url('/dashboard') }}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-home-circle"></i>
            <div data-i18n="Analytics">Beranda</div>
        </a>
    </li>

    <li class="menu-header small text-uppercase"><span class="menu-header-text">Manajemen</span></li>
    <!-- Cards -->
    <li class="menu-item">
        <a href="cards-basic.html" class="menu-link">
            <i class="menu-icon tf-icons bx bx-user"></i>
            <div data-i18n="Basic">Pengguna</div>
        </a>
    </li>
    <li class="menu-item">
        <a href="cards-basic.html" class="menu-link">
            <i class="menu-icon tf-icons bx bx-buildings"></i>  
            <div data-i18n="Basic">Asrama</div>
        </a>
    </li>
    <li class="menu-item">
        <a href="cards-basic.html" class="menu-link">
            <i class="menu-icon tf-icons bx bx-home-circle"></i>
            <div data-i18n="Basic">Rooms</div>
        </a>
    </li>
    <li class="menu-item">
        <a href="cards-basic.html" class="menu-link">
            <i class="menu-icon tf-icons bx bx-wifi"></i>
            <div data-i18n="Basic">Fasilitas</div>
        </a>
    </li>
    
    <li class="menu-item">
        <a href="cards-basic.html" class="menu-link">
            <i class="menu-icon tf-icons bx bx-location-plus"></i>
            <div data-i18n="Basic">Lokasi</div>
        </a>
    </li>

    <li class="menu-header small text-uppercase"><span class="menu-header-text">Pengelolaan</span></li>

    <li class="menu-item">
        <a href="cards-basic.html" class="menu-link">
            <i class="menu-icon tf-icons bx bx-home-circle"></i>
            <div data-i18n="Basic">Pesanan</div>
        </a>
    </li>

</ul>
@elseif ($authRole == \App\Constants\RoleConst::STUDENT)
<ul class="menu-inner py-1">
    <li class="menu-item {{ Route::currentRouteName() == 'web.dashboard' ? 'active' : null }}">
        <a href="{{ url('/dashboard') }}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-home-circle"></i>
            <div data-i18n="Analytics">Beranda</div>
        </a>
    </li>
</ul>
@else
<ul class="menu-inner py-1">
    <li class="menu-item {{ Route::currentRouteName() == 'web.dashboard' ? 'active' : null }}">
        <a href="{{ url('/dashboard') }}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-home-circle"></i>
            <div data-i18n="Analytics">Beranda</div>
        </a>
    </li>
</ul>
@endif