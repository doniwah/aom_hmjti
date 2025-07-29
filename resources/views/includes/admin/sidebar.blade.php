@php
    $urlSegment2 = request()->segment(2);
    $urlSegment3 = request()->segment(3);
@endphp
<nav id="sidebar" aria-label="Main Navigation">
    <!-- Side Header -->
    <div class="content-header">
        <!-- Logo -->
        <a class="fw-semibold text-dual" href="{{ route('admin.dashboard') }}">
            <span class="smini-visible">
                <i class="fa fa-circle-notch text-primary"></i>
            </span>
            <span class="smini-hide fs-5 tracking-wider">Art Of Manunggalan 10</span>
        </a>
        <!-- END Logo -->
    </div>
    <!-- END Side Header -->

    <!-- Sidebar Scrolling -->
    <div class="js-sidebar-scroll">
        <!-- Side Navigation -->
        <div class="content-side">
            <ul class="nav-main">
                <li class="nav-main-item">
                    <a class="nav-main-link {{ Request::is('admin/dashboard') ? 'active' : '' }}"
                        href="{{ route('admin.dashboard') }}">
                        <i class="nav-main-link-icon si si-speedometer"></i>
                        <span class="nav-main-link-name">Dashboard</span>
                    </a>
                </li>
                <li class="nav-main-heading">User Interface</li>
                <li class="nav-main-item">
                    <a class="nav-main-link {{ request()->is('admin/Penonton*') ? 'active' : '' }}"
                        href="{{ route('index.penonton') }} ">
                        <i class="nav-main-link-icon si si-users"></i>
                        <span class="nav-main-link-name">Data Penonton</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link {{ request()->is('admin/presence*') ? 'active' : '' }} "
                        href="{{ route('admin.presence') }} ">
                        <i class="nav-main-link-icon fa fa-barcode"></i>
                        <span class="nav-main-link-name">Kehadiran</span>
                    </a>
                </li>
                 <li class="nav-main-item">
                    <a class="nav-main-link {{ request()->is('admin/OfflineTicketing*') ? 'active' : '' }}"
                        href="{{ route('index.ticketing') }} ">
                        <i class="nav-main-link-icon fa fa-address-book"></i>
                        <span class="nav-main-link-name">Offline Ticketing</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link {{ request()->is('admin/sponsorship*') ? 'active' : '' }}"
                        href="{{ route('admin.sponsorship') }} ">
                        <i class="nav-main-link-icon fa-solid fa-handshake"></i>
                        <span class="nav-main-link-name">sponsorsip</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link {{ request()->is('admin/medpart*') ? 'active' : '' }}"
                        href="{{ route('admin.medpart') }} ">
                        <i class="nav-main-link-icon fa-solid fa-newspaper"></i>
                        <span class="nav-main-link-name">medpart</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link  {{ request()->is('admin/Ticket*') ? 'active' : '' }}"
                        href="{{ route('Ticket.index') }}">
                        <i class="nav-main-link-icon fa-solid fa-ticket"></i>
                        <span class="nav-main-link-name">ticket</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link  {{ request()->is('admin/Postingan*') ? 'active' : '' }}"
                        href="{{ route('Postingan.index') }}">
                        <i class="nav-main-link-icon fa-solid fa-ticket"></i>
                        <span class="nav-main-link-name">postingan</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link {{ request()->is('admin/Voucher*') ? 'active' : '' }} " href="{{ route('Voucher.index') }}">
                        <i class="nav-main-link-icon fa-solid fa-tags"></i>
                        <span class="nav-main-link-name">voucher</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link {{ request()->is('admin/Laporan*') ? 'active' : '' }}"k" href="{{ route('Laporan.index') }}">
                        <i class="nav-main-link-icon fa-solid fa-book-open"></i>
                        <span class="nav-main-link-name">laporan</span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- END Side Navigation -->
    </div>
    <!-- END Sidebar Scrolling -->
</nav>
<!-- END Sidebar -->

{{-- <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.dashboard') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-clipboard-list"></i>
        </div>
        <div class="sidebar-brand-text mx-3">E-TICKET</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Pages Collapse Menu -->
    <li
        class="nav-item {{ !$urlSegment2 || $urlSegment2 == 'viewers' || $urlSegment2 == 'participants' || $urlSegment2 == 'dashboard' ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseDashboard"
            aria-expanded="true" aria-controls="collapseDashboard">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
        <div id="collapseDashboard"
            class="collapse  {{ $urlSegment2 == 'viewers' || $urlSegment2 == 'participants' || $urlSegment2 == 'dashboard' ? 'show' : '' }}"
            aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item {{ $urlSegment2 == 'participants' ? 'active' : '' }} {{ $urlSegment3 == 'participants' && $urlSegment2 == 'dashboard' ? 'active' : '' }}"
                    href="{{ route('admin.dashboard', 'participants') }} ">Peserta</a>
                <a class="collapse-item {{ $urlSegment2 == 'viewers' ? 'active' : '' }} {{ $urlSegment3 == 'viewers' && $urlSegment2 == 'dashboard' ? 'active' : '' }}"
                    href="{{ route('admin.dashboard', 'viewers') }}">Penonton</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Menu
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item {{ $urlSegment2 == 'users' ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne"
            aria-expanded="true" aria-controls="collapseOne">
            <i class="fas fa-fw fa-users"></i>
            <span>Pendaftar</span>
        </a>
        <div id="collapseOne" class="collapse  {{ $urlSegment2 == 'users' ? 'show' : '' }}"
            aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item {{ $urlSegment2 == 'users' && $urlSegment3 == 'participants' ? 'active' : '' }}"
                    href="{{ route('admin.users', 'participants') }}">Peserta</a>
                <a class="collapse-item {{ $urlSegment2 == 'users' && $urlSegment3 == 'viewers' ? 'active' : '' }}"
                    href="{{ route('admin.users', 'viewers') }}">Penonton</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item {{ $urlSegment2 == 'presence' ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-table"></i>
            <span>Scan Kehadiran</span>
        </a>
        <div id="collapseTwo" class="collapse {{ $urlSegment2 == 'presence' ? 'show' : '' }}"
            aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item {{ $urlSegment2 == 'presence' && $urlSegment3 == 'participants' ? 'active' : '' }}"
                    href="{{ route('admin.presence', 'participants') }}">Peserta</a>
                <a class="collapse-item {{ $urlSegment2 == 'presence' && $urlSegment3 == 'viewers' ? 'active' : '' }}"
                    href="{{ route('admin.presence', 'viewers') }}">Penonton</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Tables -->
    {{-- <li class="nav-item {{ $urlSegment2 == 'presence' ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.presence') }}">
            <i class="fas fa-fw fa-table"></i>
            <span>Scan Kehadiran</span></a>
    </li> --}}

{{-- <!-- Nav Item - Tables -->
    <li class="nav-item {{ $urlSegment2 == 'sponsorship' ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.sponsorship') }}">
            <i class="fas fa-fw fa-solar-panel"></i>
            <span>Sponsorships</span></a>
    </li>
    <li class="nav-item {{ $urlSegment2 == 'event' ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.event') }}">
            <i class="fas fa-fw fa-solar-panel"></i>
            <span>events</span></a>
    </li>
    <li class="nav-item {{ $urlSegment2 == 'medpart' ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.medpart') }}">
            <i class="fas fa-fw fa-solar-panel"></i>
            <span>medparts</span></a>
    </li>
    <li class="nav-item {{ $urlSegment2 == 'settings' ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.settings') }}">
            <i class="fas fa-fw fa-cogs"></i>
            <span>Pengaturan</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul> --}}
