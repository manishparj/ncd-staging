<!-- FOOTER -->
<footer>
  <div class="footer-area">
    <div class="container-fluid">

      <div class="footer-grid">

        <!-- Column 1 -->
        <div class="footer-col">
          <h4 class="footer-title">Social Media</h4>
          <div class="footer-divider"></div>

          <div class="footer-social">
            <a href="#"><i class="fab fa-facebook-f"></i></a>
            <a href="#"><i class="fab fa-x-twitter"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fab fa-linkedin"></i></a>
          </div>
        </div>

        <!-- Column 2 -->
        <div class="footer-col">
          <h4 class="footer-title">Useful Links</h4>
          <div class="footer-divider"></div>

          <ul class="footer-links horizontal-links">
            <li><a href="#">About Us</a></li>
            <li><a href="#">Our Team</a></li>
            <li><a href="#">Career</a></li>
            <li><a href="#">Employee Corner</a></li>
            <li><a href="#">RTI</a></li>
            <li><a href="#">Tenders</a></li>
          </ul>
        </div>

        <!-- Column 3 -->
        <div class="footer-col">
          <h4 class="footer-title">Information</h4>
          <div class="footer-divider"></div>

          <ul class="footer-info horizontal-links">
            <li>
              <i class="fas fa-sync-alt"></i>
              <div>
                <strong>Last Updated</strong>
                <span>
                  <?php
                  $sql = "SELECT * from web_last_update_date";
                  $query = $dbh->prepare($sql);
                  $query->execute();
                  $results = $query->fetchAll(PDO::FETCH_OBJ);
                  if ($query->rowCount() > 0) {
                      foreach ($results as $result) {
                          echo date_format(date_create_from_format('Y-m-d', $result->date), 'd/m/Y');
                      }
                  }
                  ?>
                </span>
              </div>
            </li>

            <li>
              <i class="fas fa-globe"></i>
              <div>
                <strong>Visitor Count</strong>
                <span id="visitorCount">Loading...</span>
              </div>
            </li>
          </ul>
        </div>

      </div>

      <!-- Bottom Bar -->
      <div class="footer-bottom">
        <div>
          © <span id="copyrightYear"></span>
          <strong>ICMR-NIIRNCD Jodhpur</strong>. All rights reserved.
        </div>
      </div>

    </div>
  </div>
</footer>

<script>
// Dynamic Year
document.getElementById('copyrightYear').textContent = new Date().getFullYear();

// Visitor Counter Demo
document.addEventListener('DOMContentLoaded', function () {
  let count = localStorage.getItem('visitorCount');
  if (!count) {
    count = Math.floor(Math.random() * 50000) + 10000;
    localStorage.setItem('visitorCount', count);
  }
  document.getElementById('visitorCount').textContent = parseInt(count).toLocaleString();
});
</script>