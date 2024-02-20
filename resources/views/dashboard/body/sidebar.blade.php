
<nav class="sidenav shadow-right sidenav-light">
    <div class="sidenav-menu">
        <div class="nav accordion" id="accordionSidenav">
            <!-- Sidenav Menu Heading (Core)-->
            <div class="sidenav-menu-heading">Core</div>
            <a class="nav-link {{ Request::is('dashboard*') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                <div class="nav-link-icon"><i data-feather="activity"></i></div>
                Dashboard
            </a>

            <!-- Sidenav Heading (Orders)-->
            <div class="sidenav-menu-heading">Orders</div>
            <a class="nav-link {{ Request::is('orders*') ? 'active' : '' }}" href="{{ route('orders.index') }}">
                <div class="nav-link-icon"><i class="fa-solid fa-users"></i></div>
                Orders
            </a>

            <!-- Sidenav Heading (Pages)-->
            <div class="sidenav-menu-heading">Pages</div>
            <a class="nav-link {{ Request::is('clients*') ? 'active' : '' }}" href="{{ route('clients.index') }}">
                <div class="nav-link-icon"><i class="fa-solid fa-users"></i></div>
                Clients
            </a>
            <a class="nav-link {{ Request::is('projects*') ? 'active' : '' }}" href="{{ route('projects.index') }}">
                <div class="nav-link-icon"><i class="fa-solid fa-users"></i></div>
                Project
            </a>
            <a class="nav-link {{ Request::is('serviceOfferings*') ? 'active' : '' }}" href="{{ route('serviceOfferings.index') }}">
                <div class="nav-link-icon"><i class="fa-solid fa-users"></i></div>
                Service Offerings
            </a>
            <a class="nav-link {{ Request::is('serviceRequests*') ? 'active' : '' }}" href="{{ route('serviceRequests.index') }}">
                <div class="nav-link-icon"><i class="fa-solid fa-users"></i></div>
                Service Requests
            </a>
            <a class="nav-link {{ Request::is('bills*') ? 'active' : '' }}" href="{{ route('bills.index') }}">
                <div class="nav-link-icon"><i class="fa-solid fa-users"></i></div>
                Bill
            </a>

            <!-- Sidenav Heading (Products)-->
            <div class="sidenav-menu-heading">Master</div>
            <a class="nav-link {{ Request::is('jobs*') ? 'active' : '' }}" href="{{ route('jobs.index') }}">
                <div class="nav-link-icon"><i class="fa-solid fa-boxes-stacked"></i></div>
                Jobs
            </a>
            <a class="nav-link {{ Request::is('jobTypes*') ? 'active' : '' }}" href="{{ route('jobTypes.index') }}">
                <div class="nav-link-icon"><i class="fa-solid fa-boxes-stacked"></i></div>
                Job Types
            </a>
            <a class="nav-link {{ Request::is('languages*') ? 'active' : '' }}" href="{{ route('languages.index') }}">
                <div class="nav-link-icon"><i class="fa-solid fa-folder"></i></div>
                Languages
            </a>
            <a class="nav-link {{ Request::is('companies*') ? 'active' : '' }}" href="{{ route('companies.index') }}">
                <div class="nav-link-icon"><i class="fa-solid fa-folder"></i></div>
                Companies
            </a>

            <!-- Sidenav Heading (Settings)-->
            <div class="sidenav-menu-heading">Settings</div>
            <a class="nav-link {{ Request::is('users*') ? 'active' : '' }}" href="{{ route('users.index') }}">
                <div class="nav-link-icon"><i class="fa-solid fa-users"></i></div>
                Users
            </a>
        </div>
    </div>

    <!-- Sidenav Footer-->
    <div class="sidenav-footer">
        <div class="sidenav-footer-content">
            <div class="sidenav-footer-subtitle">Logged in as:</div>
            <div class="sidenav-footer-title">{{ auth()->user()->name }}</div>
        </div>
    </div>
</nav>
