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
