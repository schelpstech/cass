<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="../../app/router.php?pageid=<?php echo $utility->inputEncode('consultantDashboard'); ?>" class="brand-link">
        <img src="../../storage/app/ogun.png" alt="Church Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">OG-MoEST</span>
    </a>

    <div class="sidebar">

        <!-- User Panel -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="../../storage/app/consultant.png" class="img-box elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block"><?php echo htmlspecialchars($_SESSION['active'], ENT_QUOTES, 'UTF-8'); ?></a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <!-- Dashboard -->
                <li class="nav-item <?php echo ($pageId === 'consultantDashboard') ? 'menu-open' : ''; ?>">
                    <a href="../../app/router.php?pageid=<?php echo $utility->inputEncode('consultantDashboard'); ?>" class="nav-link <?php echo ($pageId === 'consultantDashboard') ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-stream"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <!-- Clearance -->
                <li class="nav-item <?php echo in_array($pageId, ['capturingRecord', 'transactionHistories']) ? 'menu-open' : 'menu-close'; ?>">
                    <a href="#" class="nav-link">
                        <i class="nav-icon far fa-address-card"></i>
                        <p>
                            Clearance
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="../../app/router.php?pageid=<?php echo $utility->inputEncode('capturingRecord'); ?>" class="nav-link <?php echo ($pageId === 'capturingRecord') ? 'active' : ''; ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Process Clearance</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../../app/router.php?pageid=<?php echo $utility->inputEncode('transactionHistories'); ?>" class="nav-link <?php echo ($pageId === 'transactionHistories') ? 'active' : ''; ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Transaction History</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Report -->
                <li class="nav-item <?php echo in_array($pageId, ['schoolsAllocatedList', 'dutyPost_manager']) ? 'menu-open' : 'menu-close'; ?>">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-sitemap"></i>
                        <p>
                            Report
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="../../app/router.php?pageid=<?php echo $utility->inputEncode('schoolsAllocatedList'); ?>" class="nav-link <?php echo ($pageId === 'schoolsAllocatedList') ? 'active' : ''; ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Allocated Schools</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../../app/router.php?pageid=<?php echo $utility->inputEncode('dutyPost_manager'); ?>" class="nav-link <?php echo ($pageId === 'dutyPost_manager') ? 'active' : ''; ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Clearance Summary</p>
                            </a>
                        </li>
                    </ul>
                </li>

            </ul>
        </nav>

    </div>
</aside>
