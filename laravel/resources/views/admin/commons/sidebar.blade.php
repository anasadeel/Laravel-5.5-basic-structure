<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('front/images/noimage.jpg')}}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ Auth::user()->firstName }} {{ Auth::user()->lastName }}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>


            <!-- Optionally, you can add icons to the links -->
            <!-- Admin Links Start-->
            <?php if (Auth::user()->role->code == 'admin') { ?>
                <li>
                    <a href="{{ url('admin/dashboard') }}">
                        <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                    </a>
                </li>
                <li class="treeview">
                    <a href="{{ url('admin/users') }}">
                        <i class="fa fa-user"></i> <span>Users</span> <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{ url('admin/users') }}"><i class="fa fa-circle-o"></i> <span>List Users</span></a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-th-large"></i> <span>Content Blocks</span> <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu" style="display: none;">
                        <li><a href="{{ url('admin/content?type=page') }}"><i class="fa fa-circle-o"></i> Pages</a></li>
    <!--                        <li><a href="{{ url('admin/content?type=email') }}"><i class="fa fa-circle-o"></i> Emails</a></li>
                        <li><a href="{{ url('admin/content?type=block') }}"><i class="fa fa-circle-o"></i> Blocks</a></li>-->
                    </ul>
                </li>

<!--                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-phone"></i> <span>Contact Us</span> <i class="fa fa-angle-left pull-right"></i>
                        </a> 
                        <ul class="treeview-menu" style="display: none;">
                            <li><a href="{{ url('admin/contact-us') }}"><i class="fa fa-circle-o"></i> List Contacts</a></li>
                        </ul>

                    </li>-->

            <?php } ?>
            <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
