<?php
include('config/config.php');
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
    <link rel="stylesheet" href="assets/css/templete.css">

    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="stylenav.css">
    <link rel="stylesheet" href="assets/datatables/dataTables.bootstrap4.css">
    <style>
                table th, table td {
                    font-size: 0.95rem;
                    vertical-align: middle;
                }

                h5 {
                    font-weight: 600;
                    color: #0b5ed7;
                }

                @media (max-width: 768px) {
                    table th, table td {
                        font-size: 0.85rem;
                    }
                }

                #memberSearch {
                    border-radius: 8px;
                }

                .table-responsive h5 {
                    margin-top: 30px;
                    font-weight: 600;
                    color: #0b5ed7;
                }

                .form-select,
                .form-control {
                    border-radius: 8px;
                }

                label {
                    font-size: 0.95rem;
                }

    </style>

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

    <?php
        $committees = [
                "cwac" => [
                    "title" => "Capital Works Advisory Committee (CWAC)",
                    "columns" => ["Sl. No.", "Name & Designation", "Role"],
                    "members" => [
                        ["Dr. Sandeep Kumar Yadav, Professor, Dept. of Electrical Engineering, IIT Jodhpur (Electrical Expert)", "Chairperson"],
                        ["Dr. Pardeep Kumar Dammala, Assistant Professor, Dept. of Civil & Infrastructure Engineering, IIT Jodhpur (Civil Expert)", "External Member"],
                        ["Dr. Manish Kumar, Professor, Dept. of Production & Industrial Engineering, MBM University, Jodhpur (Mechanical Expert)", "External Member"],
                        ["Dr. Rajesh Sharma, Head, Dept. of Architecture & T.P., MBM Jodhpur (Architect Expert)", "External Member"],
                        ["Prof. (Dr.) Pankaj Bhardwaj, Director, ICMR-NIIRNCD, Jodhpur", "Member"],
                        ["Dr. P. K. Anand, Scientist-F, NIIRNCD, Jodhpur", "Member"],
                        ["Sh. Dinesh Soni, Sr. Administrative Officer, NIIRNCD, Jodhpur", "Member"],
                        ["Sh. Om Prakash, Accounts Officer, NIIRNCD, Jodhpur", "Member"],
                        ["Dr. Anil Purohit, STO-III, NIIRNCD, Jodhpur", "Member Secretary"],
                        ["Representatives of the Executing Agency", "Invitees"]
                    ]
                ],
                "cwmc" => [
                    "title" => "Capital Works Monitoring Committee (CWMC)",
                    "columns" => ["Sl. No.", "Name & Designation", "Role"],
                    "members" => [
                        ["Dr. P. K. Anand, Scientist-F, NIIRNCD", "Chairperson"],
                        ["Dr. Sandeep Kumar Yadav, Professor, IIT Jodhpur", "External Member"],
                        ["Dr. Rajesh Sharma, Head, Dept. of Architecture & T.P., MBM Jodhpur", "External Member"],
                        ["Sh. Dinesh Soni, Sr. Administrative Officer", "Member"],
                        ["Sh. Om Prakash, Accounts Officer", "Member"],
                        ["Dr. Anil Purohit, STO-III", "Member Secretary"],
                        ["Representatives of the Executing Agency", "Invitees"]
                    ]
                ],
                "academic" => [
                    "title" => "Academic Committee",
                    "columns" => ["Sl. No.", "Name & Designation", "Role"],
                    "members" => [
                        ["Dr. P. K. Anand, Scientist-F", "Chairperson"],
                        ["Dr. Mukti Khetan, Scientist-C", "Member"],
                        ["Dr. Janesh Kumar Gautam, Scientist-C", "Academic Officer & Member"],
                        ["Dr. Rina Kumawat, Scientist-C", "Member"],
                        ["Sh. Utkarsh Trivedi, Technician-I", "Member Secretary"]
                    ]
                ],
                "it" => [
                    "title" => "IT & Website Committee",
                    "columns" => ["Sl. No.", "Name & Designation", "Role"],
                    "members" => [
                        ["Dr. Ramesh Kumar Sangwan, Scientist-C", "Chairperson"],
                        ["Sh. Pankaj Kumar, TO-B", "Member"],
                        ["Sh. Rajnish Gupta, TO-A", "Member"],
                        ["Sh. Haresh Jadhav, Section Officer", "Member"],
                        ["Dr. Kanchan Bala, JHO", "Member"],
                        ["Sh. Manish Prajapati, TS (CS/IT)", "Member Secretary"]
                    ]
                ],
                "sports" => [
                    "title" => "Sports Committee",
                    "columns" => ["Sl. No.", "Name & Designation", "Role"],
                    "members" => [
                        ["Dr. Ramesh Kumar Huda, Scientist-C", "Chairperson"],
                        ["Shri Haresh Jadhav, Section Officer", "Member"],
                        ["Ms. Shakshi Dahiya, Technical Assistant", "Member"],
                        ["Shri Bhanwar Manohar Singh, Technician-I", "Member"],
                        ["Shri Narendra Kumar, UDC", "Member Secretary"]
                    ]
                ],

                "transport" => [
                    "title" => "Transport Committee",
                    "columns" => ["Sl. No.", "Name & Designation", "Role / Responsibility"],
                    "members" => [
                        ["Dr. P. K. Anand, Scientist-F", "Chairperson"],
                        ["Dr. Chet Ram Meena, TO-C", "Member & Transport In-charge"],
                        ["Ms. Shakshi Dahiya, TA", "Member"],
                        ["Sh. Haresh Jadhav, Section Officer", "Member Secretary"]
                    ]
                ],
                "security" => [
                    "title" => "Security & Fire Safety Committee",
                    "columns" => ["Sl. No.", "Name & Designation", "Role / Responsibility"],
                    "members" => [
                        ["Dr. Suresh Yadav, Scientist-C", "Chairperson"],
                        ["Dr. Anil Purohit, STO-III", "Member"],
                        ["Shri K. L. Sharma, MSW", "Member & Security In-charge"],
                        ["Shri Chetan Singh Gohil, Technician-I (ES)", "Member"],
                        ["Shri Mayur Sankhala, Technician-I", "Member Secretary"]
                    ]
                ],
                "guesthouse" => [
                    "title" => "Guest House Management Committee (GHMC)",
                    "columns" => ["Sl. No.", "Name & Designation", "Role"],
                    "members" => [
                        ["Dr. Janesh Kumar Gautam, Scientist-C", "Chairperson"],
                        ["Dr. Kanchan Bala, Junior Health Officer", "Member"],
                        ["Mr. Trilok Kumar, Technician-I", "Member"],
                        ["Shri Pankaj Sharma, Personal Assistant", "Member Secretary"],
                        ["Sh. Rahul Ranjan, Lab Attendant", "Member & Guest House Caretaker"]
                    ]
                ],
                "room" => [
                    "title" => "Central Room Allotment Committee",
                    "columns" => ["Sl. No.", "Name & Designation", "Role"],
                    "members" => [
                        ["Prof. (Dr.) Pankaj Bhardwaj, Director", "Chairperson"],
                        ["Dr. P. K. Anand, Scientist-F", "Member"],
                        ["Dr. S. S. Mohanty, Scientist-F", "Member"],
                        ["Dr. Mukti Khetan, Scientist-C", "Member"],
                        ["Dr. Anil Purohit, STO-III", "Member"],
                        ["Shri Haresh Jadhav, Section Officer", "Member Secretary"]
                    ]
                ],
                "icc" => [
                    "title" => "Internal Complaints Committee (ICC)",
                    "columns" => ["Sl. No.", "Name & Designation", "Role"],
                    "members" => [
                        ["Dr. Mukti Khetan, Scientist-C, NIIRNCD", "Chairperson"],
                        ["Dr. Sunita Chaudhary, Director, Ek Khwahish Education Foundation, Sikar", "Member"],
                        ["Dr. Swati Chhabra, Addl. Professor of Anesthesiology, AIIMS, Jodhpur", "Member"],
                        ["Dr. Ramesh Kumar Sangwan, Scientist-C & Social Scientist, NIIRNCD", "Member"],
                        ["Ms. Sakshi Dahiya, Technical Assistant (Anthropology), NIIRNCD", "Member"],
                        ["Mr. K. C. Ramayya Dora, Administrative Officer, NIIRNCD", "Member Secretary"]
                    ]
                    ],
                    "moumoa" => [
                    "title" => "MoU/MoA committee of ICMR-NIIRNCD, Jodhpur and MRHRU Jaipur",
                    "columns" => ["Sl. No.", "Name & Designation", "Role"],
                    "members" => [
                        ["Dr. Janesh Kumar Gautam, Scientist-C, NIIRNCD", "Chairperson"],
                        ["Dr. Mukti Khetan  Scientist-C, NIIRNCD", "Co-Chairperson"],
                        ["Sh. Pankaj Kumar, TО-В, NIIRNCD", "Member Secretary"],
                        ["Sr. Admin. Officer / Admin Officer, NIIRNCD", "Member"],
                        ["Accounts Officer, NIIRNCD", "Member"],
                    ]
                    ],
                    "medical" => [
                    "title" => "Medical committee",
                    "columns" => ["Sl. No.", "Name & Designation", "Role"],
                    "members" => [
                        ["Dr. P. K. Anand, Scientist-F, NIIRNCD, Jodhpur", "Chairperson"],
                        ["Dr. Janesh Kumar Gautam, Scientist-C, NIIRNCD", "Member"],
                        ["Dr. Rina Kumawat, Scientist-C, NIIRNCD", "Member"],
                        ["Sh. Haresh Jadhav, Section Officer", "Member"],
                    ]
                ]
        ];
    ?>

    <main>

        <!-- slider Area Start-->
        <div class="slider-area">
            <!-- Mobile Menu -->
            <div class="single-slider slider-height2 d-flex align-items-center" style="background-image:url(assets/img/hero/services_hero.jpg);">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="hero-cap text-center">
                                <h2>Committee</h2>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- slider Area End-->
        <div class="section-full bg-light py-4">
            <div class="container">
                <div class="row justify-content-center">

                <div class="row mb-4 align-items-end">
            
            <!-- Committee Dropdown -->
            <div class="col-lg-6 col-md-6 col-sm-12 mb-2">
                <label class="fw-bold mb-1">Select Committee</label>
                <select class="form-select" id="committeeSelect" onchange="showCommittee()">
                    <option value="">-- Select Committee --</option>
                    <option value="all" selected>All Committees</option>
                    <?php foreach ($committees as $key => $committee): ?>
                        <option value="<?= $key ?>"><?= $committee['title'] ?></option>
                    <?php endforeach; ?>
                </select>

            </div>

            <!-- Search Box -->
            <div class="col-lg-6 col-md-6 col-sm-12 mb-2">
                <label class="fw-bold mb-1">Search Members</label>
                <input type="text"
                    id="memberSearch"
                    class="form-control"
                    placeholder="Search by name / designation / role..."
                    onkeyup="searchMembers()">
            </div>

        </div>


        <?php foreach ($committees as $key => $committee): ?>
            <div class="table-responsive d-none" id="<?= $key ?>">
                <h5 class="mb-3"><?= $committee['title'] ?></h5>
                <table class="table table-bordered table-striped align-middle">
                    <thead class="table-primary">
                        <tr>
                            <?php foreach ($committee['columns'] as $col): ?>
                                <th><?= $col ?></th>
                            <?php endforeach; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($committee['members'] as $index => $member): ?>
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <td><?= $member[0] ?></td>
                                <td><?= $member[1] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endforeach; ?>

        </div>
    </div>
</div>


    </main>
    <footer>
        <!-- Footer Start-->

        <!-- footer-bottom aera -->
		<?php include('./config/footer.php'); ?>

        <!-- Footer End-->
    </footer>

    <!-- JS here -->

    <!-- All JS Custom Plugins Link Here here -->
    <script src="./assets/js/vendor/modernizr-3.5.0.min.js"></script>

    <!-- Jquery, Popper, Bootstrap -->
    <script src="./assets/js/vendor/jquery-1.12.4.min.js"></script>
    <script src="./assets/js/popper.min.js"></script>
    <script src="./assets/js/bootstrap.min.js"></script>
    <!-- Jquery Mobile Menu -->
    <script src="./assets/js/jquery.slicknav.min.js"></script>

    <!-- Jquery Slick , Owl-Carousel Plugins -->
    <script src="./assets/js/owl.carousel.min.js"></script>
    <script src="./assets/js/slick.min.js"></script>

    <!-- One Page, Animated-HeadLin -->
    <script src="./assets/js/wow.min.js"></script>
    <script src="./assets/js/animated.headline.js"></script>
    <script src="./assets/js/jquery.magnific-popup.js"></script>

    <!-- Scrollup, nice-select, sticky -->
    <script src="./assets/js/jquery.scrollUp.min.js"></script>
    <script src="./assets/js/jquery.nice-select.min.js"></script>
    <script src="./assets/js/jquery.sticky.js"></script>

    <!-- contact js -->
    <script src="./assets/js/contact.js"></script>
    <script src="./assets/js/jquery.form.js"></script>
    <script src="./assets/js/jquery.validate.min.js"></script>
    <script src="./assets/js/mail-script.js"></script>
    <script src="./assets/js/jquery.ajaxchimp.min.js"></script>

    <!-- Jquery Plugins, main Jquery -->
    <script src="./assets/js/jquery-2.2.4.min.js"></script>
    <script src="./assets/js/plugins.js"></script>
    <script src="./assets/js/main.js"></script>
    <script src="./assets/js/active.js"></script>

    <script src="./assets/js/datatables-demo.js"></script>
    <script src="./assets/datatables/jquery.dataTables.min.js"></script>
    <script src="./assets/datatables/dataTables.bootstrap4.min.js"></script>


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

		});
	</script>
    <script>
document.addEventListener("DOMContentLoaded", function () {
    showCommittee(); // show all committees by default
});
</script>
  <script>
    function showCommittee() {
        const selected = document.getElementById('committeeSelect').value;
        const tables = document.querySelectorAll('.table-responsive');

        tables.forEach(table => table.classList.add('d-none'));

        if (selected === "all") {
            tables.forEach(table => table.classList.remove('d-none'));
        } else if (selected) {
            document.getElementById(selected).classList.remove('d-none');
        }

        // Reset search on change
        document.getElementById('memberSearch').value = "";
        searchMembers();
    }

    function searchMembers() {
        const filter = document.getElementById("memberSearch").value.toLowerCase();
        const tables = document.querySelectorAll(".table-responsive");

        tables.forEach(table => {
            const rows = table.querySelectorAll("tbody tr");
            let hasVisibleRow = false;

            rows.forEach(row => {
                const text = row.innerText.toLowerCase();
                if (text.includes(filter)) {
                    row.style.display = "";
                    hasVisibleRow = true;
                } else {
                    row.style.display = "none";
                }
            });

            // Hide table if no matching rows
            table.style.display = hasVisibleRow ? "" : "none";
        });
    }
</script>



</body>

</html>
