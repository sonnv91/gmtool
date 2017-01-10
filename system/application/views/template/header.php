<header class="main-header">
    <!-- Logo -->
    <a href="javascript:;" class="logo"><b>AutoVL</b><?php echo "(".$this->session->userdata("server_remote").")";?></a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="<?php echo base_url();?>public/temp/dist/img/user3-128x128.jpg" class="user-image" alt="User Image"/>
                        <span class="hidden-xs"><?php echo $this->session->userdata("username");?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="<?php echo base_url();?>public/temp/dist/img/user3-128x128.jpg" class="img-circle" alt="User Image" />
                            <p>
                                <?php echo $this->session->userdata("username");?>
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-right">
                                <a href="<?php echo base_url();?>user/logout" class="btn btn-default btn-flat">Sign out</a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>