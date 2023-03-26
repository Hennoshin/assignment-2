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
        <li
            class="menu-item {{ Route::currentRouteName() == 'web.attendence.index' || Route::currentRouteName() == 'web.attendence.create' || Route::currentRouteName() == 'web.attendence.edit' ? 'active' : null }}">
            <a href="{{ route('web.attendence.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-briefcase"></i>
                <div data-i18n="Analytics">Presensi</div>
            </a>
        </li>
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Apps</span>
        </li>
        <li
            class="menu-item {{ Route::currentRouteName() == 'web.employees.index' || Route::currentRouteName() == 'web.employees.create' || Route::currentRouteName() == 'web.employees.edit' ? 'active' : null }}">
            <a href="{{ route('web.employees.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bxs-user-pin"></i>
                <div data-i18n="Analytics">Pegawai</div>
            </a>
        </li>
        <li
            class="menu-item {{ Route::currentRouteName() == 'web.salaries.index' || Route::currentRouteName() == 'web.salaries.create' || Route::currentRouteName() == 'web.salaries.edit' ? 'active' : null }}">
            <a href="{{ route('web.salaries.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bxs-credit-card"></i>
                <div data-i18n="Analytics">Gaji</div>
            </a>
        </li>
        <li
            class="menu-item {{ Route::currentRouteName() == 'web.rewards.index' || Route::currentRouteName() == 'web.rewards.create' || Route::currentRouteName() == 'web.rewards.edit' ? 'active' : null }}">
            <a href="{{ route('web.rewards.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-gift"></i>
                <div data-i18n="Analytics"><small>Paket Makanan Karyawan</small></div>
            </a>
        </li>
        <li
            class="menu-item {{ Route::currentRouteName() == 'web.paid-leaves.index' || Route::currentRouteName() == 'web.paid-leaves.create' || Route::currentRouteName() == 'web.paid-leaves.edit' ? 'active' : null }}">
            <a href="{{ route('web.paid-leaves.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bxs-plane-take-off"></i>
                <div data-i18n="Analytics">Cuti & Ijin</div>
            </a>
        </li>
        <li
            class="menu-item {{ Route::currentRouteName() == 'web.overtime.index' || Route::currentRouteName() == 'web.overtime.create' || Route::currentRouteName() == 'web.overtime.edit' ? 'active' : null }}">
            <a href="{{ route('web.overtime.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bxs-time"></i>
                <div data-i18n="Analytics">Lemburan</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="#" class="menu-link">
                <i class="menu-icon tf-icons bx bx-bar-chart-alt-2"></i>
                <div data-i18n="Analytics">Laporan</div>
            </a>
        </li>


        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Settings</span>
        </li>

        <li
            class="menu-item {{ Route::currentRouteName() == 'web.informations.index' || Route::currentRouteName() == 'web.informations.create' || Route::currentRouteName() == 'web.informations.edit' ? 'active' : null }}">
            <a href="{{ route('web.informations.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bxs-user-voice"></i>
                <div data-i18n="Analytics">Manajemen Informasi</div>
            </a>
        </li>

        <li
            class="menu-item {{ Route::currentRouteName() == 'web.users.index' || Route::currentRouteName() == 'web.users.create' || Route::currentRouteName() == 'web.users.edit' ? 'active' : null }}">
            <a href="{{ route('web.users.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bxs-user-account"></i>
                <div data-i18n="Analytics">Manajemen Users</div>
            </a>
        </li>

        <li
            class="menu-item {{ Route::currentRouteName() == 'web.unit-kerja.index' || Route::currentRouteName() == 'web.unit-kerja.create' || Route::currentRouteName() == 'web.unit-kerja.edit' ? 'active' : null }}">
            <a href="{{ route('web.unit-kerja.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-network-chart"></i>
                <div data-i18n="Analytics">Unit Kerja</div>
            </a>
        </li>

        <li
            class="menu-item {{ Route::currentRouteName() == 'web.reward-type.index' || Route::currentRouteName() == 'web.reward-type.create' || Route::currentRouteName() == 'web.reward-type.edit' ? 'active' : null }}">
            <a href="{{ route('web.reward-type.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bxs-magic-wand"></i>
                <div data-i18n="Analytics">Tipe Reward</div>
            </a>
        </li>

        <li
            class="menu-item {{ Route::currentRouteName() == 'web.settings.index' ? 'active' : null }}">
            <a href="{{ route('web.settings.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-cog"></i>
                <div data-i18n="Analytics">Settings</div>
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
        <li
            class="menu-item {{ Route::currentRouteName() == 'web.attendence.index' || Route::currentRouteName() == 'web.attendence.create' || Route::currentRouteName() == 'web.attendence.edit' ? 'active' : null }}">
            <a href="{{ route('web.attendence.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-briefcase"></i>
                <div data-i18n="Analytics">Presensi</div>
            </a>
        </li>
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Apps</span>
        </li>
        <li
            class="menu-item {{ Route::currentRouteName() == 'web.paid-leaves.index' || Route::currentRouteName() == 'web.paid-leaves.create' || Route::currentRouteName() == 'web.paid-leaves.edit' ? 'active' : null }}">
            <a href="{{ route('web.paid-leaves.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bxs-plane-take-off"></i>
                <div data-i18n="Analytics">Cuti & Ijin</div>
            </a>
        </li>
        <li
            class="menu-item {{ Route::currentRouteName() == 'web.overtime.index' || Route::currentRouteName() == 'web.overtime.create' || Route::currentRouteName() == 'web.overtime.edit' ? 'active' : null }}">
            <a href="{{ route('web.overtime.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bxs-time"></i>
                <div data-i18n="Analytics">Lemburan</div>
            </a>
        </li>
        <li
            class="menu-item {{ Route::currentRouteName() == 'web.salaries.index' || Route::currentRouteName() == 'web.salaries.create' || Route::currentRouteName() == 'web.salaries.edit' ? 'active' : null }}">
            <a href="{{ route('web.salaries.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bxs-credit-card"></i>
                <div data-i18n="Analytics">Gaji</div>
            </a>
        </li>
        <li
            class="menu-item {{ Route::currentRouteName() == 'web.rewards.index' || Route::currentRouteName() == 'web.rewards.create' || Route::currentRouteName() == 'web.rewards.edit' ? 'active' : null }}">
            <a href="{{ route('web.rewards.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-gift"></i>
                <div data-i18n="Analytics"><small>Paket Makanan Karyawan</small></div>
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
