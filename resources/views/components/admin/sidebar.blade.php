<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="/css/adminlte/img/user2-160x160.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ Auth::user()->profile->full_name }}</p>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">MENU</li>
            <li class="active">
                <a href="/home"><i class="fa fa-tachometer"></i><span> Dashboard</span></a>
            </li>
            <li>
                <a href="/admin/users"><i class="fa fa-users"></i><span> Users</span></a>
            </li>

        </ul>
    </section>
</aside>