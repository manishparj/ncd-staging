<?php include "./config/config.php"; ?>
<?php
 $year = 2026;

 $holidays = [
     "2026-01-01" => ["type" => "RH", "name" => "New Year’s Day"],
     "2026-01-03" => ["type" => "RH", "name" => "Hazrat Ali’s Birthday"],
     "2026-01-14" => ["type" => "RH", "name" => "Makar Sankranti"],
     "2026-01-14" => ["type" => "RH", "name" => "Magha Bihu / Pongal"],
     "2026-01-23" => [
         "type" => "RH",
         "name" => "Sri Panchami / Basant Panchami",
     ],
     "2026-01-26" => ["type" => "GH", "name" => "Republic Day"],

     "2026-02-01" => ["type" => "RH", "name" => "Guru Ravi Dass Birthday"],
     "2026-02-12" => [
         "type" => "RH",
         "name" => "Birthday of Swami Dayananda Saraswati",
     ],
     "2026-02-15" => ["type" => "RH", "name" => "Maha Shivratri"],
     "2026-02-19" => ["type" => "RH", "name" => "Shivaji Jayanti"],

     "2026-03-03" => ["type" => "RH", "name" => "Holika Dahan"],
     "2026-03-03" => ["type" => "RH", "name" => "Dol Yatra"],
     "2026-03-04" => ["type" => "GH", "name" => "Holi"],
     "2026-03-19" => [
         "type" => "RH",
         "name" => "Chaitra Sukladi / Gudi Padava / Ugadi / Cheti Chand",
     ],
     "2026-03-20" => ["type" => "RH", "name" => "Jamat-Ul-Vida"],
     "2026-03-21" => ["type" => "GH", "name" => "Id-ul-Fitr"],
     "2026-03-31" => ["type" => "GH", "name" => "Mahavir Jayanti"],

     "2026-04-03" => ["type" => "GH", "name" => "Good Friday"],
     "2026-04-05" => ["type" => "RH", "name" => "Easter Sunday"],
     "2026-04-14" => [
         "type" => "RH",
         "name" => "Vaisakhi / Vishu / Tamil New Year’s Day",
     ],
     "2026-04-15" => ["type" => "RH", "name" => "Bohag Bihu (Assam)"],

     "2026-05-01" => ["type" => "GH", "name" => "Buddha Purnima"],
     "2026-05-09" => [
         "type" => "RH",
         "name" => "Birthday of Guru Rabindranath Tagore",
     ],
     "2026-05-27" => ["type" => "GH", "name" => "Id-ul-Zuha (Bakrid)"],

     "2026-06-26" => ["type" => "GH", "name" => "Muharram"],

     "2026-07-16" => ["type" => "RH", "name" => "Rath Yatra"],

     "2026-08-15" => ["type" => "GH", "name" => "Independence Day"],
     "2026-08-26" => ["type" => "GH", "name" => "Milad-un-Nabi / Id-e-Milad"],
     "2026-08-28" => ["type" => "RH", "name" => "Raksha Bandhan"],

     "2026-09-04" => ["type" => "GH", "name" => "Janmashtami (Vaishnava)"],
     "2026-09-14" => ["type" => "GH", "name" => "Ganesh Chaturthi"],

     "2026-10-02" => ["type" => "GH", "name" => "Mahatma Gandhi’s Birthday"],
     "2026-10-18" => ["type" => "RH", "name" => "Dussehra (Saptami)"],
     "2026-10-19" => ["type" => "RH", "name" => "Dussehra (Mahaptami)"],
     "2026-10-20" => ["type" => "GH", "name" => "Dussehra (Vijaya Dashami)"],
     "2026-10-26" => ["type" => "RH", "name" => "Maharishi Valmiki’s Birthday"],
     "2026-10-29" => [
         "type" => "RH",
         "name" => "Karaka Chaturthi (Karwa Chouth)",
     ],

     "2026-11-08" => ["type" => "GH", "name" => "Diwali (Deepavali)"],
     "2026-11-09" => ["type" => "RH", "name" => "Govardhan Puja"],
     "2026-11-11" => ["type" => "RH", "name" => "Bhai Duj"],
     "2026-11-15" => [
         "type" => "RH",
         "name" => "Pratihar Shashthi / Chhat Puja",
     ],
     "2026-11-24" => ["type" => "GH", "name" => "Guru Nanak’s Birthday"],

     "2026-12-23" => ["type" => "RH", "name" => "Hazrat Ali’s Birthday"],
     "2026-12-24" => ["type" => "RH", "name" => "Christmas Eve"],
     "2026-12-25" => ["type" => "GH", "name" => "Christmas Day"],
 ];
 ?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>ICMR-NIIRNCD Jodhpur</title>
    <meta name="description"
        content="National Institute for Implementation Research on Non-Communicable Diseases, Jodhpur">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="manifest" href="site.webmanifest">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">

    <!-- Original vendor CSS — untouched -->
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="./assets/css/flaticon.css">
    <link rel="stylesheet" href="./assets/css/animate.min.css">
    <link rel="stylesheet" href="./assets/css/magnific-popup.css">
    <link rel="stylesheet" href="./assets/css/fontawesome-all.min.css">
    <link rel="stylesheet" type="text/css" href="./assets/slick/slick.css">
    <link rel="stylesheet" type="text/css" href="./assets/slick/slick-theme.css">
    <link rel="stylesheet" href="./assets/css/nice-select.css">
    <link rel="stylesheet" href="./assets/css/style.css">
    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@400;500;600;700&family=Noto+Sans+Devanagari:wght@400;600;700&family=Lora:ital,wght@0,400;0,600;1,400&family=Source+Sans+3:wght@300;400;600&display=swap"
        rel="stylesheet">
    <!-- Font Awesome 6 for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="./config/footer.css">
    <!-- Font Awesome 6 Free CDN -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>

<body id="bg">

    <!-- ═══════════════════════════════════════
     PRELOADER  — original logic, styled
═══════════════════════════════════════ -->
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

    <!-- ═══════════════════════════════════════
     HEADER  (top-bar + brand + navbar)
═══════════════════════════════════════ -->

    <?php include "./config/header.php"; ?>

    <div class="mob-overlay" id="mobOverlay"></div>

    <main>

        <!-- RIGHT COLUMN: Announcement Bar (col 4) -->


        <!-- ═══════════════════════════════════════
     HERO & ANNOUNCEMENT BAR - NEW LAYOUT
═══════════════════════════════════════ -->
        <div class="hero-announcement-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <!-- LEFT COLUMN: Hero Carousel (col 8) -->
                    <div class="col-lg-7 hero-col">
                        <div class="hero-area">
                            <div class="hero-slideshow owl-carousel">

                                <?php
                        $sql =
                            "SELECT * FROM slider WHERE status='1' ORDER BY id ASC";
                        $query = $dbh->prepare($sql);
                        $query->execute();
                        $results = $query->fetchAll(PDO::FETCH_OBJ);

                        if ($query->rowCount() > 0) {
                            foreach ($results as $result) {

                                // Default image
                                $imagePath = $result->doc_upload;

                                // If multiple images → get ONLY cover image
                                if ($result->has_multiple_images == 1) {
                                    $sql_images = 'SELECT image_path 
                                                        FROM slider_images 
                                                        WHERE slider_id = ? 
                                                        ORDER BY is_cover DESC, image_order ASC 
                                                        LIMIT 1';
                                    $query_images = $dbh->prepare($sql_images);
                                    $query_images->execute([$result->id]);

                                    if ($query_images->rowCount() > 0) {
                                        $img = $query_images->fetch(
                                            PDO::FETCH_OBJ
                                        );
                                        $imagePath = $img->image_path;
                                    }
                                }
                                ?>

                                <!-- SINGLE CLEAN SLIDE -->
                                <div class="single-slide bg-img slider-item" data-slider-id="<?php echo $result->id; ?>"
                                    data-title="<?php echo htmlentities(
                                            $result->messages
                                        ); ?>">

                                    <div class="slide-bg-img bg-img bg-overlay">
                                        <img src="assets/img/hero/<?php echo htmlentities(
                                            $imagePath
                                        ); ?>" alt="">
                                    </div>

                                    <div class="container-fluid" style="position: absolute; bottom: 0;">
                                        <div class="row h-100 justify-content-center">
                                            <div class="col-12 col-lg-12" style="padding: 0;">
                                                <div class="welcome-text text-center">
                                                    <h4 data-animation="fadeInUp">
                                                        <?php echo htmlentities(
                                                    $result->messages
                                                ); ?>
                                                    </h4>
                                                    <p data-animation="fadeInUp">
                                                        <?php echo htmlentities(
                                                    $result->messages2
                                                ); ?>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="slide-du-indicator"></div>
                                </div>

                                <?php
                            }
                        }
                        ?>

                            </div>
                        </div>
                    </div>



                    <div class="col-lg-5 col-md-12">
                        <div class="col-lg-12  director-col">
                            <span class="sec-tag">Insights</span>
                            <h2 class="sec-title">Director’s Message</h2>
                            <div class="sec-line"></div>
                        </div>
                        <div class="team-padding">
                            <div class="shadow bg-white rounded text-center">
                                <?php
                $name = "director";
                $sql =
                    "SELECT * FROM emp_details WHERE emp_type = :type ORDER BY emp_seniority ASC LIMIT 1";
                $query = $dbh->prepare($sql);
                $query->bindParam(":type", $name, PDO::PARAM_STR);
                $query->execute();
                $result = $query->fetch(PDO::FETCH_OBJ);

                if ($result): ?>

                                <!-- Director Image -->
                                <img src="admin/img/our_team/director/<?php echo htmlentities(
                      $result->emp_image
                  ); ?>" alt="<?php echo htmlentities($result->emp_name); ?>" class="director-img mb-2">

                                <!-- Director Name -->
                                <h5 class="director-name">
                                    <?php echo htmlentities($result->emp_name); ?>
                                </h5>

                                <?php endif;
                ?>

                                <!-- Description -->
                                <?php
                    $sql9 = "SELECT * FROM director_profile WHERE id = :id";
                    $query9 = $dbh->prepare($sql9);
                    $query9->bindParam(":id", $result->emp_id, PDO::PARAM_INT);
                    $query9->execute();
                    $profile = $query9->fetch(PDO::FETCH_OBJ);
                    ?>

                                <p class="card-text text-justify mt-2" id="bg1">
                                    <?php
                    $message = $profile->director_message ?? "";
                    $limit = 650; // adjust as needed

                    if (strlen($message) > $limit) {
                        $shortMsg = substr($message, 0, $limit) . "...";
                    } else {
                        $shortMsg = $message;
                    }

                    echo htmlentities($shortMsg);
                    ?>

                                </p>
                                <!-- Button -->
                                <a class="genric-btn success" href="about-director.php"
                                    style="width:100%;background-color:#003679;">
                                    View Profile →
                                </a>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>


        <section class="latest-updates-section py-3">
            <div class="container">
                <div class="row">
                    <div class="announcement-card shadow-sm rounded overflow-hidden d-flex align-items-center">

                        <!-- Fixed title -->
                        <div
                            class="announcement-title text-white px-3 py-2 d-flex align-items-center flex-shrink-0" style="background-color: #003679;">
                            <i class="fas fa-bullhorn me-2"></i> Announcements:
                        </div>

                        <!-- Rotating content -->
                        <div class="announcement-content flex-grow-1 overflow-hidden">
                            <div class="announcement-ticker d-flex">
                                <?php
          $sql = "SELECT * FROM announcement ORDER BY id DESC";
          $query = $dbh->prepare($sql);
          $query->execute();
          $results = $query->fetchAll(PDO::FETCH_OBJ);
          if ($query->rowCount() > 0) {
              foreach ($results as $result) {
                  if ($result->doc_upload) { ?>
                                <div class="ticker-item px-3 py-2 d-flex align-items-center bg-light rounded me-3">
                                    <i class="fas fa-file-pdf me-2 text-danger"></i>
                                    <a href="./admin/en_doc/<?php echo htmlentities($result->doc_upload); ?>"
                                        target="_blank" class="text-decoration-none text-dark fw-bold">
                                        <?php echo htmlentities($result->messages); ?>
                                    </a>
                                </div>
                                <?php } else { ?>
                                <div class="ticker-item px-3 py-2 d-flex align-items-center bg-light rounded me-3">
                                    <i class="fas fa-info-circle me-2 text-info"></i>
                                    <span class="fw-bold"><?php echo htmlentities($result->messages); ?></span>
                                </div>
                                <?php }
              }
          } else { ?>
                                <div class="ticker-item px-3 py-2 bg-light rounded me-3">
                                    No announcements at the moment.
                                </div>
                                <?php } ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- ═══════════════════════════════════════
     LATEST UPDATES SECTION (TABS: What's New, Events, Tender, Recruitment)
═══════════════════════════════════════ -->
        <section class="latest-updates-section">
            <div class="container">
                <div class="row mb-4">
                    <div class="col-lg-8 col-md-12">
                        <div class="col-lg-12 mb-5 reveal">
                            <span class="sec-tag">Stay Informed</span>
                            <h2 class="sec-title">Latest Updates</h2>
                            <div class="sec-line"></div>
                        </div>
                        <div class="updates-tabs-wrapper">
                            <ul class="nav-tabs updates-tabs" id="updatesTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="whatsnew-tab" data-bs-toggle="tab"
                                        data-bs-target="#whatsnew" type="button" role="tab" aria-controls="whatsnew"
                                        aria-selected="true">
                                        <i class="fas fa-newspaper"></i> What's New
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="events-tab" data-bs-toggle="tab"
                                        data-bs-target="#events" type="button" role="tab" aria-controls="events"
                                        aria-selected="false">
                                        <i class="fas fa-calendar-alt"></i> Events
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="tender-tab" data-bs-toggle="tab"
                                        data-bs-target="#tender" type="button" role="tab" aria-controls="tender"
                                        aria-selected="false">
                                        <i class="fas fa-gavel"></i> Tender
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="recruitment-tab" data-bs-toggle="tab"
                                        data-bs-target="#recruitment" type="button" role="tab"
                                        aria-controls="recruitment" aria-selected="false">
                                        <i class="fas fa-users"></i> Recruitment
                                    </button>
                                </li>
                            </ul>
                            <div class="tab-content updates-tab-content" id="updatesTabContent">
                                <!-- What's New Tab -->
                                <div class="tab-pane fade show active" id="whatsnew" role="tabpanel"
                                    aria-labelledby="whatsnew-tab">
                                    <div class="update-list-container">
                                        <ul class="update-list">
                                            <?php
                                    $sql_wn =
                                        "SELECT * from info_en where type = 'whatsnew' ORDER BY id DESC LIMIT 8";
                                    $query_wn = $dbh->prepare($sql_wn);
                                    $query_wn->execute();
                                    $results_wn = $query_wn->fetchAll(PDO::FETCH_OBJ);
                                    if ($query_wn->rowCount() > 0) {
                                        foreach ($results_wn as $result) {
                                            $sql_doc = "SELECT * from doc_en where doc_id = $result->id";
                                            $query_doc = $dbh->prepare($sql_doc);
                                            $query_doc->execute();
                                            $results_doc = $query_doc->fetchAll(PDO::FETCH_OBJ);
                                            if ($query_doc->rowCount() > 0) {
                                                foreach ($results_doc as $doc) { ?>
                                                            <li>
                                                                <a href="admin/en_doc/<?php echo htmlentities(
                                                    $doc->doc_main
                                                ); ?>" target="_blank">
                                                                    <i class="fas fa-file-alt"></i> <?php echo htmlentities(
                                                      $result->title
                                                  ); ?>
                                                                </a>
                                                            </li>
                                                            <?php }
                                            } else {
                                                ?>
                                                            <li><i class="fas fa-info-circle"></i> <?php echo htmlentities(
                                                $result->title
                                            ); ?></li>
                                                            <?php
                                            }
                                        }
                                    } else {
                                        ?>
                                                            <li>No recent updates</li>
                                                            <?php
                                    }
                                    ?>
                                                        </ul>
                                                        <a href="viewnews.php" class="view-all-link">View All <i
                                                                class="fas fa-arrow-right"></i></a>
                                                    </div>
                                                </div>
                                                <!-- Events Tab -->
                                                <div class="tab-pane fade" id="events" role="tabpanel" aria-labelledby="events-tab">
                                                    <div class="update-list-container">
                                                        <ul class="update-list">
                                                            <?php
                                    $sql_ev =
                                        "SELECT * from info_en where type = 'event' ORDER BY id DESC LIMIT 8";
                                    $query_ev = $dbh->prepare($sql_ev);
                                    $query_ev->execute();
                                    $results_ev = $query_ev->fetchAll(PDO::FETCH_OBJ);
                                    if ($query_ev->rowCount() > 0) {
                                        foreach ($results_ev as $result) {
                                            $sql_doc_ev = "SELECT * from doc_en where doc_id = $result->id";
                                            $query_doc_ev = $dbh->prepare($sql_doc_ev);
                                            $query_doc_ev->execute();
                                            $results_doc_ev = $query_doc_ev->fetchAll(
                                                PDO::FETCH_OBJ
                                            );
                                            if ($query_doc_ev->rowCount() > 0) {
                                                foreach ($results_doc_ev as $doc) { ?>
                                                            <li>
                                                                <a href="admin/en_doc/<?php echo htmlentities(
                                                    $doc->doc_main
                                                ); ?>" target="_blank">
                                                                    <i class="fas fa-calendar-day"></i> <?php echo htmlentities(
                                                      $result->title
                                                  ); ?>
                                                                </a>
                                                            </li>
                                                            <?php }
                                            } else {
                                                ?>
                                                            <li><i class="fas fa-calendar-day"></i> <?php echo htmlentities(
                                                $result->title
                                            ); ?></li>
                                                            <?php
                                            }
                                        }
                                    } else {
                                        ?>
                                                            <li>No upcoming events</li>
                                                            <?php
                                    }
                                    ?>
                                                        </ul>
                                                        <a href="view.php" class="view-all-link">View All <i
                                                                class="fas fa-arrow-right"></i></a>
                                                    </div>
                                                </div>
                                                <!-- Tender Tab -->
                                                <div class="tab-pane fade" id="tender" role="tabpanel" aria-labelledby="tender-tab">
                                                    <div class="update-list-container">
                                                        <ul class="update-list">
                                                            <?php
                                    $sql_tn =
                                        "SELECT * from info_en where type = 'tenders' ORDER BY id DESC LIMIT 8";
                                    $query_tn = $dbh->prepare($sql_tn);
                                    $query_tn->execute();
                                    $results_tn = $query_tn->fetchAll(PDO::FETCH_OBJ);
                                    if ($query_tn->rowCount() > 0) {
                                        foreach ($results_tn as $result) {
                                            $sql_doc_tn = "SELECT * from doc_en where doc_id = $result->id";
                                            $query_doc_tn = $dbh->prepare($sql_doc_tn);
                                            $query_doc_tn->execute();
                                            $results_doc_tn = $query_doc_tn->fetchAll(
                                                PDO::FETCH_OBJ
                                            );
                                            if ($query_doc_tn->rowCount() > 0) {
                                                foreach ($results_doc_tn as $doc) { ?>
                                                            <li>
                                                                <a href="admin/en_doc/<?php echo htmlentities(
                                                    $doc->doc_main
                                                ); ?>" target="_blank">
                                                                    <i class="fas fa-file-signature"></i> <?php echo htmlentities(
                                                      $result->title
                                                  ); ?>
                                                                </a>
                                                            </li>
                                                            <?php }
                                            } else {
                                                ?>
                                                            <li><i class="fas fa-file-signature"></i> <?php echo htmlentities(
                                                $result->title
                                            ); ?></li>
                                                            <?php
                                            }
                                        }
                                    } else {
                                        ?>
                                                            <li>No tenders available</li>
                                                            <?php
                                    }
                                    ?>
                                                        </ul>
                                                        <a href="tenders.php" class="view-all-link">View All <i
                                                                class="fas fa-arrow-right"></i></a>
                                                    </div>
                                                </div>
                                                <!-- Recruitment Tab -->
                                                <div class="tab-pane fade" id="recruitment" role="tabpanel"
                                                    aria-labelledby="recruitment-tab">
                                                    <div class="update-list-container">
                                                        <ul class="update-list">
                                                            <?php
                                    $sql_rec =
                                        "SELECT * from info_en where type = 'recruitment' ORDER BY id DESC LIMIT 8";
                                    $query_rec = $dbh->prepare($sql_rec);
                                    $query_rec->execute();
                                    $results_rec = $query_rec->fetchAll(PDO::FETCH_OBJ);
                                    if ($query_rec->rowCount() > 0) {
                                        foreach ($results_rec as $result) {
                                            $sql_doc_rec = "SELECT * from doc_en where doc_id = $result->id";
                                            $query_doc_rec = $dbh->prepare($sql_doc_rec);
                                            $query_doc_rec->execute();
                                            $results_doc_rec = $query_doc_rec->fetchAll(
                                                PDO::FETCH_OBJ
                                            );
                                            if ($query_doc_rec->rowCount() > 0) {
                                                foreach ($results_doc_rec as $doc) { ?>
                                                            <li>
                                                                <a href="admin/en_doc/<?php echo htmlentities(
                                                    $doc->doc_main
                                                ); ?>" target="_blank">
                                                                    <i class="fas fa-briefcase"></i> <?php echo htmlentities(
                                                      $result->title
                                                  ); ?>
                                                                </a>
                                                            </li>
                                                            <?php }
                                            } else {
                                                ?>
                                                            <li><i class="fas fa-briefcase"></i> <?php echo htmlentities(
                                                $result->title
                                            ); ?></li>
                                                            <?php
                                            }
                                        }
                                    } else {
                                        ?>
                                                            <li>No recruitment notifications</li>
                                                            <?php
                                    }
                                    ?>
                                                        </ul>
                                                        <a href="recruitment.php" class="view-all-link">View All <i
                                                                class="fas fa-arrow-right"></i></a>
                                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                     <div class="col-lg-4 col-md-12">
                        <div class="col-12 mb-5 reveal">
                            <span class="sec-tag">Holiday List</span>
                            <h2 class="sec-title">Calandar 2026</h2>
                            <div class="sec-line"></div>
                        </div>
                        <div class="section-full bg-white">
                            <div class="container" style="margin-bottom: 5%;">
                                <div class="row justify-content-center">
                                    <div class="col-lg-12">

                                        <div class="calendar-card">
                                            <div class="calendar-header">
                                                <button id="prevBtn" class="cal-nav-btn" onclick="prevMonth()"
                                                    aria-label="Previous Month">
                                                    <span class="arrow">❮</span>
                                                </button>

                                                <h2 id="monthYear"></h2>

                                                <button id="nextBtn" class="cal-nav-btn" onclick="nextMonth()"
                                                    aria-label="Next Month">
                                                    <span class="arrow">❯</span>
                                                </button>

                                            </div>

                                            <div id="calendar"></div>

                                            <div class="calendar-legend">
                                                <span class="legend gazetted">GH</span>
                                                <span class="legend restricted">RH</span>
                                                <span class="legend weekend">Weekend</span>
                                                <span class="legend today-legend">Today</span>
                                            </div>
                                            <p>The above calendar is prepared as per the official calendar. For any
                                                clarification, the below office calendar will be final.</p>
                                            <div class="text-center mt-4">
                                                <a class="calendar-pdf-link" href="./doc/Calender2026.pdf"
                                                    target="_blank">
                                                    📄 Show Complete Calendar 2026
                                                </a>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <!-- ═══════════════════════════════════════
     COLLABORATORS (Inline Carousel)
═══════════════════════════════════════ -->
        <section class="latest-updates-section">
            <div class="container">
                <div class="row">
                    <div class="container">
                        <div class="col-12 reveal mb-5">
                            <span class="sec-tag">Working Together</span>
                            <h2 class="sec-title">Our Partners & Collaborators</h2>
                            <div class="sec-line"></div>
                            <div class="row g-4 justify-content-center">

                                <div class="text-center">
                                    <div class="collab-circle">
                                        <img src="./assets/img/footerlogo/who.jpg" alt="WHO">
                                    </div>
                                </div>

                                <div class="text-center">
                                    <div class="collab-circle">
                                        <img src="./assets/img/footerlogo/aiimslogo.png" alt="AIIMS">
                                    </div>
                                </div>

                                <div class="text-center">
                                    <div class="collab-circle">
                                        <img src="./assets/img/footerlogo/icmr_logo.png" alt="ICMR">
                                    </div>
                                </div>

                                <div class="  text-center">
                                    <div class="collab-circle">
                                        <img src="./assets/img/footerlogo/MOHFW-Recruitment-2017.jpg" alt="MoHFW">
                                    </div>
                                </div>

                                <div class="  text-center">
                                    <div class="collab-circle">
                                        <img src="./assets/img/footerlogo/dhr.jpg" alt="DHR">
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
        </section>

<section class="latest-updates-section">
    <div class="container">

        <div class="col-12 reveal mb-5">
          <span class="sec-tag">Our Vision, Mission, Goal & Objectives</span>
          <h2 class="sec-title">Driving excellence in prevention, control, and research of NCDs across India.</h2>
          <div class="sec-line"></div>
        </div>

        <div class="row g-4 align-items-stretch">

            <!-- Vision -->
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card h-100 shadow-lg tile-card text-center border-0 hover-zoom">
                    <div class="card-header text-white d-flex flex-column align-items-center justify-content-center" style="background:var(--icmr-teal);">
                        <div class="icon-badge mb-2"><i class="fas fa-eye fa-2x"></i></div>
                        <h5 class="mb-1">Vision</h5>
                        <small class="text-light">Where we aim to go</small>
                    </div>
                    <div class="card-body">
                        <p class="mb-0"><i class="fa fa-check-circle text-primary me-2"></i>
                            To be the leader in conducting implementation research for prevention and control of non-communicable diseases.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Mission -->
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card h-100 shadow-lg tile-card text-center border-0 hover-zoom">
                    <div class="card-header text-white d-flex flex-column align-items-center justify-content-center" style="background:var(--icmr-green);">
                        <div class="icon-badge mb-2"><i class="fa fa-bullhorn fa-2x"></i></div>
                        <h5 class="mb-1">Mission</h5>
                        <small class="text-light">How we achieve it</small>
                    </div>
                    <div class="card-body">
                        <p class="mb-0"><i class="fa fa-check-circle text-success me-2"></i>
                            To equip all health care workers with the skills and competencies needed to prevent, control, and treat non-communicable diseases.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Goal -->
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card h-100 shadow-lg tile-card text-center border-0 hover-zoom">
                    <div class="card-header text-white d-flex flex-column align-items-center justify-content-center" style="background:var(--icmr-warning);">
                        <div class="icon-badge mb-2"><i class="fa fa-bullseye fa-2x"></i></div>
                        <h5 class="mb-1">Goal</h5>
                        <small class="text-light">What we strive for</small>
                    </div>
                    <div class="card-body">
                        <p class="mb-0"><i class="fa fa-check-circle text-warning me-2"></i>
                            Reduce the burden of non-communicable diseases and improve the quality of life of people suffering from NCDs.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Objectives -->
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card h-100 shadow-lg tile-card text-center border-0 hover-zoom">
                    <div class="card-header text-white d-flex flex-column align-items-center justify-content-center" style="background:var(--icmr-danger);">
                        <div class="icon-badge mb-2"><i class="fa fa-tasks fa-2x"></i></div>
                        <h5 class="mb-1">Objectives</h5>
                        <small class="text-light">Specific actions</small>
                    </div>
                    <div class="card-body objective-scroll">
                        <ul class="list-unstyled mb-0">
                            <li><i class="fa fa-check-circle  me-2"></i> Conduct implementation research in NCDs of public health significance</li>
                            <li><i class="fa fa-check-circle  me-2"></i> Develop human resources and build capacities for research</li>
                            <li><i class="fa fa-check-circle  me-2"></i> Create IEC strategies and tools for prevention and treatment</li>
                            <li><i class="fa fa-check-circle  me-2"></i> Provide recommendations to policymakers</li>
                            <li><i class="fa fa-check-circle me-2"></i> Collaborate with institutions and agencies for innovative solutions</li>
                            <li><i class="fa fa-check-circle  me-2"></i> Create interface between communicable and non-communicable diseases</li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<style>
/* Section Title */
.sec-tag {
    font-size: 0.85rem;
    letter-spacing: 1px;
}
.sec-title {
    font-size: 2rem;
    line-height: 1.3;
}

/* Card styling */
.tile-card {
    transition: transform 0.3s, box-shadow 0.3s;
    border-radius: 10px;
}
.hover-zoom:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 25px rgba(0,0,0,0.2);
}
.tile-card .icon-badge {
    background: #C8922A;
    width: 45px;
    height: 45px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
}
.tile-card .card-header small {
    font-size: 0.8rem;
}

/* Scrollable objectives */
.objective-scroll {
    max-height: 220px;
    overflow-y: auto;
    padding-right: 5px;
}
.objective-scroll li {
    margin-bottom: 0.6rem;
}

/* Responsive adjustments */
@media (max-width: 992px) {
    .tile-card .icon-badge {
        width: 50px;
        height: 50px;
    }
    .sec-title {
        font-size: 1.75rem;
    }
}
@media (max-width: 768px) {
    .objective-scroll {
        max-height: 300px;
    }
    .sec-title {
        font-size: 1.5rem;
    }
}
@media (max-width: 576px) {
    .tile-card .icon-badge {
        width: 45px;
        height: 45px;
    }
}
</style>
      

       <section class="latest-updates-section">
          <div class="container">
              <div class="row">

                  <!-- Left Column: Contact & Map -->
                  <div class="col-lg-8 col-md-12">
                      <div class="col-12 mb-5 reveal">
                          <span class="sec-tag">Reach Out</span>
                          <h2 class="sec-title">Find Us</h2>
                          <div class="sec-line"></div>
                      </div>
                      <div class="section-full bg-white">
                          <!-- Google Map -->
                          <div>
                              <iframe
                                  src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4255.999377738954!2d73.0276054281912!3d26.23391291055097!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39418b8f0bc41b59%3A0x452d769037ea5042!2sNational%20Institute%20for%20Implementation%20Research%20on%20Non-Communicable%20Diseases!5e0!3m2!1sen!2sin!4v1622014051415!5m2!1sen!2sin"
                                  width="100%" height="300px" style="border:0;" allowfullscreen="" loading="lazy">
                              </iframe>
                          </div>
                          <!-- Contact Details -->
                          <div class="footer-col mt-3">
                              <ul class="footer-contact">
                                  <li><i class="fas fa-map-marker-alt"></i><span>New Pali Road, Jodhpur (Raj.) — 342005</span></li>
                                  <li><i class="fas fa-phone-alt"></i><span>0291-2722403 / 0291-2720618</span></li>
                                  <li><i class="fas fa-envelope"></i><span>director-niirncd[at]icmr[dot]gov[dot]in</span></li>
                                  <li><i class="fas fa-fax"></i><span>0291-2720618</span></li>
                                  <li><i class="fas fa-clock"></i><span>Mon-Fri: 9:00 AM - 5:30 PM</span></li>
                              </ul>
                          </div>
                      </div>
                  </div>

                  <!-- Right Column: Social Feeds -->
                  <div class="col-lg-4 col-md-12">
                      <div class="col-12 mb-5 reveal">
                          <span class="sec-tag">Soical Media</span>
                          <h2 class="sec-title">Get in Touch</h2>
                          <div class="sec-line"></div>
                      </div>

                      <div class="updates-tabs-wrapper">
                          <ul class="nav-tabs updates-tabs" id="updatesTab" role="tablist">
                              <li class="nav-item" role="presentation">
                                  <button class="nav-link active" id="Facebook-tab" data-bs-toggle="tab"
                                      data-bs-target="#Facebook" type="button" role="tab" aria-controls="Facebook"
                                      aria-selected="true">
                                      <i class="fab fa-facebook-f"></i> Facebook
                                  </button>
                              </li>
                              <li class="nav-item" role="presentation">
                                  <button class="nav-link" id="Instagram-tab" data-bs-toggle="tab"
                                      data-bs-target="#Instagram" type="button" role="tab" aria-controls="Instagram"
                                      aria-selected="false">
                                      <i class="fab fa-instagram"></i> Instagram
                                  </button>
                              </li>
                          </ul>

                          <div class="tab-content updates-tab-content" id="updatesTabContent">
                              <!-- Facebook Tab -->
                              <div class="tab-pane fade show active" id="Facebook" role="tabpanel"
                                  aria-labelledby="Facebook-tab">
                                  <div class="update-list-container">
                                      <div class="feed-container">
                                          <div id="fb-root"></div>
                                          <script async defer crossorigin="anonymous"
                                              src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v17.0"
                                              nonce="FBNonce"></script>
                                          <div class="fb-page"
                                              data-href="https://www.facebook.com/niirncdjodhpur"
                                              data-tabs="timeline"
                                              data-width="340"
                                              data-height="500"
                                              data-small-header="false"
                                              data-adapt-container-width="true"
                                              data-hide-cover="false"
                                              data-show-facepile="true">
                                              <blockquote cite="https://www.facebook.com/niirncdjodhpur"
                                                  class="fb-xfbml-parse-ignore">
                                                  <a href="https://www.facebook.com/niirncdjodhpur">Facebook</a>
                                              </blockquote>
                                          </div>
                                      </div>
                                  </div>
                              </div>

                              <!-- Instagram Tab -->
                              <div class="tab-pane fade" id="Instagram" role="tabpanel"
                                  aria-labelledby="Instagram-tab">
                                  <div class="update-list-container">
                                      <div class="feed-container">
                                          <iframe src="https://www.instagram.com/niirncd.jodhpur/embed"
                                              width="340"
                                              height="500"
                                              frameborder="0"
                                              scrolling="no"
                                              allowtransparency="true">
                                          </iframe>
                                      </div>
                                  </div>
                              </div>

                          </div> <!-- end tab-content -->
                      </div> <!-- end updates-tabs-wrapper -->
                  </div> <!-- end right column -->

              </div> <!-- end row -->
          </div> <!-- end container -->
      </section>



    </main>

    <?php include "./config/footer.php"; ?>

    <!-- JS (unchanged) -->
    <script src="./assets/js/vendor/modernizr-3.5.0.min.js"></script>
    <script src="./assets/js/vendor/jquery-1.12.4.min.js"></script>
    <script src="./assets/js/popper.min.js"></script>
    <script src="./assets/js/bootstrap.min.js"></script>
    <script src="./assets/js/jquery.slicknav.min.js"></script>
    <script src="./assets/js/owl.carousel.min.js"></script>
    <script src="./assets/js/gijgo.min.js"></script>
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
    <script src="./assets/js/jquery-2.2.4.min.js"></script>
    <script src="./assets/js/plugins.js"></script>
    <script src="./assets/js/main.js"></script>
    <script src="./assets/js/active.js"></script>
    <script type="text/javascript" src="./assets/slick/slick.min.js"></script>

    <script>
    $(document).ready(function() {
        $('#btn1').click(function() {
            $("#bg").css("fontSize", "18px");
            $(".card-text").css("fontSize", "18px");
        });
        $('#btn2').click(function() {
            $("#bg").css("fontSize", "16px");
            $(".card-text").css("fontSize", "16px");
        });
        $('#btn3').click(function() {
            $("#bg").css("fontSize", "13px");
            $(".card-text").css("fontSize", "13px");
        });

        $('.variable-width').slick({
            dots: false,
            infinite: true,
            slidesToShow: 2,
            slidesToScroll: 1,
            variableWidth: true,
            autoplay: true,
            autoplaySpeed: 3000,
        });

        if ($('.hero-slideshow').length) {
            $('.hero-slideshow').owlCarousel({
                loop: true,
                margin: 0,
                items: 1,
                autoplay: true,
                autoplayTimeout: 5000,
                autoplayHoverPause: true,
                animateOut: 'fadeOut',
                animateIn: 'fadeIn',
                nav: true,
                dots: true,
                navText: ['<i class="fa fa-chevron-left"></i>', '<i class="fa fa-chevron-right"></i>'],
            });
        }
    });

    /* Vanilla JS for preloader, counters, etc */
    window.addEventListener('load', () => {
        const pre = document.getElementById('preloader-active');
        if (pre) {
            pre.classList.add('fade-out');
            setTimeout(() => pre.style.display = 'none', 600);
        }
    });
    document.getElementById('fyear').textContent = new Date().getFullYear();

    const ham = document.getElementById('hamburger');
    const navL = document.getElementById('navList');
    const overlay = document.getElementById('mobOverlay');

    function closeDrawer() {
        ham.classList.remove('open');
        navL.classList.remove('open');
        overlay.classList.remove('show');
        ham.setAttribute('aria-expanded', 'false');
    }
    if (ham) {
        ham.addEventListener('click', () => {
            const o = navL.classList.toggle('open');
            ham.classList.toggle('open');
            overlay.classList.toggle('show', o);
            ham.setAttribute('aria-expanded', String(o));
        });
        overlay.addEventListener('click', closeDrawer);
        navL.querySelectorAll('li').forEach(li => {
            const sub = li.querySelector('.dropdown');
            if (!sub) return;
            li.querySelector('a').addEventListener('click', e => {
                if (window.innerWidth <= 900) {
                    e.preventDefault();
                    navL.querySelectorAll('li.mob-open').forEach(x => {
                        if (x !== li) x.classList.remove('mob-open');
                    });
                    li.classList.toggle('mob-open');
                }
            });
        });
    }

    const revEls = document.querySelectorAll('.reveal');
    const revObs = new IntersectionObserver(entries => {
        entries.forEach(e => {
            if (e.isIntersecting) {
                e.target.classList.add('visible');
                revObs.unobserve(e.target);
            }
        });
    }, {
        threshold: 0.12
    });
    revEls.forEach(el => revObs.observe(el));

    function animCount(el, target) {
        let n = 0;
        const step = Math.ceil(target / 55);
        const t = setInterval(() => {
            n += step;
            if (n >= target) {
                n = target;
                clearInterval(t);
            }
            el.textContent = n + '+';
        }, 28);
    }
    const cntObs = new IntersectionObserver(entries => {
        entries.forEach(e => {
            if (e.isIntersecting) {
                animCount(e.target, +e.target.dataset.target);
                cntObs.unobserve(e.target);
            }
        });
    }, {
        threshold: 0.6
    });
    document.querySelectorAll('.stat-num[data-target]').forEach(el => cntObs.observe(el));
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <div id="galleryModal" class="gallery-modal">
        <div class="modal-box">

            <span class="close-btn">&times;</span>

            <div class="image-container">
                <img id="modalImage">
            </div>

            <div class="caption">
                <h4 id="modalTitle"></h4>
                <div id="imageCounter"></div>
            </div>

            <button class="nav prev">&#10094;</button>
            <button class="nav next">&#10095;</button>

            <div id="thumbnailStrip" class="thumbnail-strip"></div>

        </div>
    </div>

    <script>
    let startX = 0;

    // CLICK SLIDER
    $(document).on('click', '.slider-item', function() {

        let sliderId = $(this).data('slider-id');
        let title = $(this).data('title');

        $.ajax({
            url: 'fetch-slider-images.php',
            type: 'POST',
            data: {
                slider_id: sliderId
            },

            success: function(res) {
                images = JSON.parse(res);

                if (!images || images.length === 0) {
                    alert("No images available");
                    return;
                }

                if (images.length === 1) {
                    $('.prev, .next').hide();
                } else {
                    $('.prev, .next').show();
                }

                currentIndex = 0;

                $('#modalTitle').text(title);

                showImage();
                loadThumbs();

                $('#galleryModal').css('display', 'flex');
            }
        });
    });

    // SHOW IMAGE
    function showImage() {
        $('#modalImage')
            .removeClass('zoomed')
            .attr('src', 'assets/img/hero/' + images[currentIndex].image_path);

        $('#imageCounter').text((currentIndex + 1) + " / " + images.length);

        $('.thumbnail-strip img').removeClass('active');
        $(`.thumbnail-strip img[data-index="${currentIndex}"]`).addClass('active');
    }

    // THUMBNAILS
    function loadThumbs() {
        let html = '';
        images.forEach((img, i) => {
            html += `<img src="assets/img/hero/${img.image_path}" 
                          data-index="${i}" 
                          class="${i===0?'active':''}">`;
        });
        $('#thumbnailStrip').html(html);
    }

    // CLICK THUMB
    $(document).on('click', '.thumbnail-strip img', function() {
        currentIndex = $(this).data('index');
        showImage();
    });

    // NEXT / PREV
    $('.next').click(() => {
        currentIndex = (currentIndex + 1) % images.length;
        showImage();
    });

    $('.prev').click(() => {
        currentIndex = (currentIndex - 1 + images.length) % images.length;
        showImage();
    });

    // CLOSE
    $('.close-btn, .gallery-modal').click(function(e) {
        if (e.target !== this) return;
        $('#galleryModal').hide();
    });

    // KEYBOARD
    $(document).keydown(function(e) {
        if (e.key === "Escape") $('#galleryModal').hide();
        if (e.key === "ArrowRight") $('.next').click();
        if (e.key === "ArrowLeft") $('.prev').click();
    });

    // ZOOM CLICK
    $('#modalImage').click(function() {
        $(this).toggleClass('zoomed');
    });

    // SWIPE (MOBILE)
    $('#modalImage').on('touchstart', function(e) {
        startX = e.originalEvent.touches[0].clientX;
    });

    $('#modalImage').on('touchend', function(e) {
        let endX = e.originalEvent.changedTouches[0].clientX;

        if (startX - endX > 50) {
            $('.next').click();
        } else if (endX - startX > 50) {
            $('.prev').click();
        }
    });
    </script>
    <script>
    const year = <?= $year ?>;
    const holidays = <?= json_encode($holidays) ?>;
    </script>

    <script src="calendar.js"></script>

</body>

</html>