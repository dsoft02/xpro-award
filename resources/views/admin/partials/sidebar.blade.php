<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ Auth::user()->profile_picture_url }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ ucwords(Auth::user()->name) }}</p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">Main Menu</li>
            <!-- Optionally, you can add icons to the links -->
            <li class="{{ isActiveRoute('admin.dashboard') }}"><a href="{{ route('admin.dashboard') }}"><i
                        class="fa fa-home"></i> <span>Dashboard</span></a></li>

            <li class="{{ isActiveRoute(['admin.categories.index','admin.categories.create','admin.categories.edit']) }}">
                <a href="{{ route('admin.categories.index') }}">
                    <i class="fa fa-briefcase"></i> <span>Category</span>
                </a>
            </li>

            <li class="{{ isActiveRoute(['admin.nominees.index','admin.nominees.create','admin.nominees.edit']) }}"><a
                    href="{{ route('admin.nominees.index') }}"><i
                        class="fa fa-users"></i> <span>Nominees</span></a></li>

            <li class="{{ isActiveRoute('admin.dashboard') }}"><a href="{{ route('admin.dashboard') }}"><i
                        class="fa fa-signal"></i> <span>Votes</span></a></li>

            <li class="{{ isActiveRoute('admin.dashboard') }}"><a href="{{ route('admin.dashboard') }}"><i
                        class="fa fa-trophy"></i> <span>Winners</span></a></li>

            <li class="{{ isActiveRoute('admin.settings.index') }}">
                <a href="{{ route('admin.settings.index') }}">
                    <i class="fa fa-cog"></i> <span>Settings</span>
                </a>
            </li>

            <li><a href="{{ route('applogout') }}"><i class="fa fa-sign-out"></i> <span>Logout</span></a></li>
        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
