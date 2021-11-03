<header class="topbar">
    <nav class="navbar top-navbar navbar-expand-md navbar-dark">
        <div class="navbar-header">
            <a class="navbar-brand" href="">
              <img src="<?php echo $this->config->item("admin_url");?>images/kart-logo.png" alt="homepage" style="height:65px;" />
             </a>
        </div>
        <div class="navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item"> <a class="nav-link nav-toggler d-block d-sm-none waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
                <li class="nav-item"> <a class="nav-link sidebartoggler d-none d-lg-block d-md-block waves-effect waves-dark" href="javascript:void(0)"><i class="icon-menu"></i></a> </li>
                <li class="nav-item"><a href="<?php echo base_url();?>" target="_blank" class="nav-link"><i class="icon-globe"></i></a></li>
            </ul>
            <ul class="navbar-nav my-lg-0">
                <li class="nav-item dropdown u-pro">
                    <a class="nav-link dropdown-toggle waves-effect waves-dark profile-pic" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="<?php echo $this->config->item("admin_url");?>images/users/1.jpg" alt="user" class=""> <span class="hidden-md-down"><?php echo $this->session->userdata("login_name");?>
                        <i class="fa fa-angle-down"></i></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right animated flipInY">
                        <a href="<?php echo bildourl("change-password"); ?>" class="dropdown-item"><i class="ti-settings"></i> Account Setting</a>
                        <a href="<?php echo bildourl("logout"); ?>" class="dropdown-item"><i class="fa fa-power-off"></i> Logout</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</header>