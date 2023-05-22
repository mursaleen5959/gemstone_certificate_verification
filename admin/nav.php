<nav class="navbar navbar-expand-lg">
  <div class="container-fluid">
    <a class="navbar-brand" href="#"><?php echo $_SESSION['username']?></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="add_certificate.php">Add Certificate</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="show_certificates.php">Show Certificates</a>
        </li>
        <?php
        if (isset($_SESSION['admin_login'])) {
          echo '<li class="nav-item">
            <a class="nav-link" href="profile.php">Profile</a>
          </li>';
          echo '<li class="nav-item">
            <a class="nav-link" href="logout.php">Logout</a>
          </li>';
        }
        ?>
      </ul>
    </div>
  </div>
</nav>