        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="dashboard.php">
                <div class="sidebar-brand-text mx-3">ICMR-NIIRNCD Jodhpur</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="dashboard.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                View-Panel
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Website-Pages 'En'</span>
                </a>
                <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Name:</h6>
                        <!-- <a class="collapse-item" href="recruit.php?name=recruitment">Recruitment</a>
                        <a class="collapse-item" href="tender.php?name=tenders">Tenders</a> -->
                        <a class="collapse-item" href="recruit.php">Recruitment</a>
                        <a class="collapse-item"href="tender.php">Tenders</a>

                        <a class="collapse-item" href="view.php?name=whatsnew">What's new</a>
                        <a class="collapse-item" href="view.php?name=event">Events</a>
                        <a class="collapse-item" href="view.php?name=circular">Circular</a>
                        <a class="collapse-item" href="view.php?name=form">Form</a>

                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Website-Pages 'Hi'</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Name:</h6>
                        <!-- <a class="collapse-item" href="recruith.php?name=recruitment">Recruitment</a>
                        <a class="collapse-item" href="tenderh.php?name=tenders">Tenders</a> -->

                        <a class="collapse-item" href="recruith.php">Recruitment</a>
                        <a class="collapse-item"href="tenderh.php">Tenders</a>

                        <a class="collapse-item" href="viewh.php?name=whatsnew">What's new</a>
                        <a class="collapse-item" href="viewh.php?name=event">Events</a>
                        <a class="collapse-item" href="viewh.php?name=circular">Circular</a>
                        <a class="collapse-item" href="viewh.php?name=form">Form</a>
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseEmp" aria-expanded="true" aria-controls="collapseEmp">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Employee-Manage</span>
                </a>
                <div id="collapseEmp" class="collapse" aria-labelledby="headingEmp" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Name:</h6>
                        <a class="collapse-item" href="viewdgicmr.php">DG-ICMR</a>
                       <a class="collapse-item" href="viewaspchair.php">Dr.AS Paintal chair</a>
                        <a class="collapse-item" href="viewdirinfo.php">Director</a>
                        <a class="collapse-item" href="viewemp.php?name=scientist">Scientist staff</a>
                        <a class="collapse-item" href="viewemp.php?name=technical">Technical staff</a>
                        <a class="collapse-item" href="viewemp.php?name=ministerial">Ministrial staff</a>
                        <a class="collapse-item" href="viewemp.php?name=supportive">Supportive staff</a>
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseRe" aria-expanded="true" aria-controls="collapseRe">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Research-Manage</span>
                </a>
                <div id="collapseRe" class="collapse" aria-labelledby="headingRe" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Name:</h6>
                        <a class="collapse-item" href="viewresearch.php?name=1">current-project</a>
                        <a class="collapse-item" href="viewresearch.php?name=3">sanctioned-project</a>
                        <a class="collapse-item" href="viewresearch.php?name=2">complete-project</a>
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePub" aria-expanded="true" aria-controls="collapsePub">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Publications-Manage</span>
                </a>
                <div id="collapsePub" class="collapse" aria-labelledby="headingPub" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">year:</h6>
                        <?php
                        $sqlx = "SELECT year from publication group by year order by year DESC";
                        $queryx = $dbh->prepare($sqlx);
                        $queryx->execute();
                        $resultsx = $queryx->fetchAll(PDO::FETCH_OBJ);
                        if ($queryx->rowCount() > 0) {
                            foreach ($resultsx as $resultx) {
                        ?>
                                <a class="collapse-item" href="viewpublication.php?name=<?php echo htmlentities($resultx->year); ?>"><?php echo htmlentities($resultx->year); ?></a>

                        <?php  }
                        }
                        ?>
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAnRp" aria-expanded="true" aria-controls="collapseAnRp">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Annual Report-Manage</span>
                </a>
                <div id="collapseAnRp" class="collapse" aria-labelledby="headingAnRp" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">year:</h6>
                        <?php
                        $sqlx = "SELECT year from annualrp group by year order by year DESC";
                        $queryx = $dbh->prepare($sqlx);
                        $queryx->execute();
                        $resultsx = $queryx->fetchAll(PDO::FETCH_OBJ);
                        if ($queryx->rowCount() > 0) {
                            foreach ($resultsx as $resultx) {
                        ?>
                                <a class="collapse-item" href="viewannualrp.php?name=<?php echo htmlentities($resultx->year); ?>"><?php echo htmlentities($resultx->year); ?></a>

                        <?php  }
                        }
                        ?>
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePg" aria-expanded="true" aria-controls="collapsePg">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Photo gallery-Manage</span>
                </a>
                <div id="collapsePg" class="collapse" aria-labelledby="headingPg" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">year:</h6>
                        <?php

                        $sqlx = "SELECT year from photo_gallery group by year order by year DESC";
                        $queryx = $dbh->prepare($sqlx);
                        $queryx->execute();
                        $resultsx = $queryx->fetchAll(PDO::FETCH_OBJ);
                        if ($queryx->rowCount() > 0) {
                            foreach ($resultsx as $resultx) {
                        ?>
                                <a class="collapse-item" href="viewphotogallery.php?name=<?php echo htmlentities($resultx->year); ?>"><?php echo htmlentities($resultx->year); ?></a>

                        <?php  }
                        }
                        ?>
                    </div>
                </div>
            </li>



            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Other Web Pages</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Custom Utilities:</h6>
                        <a class="collapse-item" href="viewannouncement.php">Announcement</a>
                        <a class="collapse-item" href="viewslider.php">Slider</a>
                        <a class="collapse-item" href="#">Covid-19 info</a>




                    </div>
                </div>
            </li>


            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Nav Item - Admin profile Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAdmin" aria-expanded="true" aria-controls="collapseAdmin">
                    <i class="fas fa-fw fa-user"></i>
                    <span>Admin-profile</span>
                </a>
                <div id="collapseAdmin" class="collapse" aria-labelledby="headingAdmin" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Custom Utilities:</h6>
                        <a class="collapse-item" href="profile-admin.php">profile</a>
                        <a class="collapse-item" href="change-password.php">Change password</a>
                        <a class="collapse-item" href="logout.php">Logout</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Addons
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <!-- <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Pages</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Login Screens:</h6>
                        <a class="collapse-item" href="login.html">Login</a>
                        <a class="collapse-item" href="register.html">Register</a>
                        <a class="collapse-item" href="forgot-password.html">Forgot Password</a>
                        <div class="collapse-divider"></div>
                        <h6 class="collapse-header">Other Pages:</h6>
                        <a class="collapse-item" href="404.html">404 Page</a>
                        <a class="collapse-item" href="blank.html">Blank Page</a>
                    </div>
                </div>
            </li> -->

            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-fw fa-download"></i>
                    <span>Generate feedback Report</span></a>
            </li>

            <!-- Nav Item - Tables -->
            <!-- <li class="nav-item">
                <a class="nav-link" href="tables.html">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Tables</span></a>
            </li> -->

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->
