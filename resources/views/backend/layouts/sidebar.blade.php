<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('admin.index')}}" class="brand-link">
        <img src="{{asset('assets/logo.jpg')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Admin Page</span>
    </a>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
                <a href="{{route('admin.manufacturer.index')}}" class="nav-link">
                    icon
                    <p>
                        Manufacturer
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{route('admin.console.index')}}" class="nav-link">
                    icon
                    <p>
                        Console
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{route('admin.genre.index')}}" class="nav-link">
                    icon
                    <p>
                        Genre
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{route('admin.reportIndex')}}" class="nav-link">
                    icon
                    <p>
                       Game Reports
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{route('admin.user_report')}}" class="nav-link">
                    icon
                    <p>
                       User Reports
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{route('admin.viewBanUsers')}}" class="nav-link">
                    icon
                    <p>
                       Banned Users
                    </p>
                </a>
            </li>
          
          


    </nav>
</aside>