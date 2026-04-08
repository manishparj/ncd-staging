<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>ICMR-NIIRNCD Jodhpur</title>

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@400;500;600;700&family=Noto+Sans+Devanagari:wght@400;600;700&family=Source+Sans+3:wght@300;400;600&display=swap" rel="stylesheet"/>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>

  <!-- Header Stylesheet -->
  <link rel="stylesheet" href="config/header.css"/>
</head>
<body>

<!-- ════════════════════════════════
     TOP UTILITY BAR
     ════════════════════════════════ -->
<div class="top-bar">
  <div class="top-bar-inner">

    <!-- Toggle Button -->
    <div class="toggle-btn">
      <i class="fa fa-universal-access"></i>
    </div>

    <!-- Content -->
    <div class="top-bar-right">
      <div class="font-btns">
        <button id="btn1" title="Increase font size">A+</button>
        <button id="btn2" title="Default font size">A</button>
        <button id="btn3" title="Decrease font size">A-</button>
      </div>

      <select class="lang-select" onchange="if(this.value) window.location.href=this.value">
        <option value="index.php">English</option>
        <option value="hindex.php">हिंदी</option>
      </select>
    </div>

  </div>
</div>


<!-- ════════════════════════════════
     BRAND / IDENTITY STRIP
     ════════════════════════════════ -->
<div class="brand-strip">
  <div class="brand-inner">

    <div class="brand-logo">
      <a href="index.php">
        <img src="assets/img/logo/logo3.jpg" alt="ICMR-NIIRNCD Logo"
             onerror="this.style.display='none'; this.nextElementSibling.style.display='flex'"/>
        <div class="logo-fallback">ICMR</div>
      </a>
    </div>

    <div class="brand-text">
      <h1>राष्ट्रीय असंचारी रोग कार्यान्वयन अनुसंधान संस्थान, जोधपुर</h1>
      <h2>National Institute for Implementation Research on Non-Communicable Diseases, Jodhpur</h2>
    </div>

  </div>
</div>


<!-- ════════════════════════════════
     STICKY NAVBAR
     ════════════════════════════════ -->
<div class="navbar-wrap">
  <div class="navbar-inner">

    <button class="hamburger" id="hamburger" aria-label="Toggle navigation" aria-expanded="false">
      <span></span><span></span><span></span>
    </button>

    <ul class="nav-list" id="navList">

      <li><a href="index.php">Home</a></li>

      <li>
        <a href="#" role="button">About Us <i class="fa fa-chevron-down caret"></i></a>
        <ul class="dropdown">
          <li><a href="about-niirncd.php">ICMR-NIIRNCD</a></li>
          <li><a href="dgicmr.php">Director General ICMR</a></li>
          <li><a href="about-director.php">Director Profile</a></li>
          <li><a href="about-mrhrubk.php">MRHRU – Field Unit</a></li>
          <li><a href="our-team.php">Our Team</a></li>
          <li><a href="organogram.php">Our Organogram</a></li>
          <li><a href="committee.php">Our Committee</a></li>
          <li><a href="leadership.php">Meet the Leadership</a></li>
          <li><a href="former-directors.php">Former Directors</a></li>
        </ul>
      </li>

      <li>
        <a href="#" role="button">Research <i class="fa fa-chevron-down caret"></i></a>
        <ul class="dropdown">
          <li><a href="research.php">Research</a></li>
          <li><a href="publications.php">Publications</a></li>
          <li><a href="annual-report.php">Annual Reports</a></li>
        </ul>
      </li>

      <li>
        <a href="#" role="button">Notifications <i class="fa fa-chevron-down caret"></i></a>
        <ul class="dropdown">
          <li><a href="recruitment.php">Career Opportunity</a></li>
          <li><a href="tenders.php">Tenders</a></li>
        </ul>
      </li>

      <li>
        <a href="#" role="button">Employee Corner<i class="fa fa-chevron-down caret"></i></a>
        <ul class="dropdown">
          <li><a href="https://icmr.eoffice.gov.in/" target="_blank">eOffice</a></li>
          <li><a href="https://www.niirncd.org/salary_slip">eSalary Slip Generation</a></li>
          <li><a href="https://www.niirncd.org/esalary">eSalary Software</a></li>
          <li><a href="https://mail.gov.in">Gov Email</a></li>
          <li><a href="./sci-admin/">Scientists Panel</a></li>
          <li><a href="viewform.php">Forms</a></li>
          <li><a href="viewcircular.php">Circular</a></li>
        </ul>
      </li>

      <li>
        <a href="#" role="button">Media <i class="fa fa-chevron-down caret"></i></a>
        <ul class="dropdown">
           <li><a href="events.php">Events</a></li>
          <li><a href="photogallery.php">Photo Gallery</a></li>
        </ul>
      </li>

      <li>
        <a href="#" role="button">Links <i class="fa fa-chevron-down caret"></i></a>
        <ul class="dropdown">
          <li><a href="http://www.icmr.gov.in/" target="_blank" rel="noopener">ICMR &nbsp;<i class="fa fa-external-link-alt fa-xs"></i></a></li>
          <li><a href="http://www.dhr.gov.in/" target="_blank" rel="noopener">Department of Health Research &nbsp;<i class="fa fa-external-link-alt fa-xs"></i></a></li>
          <li><a href="https://www.mohfw.gov.in/" target="_blank" rel="noopener">Ministry of Health &amp; Family Welfare &nbsp;<i class="fa fa-external-link-alt fa-xs"></i></a></li>
          <li><a href="calendar.php">Calendar 2026</a></li>
          <li><a href="rti-act.php">RTI</a></li>
          <li><a href="screen-reader-help.php">Screen Reader</a></li>
        </ul>
      </li>

      <li>
        <a href="#" role="button">Contact <i class="fa fa-chevron-down caret"></i></a>
        <ul class="dropdown">
          <li><a href="contact.php">Contact Us</a></li>
          <li><a href="directory.php">Staff Directory</a></li>
        </ul>
      </li>

    </ul>

    <div class="nav-badge">
     <form action="https://www.google.com/search" method="get" target="_blank" onsubmit="return combineQuery()">
  
  <div style="position:relative; width:260px;">
    
    <!-- Search Icon -->
    <span style="
      position:absolute;
      left:10px;
      top:50%;
      transform:translateY(-50%);
      font-size:16px;
      color:#888;
    ">🔍</span>

    <!-- Input Field -->
    <input 
      type="text" 
      id="searchBox"
      placeholder="Search NIIRNCD website..."
      style="
        padding:10px 10px 10px 30px;
        width:100%;
        border-radius:20px;
        border:1px solid #ccc;
        outline:none;
      "
    >

  </div>

  <!-- Hidden query -->
  <input type="hidden" name="q" id="finalQuery">

</form>

<script>
function combineQuery() {
  var input = document.getElementById("searchBox").value;
  document.getElementById("finalQuery").value = "site:https://niirncd.icmr.org.in/ " + input;
  return true;
}
</script>
    </div>

  </div>
</div>

<div class="overlay" id="overlay"></div>


<!-- ════════════════════════════════
     SCRIPTS
     ════════════════════════════════ -->
<script>
  const ham     = document.getElementById('hamburger');
  const navL    = document.getElementById('navList');
  const overlay = document.getElementById('overlay');

  function closeDrawer() {
    ham.classList.remove('open');
    navL.classList.remove('open');
    overlay.classList.remove('show');
    ham.setAttribute('aria-expanded', 'false');
  }

  ham.addEventListener('click', () => {
    const isOpen = navL.classList.toggle('open');
    ham.classList.toggle('open');
    overlay.classList.toggle('show', isOpen);
    ham.setAttribute('aria-expanded', String(isOpen));
  });

  overlay.addEventListener('click', closeDrawer);

  navL.querySelectorAll('li').forEach(li => {
    const sub = li.querySelector('.dropdown');
    if (!sub) return;
    li.querySelector('a').addEventListener('click', e => {
      if (window.innerWidth <= 900) {
        e.preventDefault();
        navL.querySelectorAll('li.mob-open').forEach(other => {
          if (other !== li) other.classList.remove('mob-open');
        });
        li.classList.toggle('mob-open');
      }
    });
  });

  const root = document.documentElement;
  let basePx = 16;
  document.getElementById('btn1').addEventListener('click', () => {
    basePx = Math.min(basePx + 2, 22); root.style.fontSize = basePx + 'px';
  });
  document.getElementById('btn2').addEventListener('click', () => {
    basePx = 16; root.style.fontSize = '16px';
  });
  document.getElementById('btn3').addEventListener('click', () => {
    basePx = Math.max(basePx - 2, 12); root.style.fontSize = basePx + 'px';
  });
</script>

<script>
const toggleBtn = document.querySelector('.toggle-btn');
const panel = document.querySelector('.top-bar-inner');

toggleBtn.addEventListener('click', function (e) {
  e.stopPropagation();
  panel.classList.toggle('open');
});

/* Optional: close when clicking outside */
document.addEventListener('click', function(e){
  if(!panel.contains(e.target)){
    panel.classList.remove('open');
  }
});
</script>

</body>
</html>