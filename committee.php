<?php
include('config/config.php');

// Fetch all committees
$committeeQuery = $conn->query("SELECT * FROM committees ORDER BY id ASC");
$committees = [];

while ($row = $committeeQuery->fetch_assoc()) {
    $committeeId = $row['id'];
    $committeeName = $row['committee_name'];

    // Fetch members for this committee
    $membersQuery = $conn->query("SELECT employee_name_designation, role FROM committee_members WHERE committee_id = $committeeId ORDER BY id ASC");
    $members = [];
    while ($member = $membersQuery->fetch_assoc()) {
        $members[] = [$member['employee_name_designation'], $member['role']];
    }

    // Store committee data
    $committees[$committeeId] = [
        'title' => $committeeName,
        'columns' => ['Sl. No.', 'Name & Designation', 'Role'],
        'members' => $members
    ];
}
?>
<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Committee | ICMR-NIIRNCD </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="manifest" href="site.webmanifest">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">

    <!-- CSS here -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/flaticon.css">
    <link rel="stylesheet" href="assets/css/slicknav.css">
    <link rel="stylesheet" href="assets/css/animate.min.css">
    <link rel="stylesheet" href="assets/css/magnific-popup.css">
    <link rel="stylesheet" href="assets/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/slick.css">
    <link rel="stylesheet" href="assets/css/nice-select.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="stylenav.css">
    <link rel="stylesheet" href="./committee.css">
    <link rel="stylesheet" href="./config/footer.css">
    <link rel="stylesheet" href="assets/datatables/dataTables.bootstrap4.css">
    

</head>

<body id="bg">

    <!-- Preloader Start -->
    <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="preloader-circle"></div>
                <div class="preloader-img pere-text">
                    <img src="assets/img/logo/loaderlogo.jpg" alt="">
                </div>
            </div>
        </div>
    </div>
    <!-- Preloader Start -->

    <?php include('config/header.php'); ?>

    <main>

        <!-- Committee Header -->
        <div class="committee-header single-slider slider-height2 d-flex align-items-center" style="background-image:url(assets/img/hero/services_hero.jpg);"">
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center">
                        <h2>Institute Committees</h2>
                        <p>Discover our diverse committees driving excellence and innovation</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistics Section -->
        <div class="container mt-4">
            <div class="row">
                <div class="col-md-6 col-6 mb-3">
                    <div class="stat-card">
                        <div class="stat-number"><?php echo count($committees); ?></div>
                        <div class="stat-label">Total Committees</div>
                    </div>
                </div>
                <div class="col-md-6 col-6 mb-3">
                    <div class="stat-card">
                        <div class="stat-number">
                            <?php 
                            $totalMembers = 0;
                            foreach($committees as $committee) {
                                $totalMembers += count($committee['members']);
                            }
                            echo $totalMembers;
                            ?>
                        </div>
                        <div class="stat-label">Total Members</div>
                    </div>
                </div>
                
            </div>
        </div>

        <!-- Filter Section -->
        <div class="container mt-5">
            <div class="filter-section">
                <div class="row align-items-end">
                    <div class="col-lg-5 col-md-6 mb-3">
                        <label class="filter-label">
                            <i class="fas fa-filter"></i> Select Committee
                        </label>
                        <select class="form-select-custom w-100" id="committeeSelect" onchange="filterCommittees()" style="border: 2px solid #e0e0e0; border-radius: 12px; padding: 12px 15px;">
                            <option value="all">📋 All Committees</option>
                            <?php foreach ($committees as $id => $committee): ?>
                                <option value="<?= $id ?>">📌 <?= $committee['title'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-lg-4 col-md-6 mb-3">
                        <label class="filter-label">
                            <i class="fas fa-search"></i> Search Members
                        </label>
                        <input type="text"
                            id="memberSearch"
                            class="form-control-custom w-100"
                            placeholder="🔍 Search by name, designation or role..."
                            onkeyup="searchMembers()"
                            style="border: 2px solid #e0e0e0; border-radius: 12px; padding: 12px 15px;">
                    </div>
                    
                </div>
            </div>
        </div>

        <!-- Committees Display -->
        <div class="container mt-5 pb-5">
            <div class="row" id="committeesContainer">
                <?php foreach ($committees as $id => $committee): ?>
                    <div class="col-12 committee-wrapper" data-committee-id="<?= $id ?>">
                        <div class="committee-card">
                            <div class="card-header-custom" data-bs-toggle="collapse" data-bs-target="#committee<?= $id ?>" aria-expanded="true">
                                <h3>
                                    <span>
                                        <i class="fas fa-building"></i> <?= $committee['title'] ?>
                                        <span class="member-count-badge">
                                            <i class="fas fa-users"></i> <?= count($committee['members']) ?> Members
                                        </span>
                                    </span>
                                </h3>
                            </div>
                            <div id="committee<?= $id ?>" class="collapse show">
                                <div class="table-responsive">
                                    <table class="table table-custom">
                                        <thead>
                                            <tr>
                                                <?php foreach ($committee['columns'] as $col): ?>
                                                    <th><?= $col ?></th>
                                                <?php endforeach; ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($committee['members'] as $index => $member): ?>
                                                <tr>
                                                    <td class="serial-number"><?= str_pad($index + 1, 2, '0', STR_PAD_LEFT) ?></td>
                                                    <td>
                                                        <strong><?= htmlspecialchars($member[0]) ?></strong>
                                                    </td>
                                                    <td>
                                                        <span class="role-badge">
                                                            <i class="fas fa-tag"></i> <?= htmlspecialchars($member[1]) ?>
                                                        </span>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            
            <?php if(empty($committees)): ?>
                <div class="empty-state">
                    <i class="fas fa-folder-open"></i>
                    <h4>No Committees Found</h4>
                    <p>Committees will be displayed here once added.</p>
                </div>
            <?php endif; ?>
        </div>

    </main>

    <!-- Footer -->
    <?php include "./config/footer.php"; ?>

    <!-- JS here -->
    <script src="./assets/js/vendor/modernizr-3.5.0.min.js"></script>
    <script src="./assets/js/vendor/jquery-1.12.4.min.js"></script>
    <script src="./assets/js/popper.min.js"></script>
    <script src="./assets/js/bootstrap.min.js"></script>
    <script src="./assets/js/jquery.slicknav.min.js"></script>
    <script src="./assets/js/owl.carousel.min.js"></script>
    <script src="./assets/js/slick.min.js"></script>
    <script src="./assets/js/wow.min.js"></script>
    <script src="./assets/js/animated.headline.js"></script>
    <script src="./assets/js/jquery.magnific-popup.js"></script>
    <script src="./assets/js/jquery.scrollUp.min.js"></script>
    <script src="./assets/js/jquery.nice-select.min.js"></script>
    <script src="./assets/js/jquery.sticky.js"></script>
    <script src="./assets/js/contact.js"></script>
    <script src="./assets/js/jquery.form.js"></script>
    <script src="./assets/js/jquery.validate.min.js"></script>
    <script src="./assets/js/mail-script.js"></script>
    <script src="./assets/js/jquery.ajaxchimp.min.js"></script>
    <script src="./assets/js/plugins.js"></script>
    <script src="./assets/js/main.js"></script>
    <script src="./assets/js/active.js"></script>
    <script src="./assets/js/datatables-demo.js"></script>
    <script src="./assets/datatables/jquery.dataTables.min.js"></script>
    <script src="./assets/datatables/dataTables.bootstrap4.min.js"></script>

    <script>
        // Font size controls
        $(document).ready(function() {
            $('#btn1').click(function() {
                $("#bg").css("fontSize", "18px");
                $(".card-text").css("fontSize", "18px");
                $(".table-custom").css("fontSize", "1rem");
            });
            $('#btn2').click(function() {
                $("#bg").css("fontSize", "16px");
                $(".card-text").css("fontSize", "16px");
                $(".table-custom").css("fontSize", "0.95rem");
            });
            $('#btn3').click(function() {
                $("#bg").css("fontSize", "13px");
                $(".card-text").css("fontSize", "13px");
                $(".table-custom").css("fontSize", "0.85rem");
            });
            
            // Initialize all cards as expanded
            $('.collapse').collapse('show');
            
            // Back to top button visibility
            $(window).scroll(function() {
                if ($(this).scrollTop() > 300) {
                    $('.back-to-top').addClass('show');
                } else {
                    $('.back-to-top').removeClass('show');
                }
            });
        });
        
        function filterCommittees() {
            const selected = document.getElementById('committeeSelect').value;
            const committees = document.querySelectorAll('.committee-wrapper');
            
            if (selected === 'all') {
                committees.forEach(committee => {
                    committee.style.display = 'block';
                });
            } else {
                committees.forEach(committee => {
                    if (committee.getAttribute('data-committee-id') === selected) {
                        committee.style.display = 'block';
                    } else {
                        committee.style.display = 'none';
                    }
                });
            }
            
            // Reset search when changing committee
            document.getElementById('memberSearch').value = '';
            searchMembers();
        }
        
        function searchMembers() {
            const searchTerm = document.getElementById('memberSearch').value.toLowerCase();
            const visibleCommittees = document.querySelectorAll('.committee-wrapper[style="display: block"], .committee-wrapper:not([style*="display"])');
            
            visibleCommittees.forEach(committee => {
                const rows = committee.querySelectorAll('tbody tr');
                let hasVisibleRow = false;
                
                rows.forEach(row => {
                    const text = row.innerText.toLowerCase();
                    if (text.includes(searchTerm)) {
                        row.style.display = '';
                        hasVisibleRow = true;
                    } else {
                        row.style.display = 'none';
                    }
                });
                
                // Hide committee card if no matching rows
                const card = committee.querySelector('.committee-card');
                if (hasVisibleRow) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        }
        
    </script>

</body>

</html>