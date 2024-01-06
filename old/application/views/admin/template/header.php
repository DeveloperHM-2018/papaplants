<div id="header-fix" class="header fixed-top">
    <div class="site-width">
        <nav class="navbar navbar-expand-lg  p-0">
            <div class="navbar-header  h-100 h4 mb-0 align-self-center logo-bar text-left" style="padding: 0 15px !important">
                <a href="#" class="horizontal-logo text-left">
                    <img src="<?= base_url() ?>assets/admin/images/papaplants_logo_2.jpg" style="width: 130px; padding: 10px;">
                    </g>
                    </svg>
                    <!-- <span class="h4 font-weight-bold align-self-center mb-0 ml-auto"></span>               -->
                </a>
            </div>
            <div class="navbar-header h4 mb-0 text-center h-100 collapse-menu-bar">
                <a href="#" class="sidebarCollapse" id="collapse"><i class="icon-menu"></i></a>
            </div>
            <div class="navbar-right ml-auto h-100">
                <ul class="ml-auto p-0 m-0 list-unstyled d-flex top-icon h-100">
                    <li class="dropdown user-profile align-self-center d-inline-block">
                        <a href="#" class="nav-link py-0" data-toggle="dropdown" aria-expanded="false">
                            <div class="media">
                                <img src="<?= base_url() ?>assets/user-512.webp" alt="" class="d-flex img-fluid rounded-circle" width="29">Welcome Admin
                            </div>
                        </a>
                        <div class="dropdown-menu border dropdown-menu-right p-0">
                            <a href="<?= base_url('logout') ?>" class="dropdown-item px-2 text-danger align-self-center d-flex">
                                <span class="icon-logout mr-2 h6  mb-0"></span> Sign Out</a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>
