<?php
session_start();
$connection = mysqli_connect("localhost", "root", "", "badminton_scoring_system");
if (!$connection) {
  die('<center><h1>Unable to connect...!</h1></center>');
}
?>
<html>

<head>
  <title>Badminton Association</title>

  <link rel="icon" href="./images/icon.ico">

  <style>
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      user-select: none;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }

    label.error {
      padding-right: 10px;
      padding-left: 10px;
      margin-top: 5px;
      border: 0.5px solid #b7111159;
      border-radius: 2px;
      color: #b71111d9;
      font-style: italic;
      font-size: 14px;
      background-color: #ff000042;
    }

    label.error::before {
      content: "* ";
    }

    input.error,
    select.error {
      border: 1px solid #b7111159;
    }

    input.valid,
    select.valid {
      border: 1px solid #0080005e;
    }
  </style>

  <link href="./css/bootstrap.min.css" rel="stylesheet">
  <link href="./css/blog.css" rel="stylesheet">
  <link href="./css/dataTables.bootstrap4.min.css" rel="stylesheet">
  <link href="./css/draws.css" rel="stylesheet">

  <script src="./js/jquery.js"></script>
  <script src="./js/jqueryvalidation.js"></script>
  <script src="./js/dataTables.min.js"></script>
  <script src="./js/dataTables.bootstrap4.min.js"></script>
  <script src="./js/dataTables.Buttons.min.js"></script>
  <script src="./js/dataTable.Print.js"></script>
  <script src="./js/dataTables.pdfMake.min.js"></script>
  <script src="./js/dataTables.vsf_fonts.min.js"></script>
  <script src="./js/dataTables.buttons.html5.min.js"></script>
  <script src="./js/html2canvas.min.js"></script>
  <script src="./js/jszip.min.js"></script>

</head>

<body>

  <header class="blog-header d-print-none">
    <center>
      <img src="./images/header-logo.png" alt="">
      <img src="./images/header-logo-text.png" alt="">
      <img src="./images/header-right-2.png" alt="">
    </center>
  </header>

  <div class="container">
    <nav class="navbar navbar-expand navbar-light d-print-none">
      <div class="container-fluid">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="index.php">Home</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Players
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="player_registration.php">Registration form</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item" href="#">Player Rankings</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item" href="player_profiles.php">Player Profiles</a></li>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="tournaments.php" tabindex="-1" aria-disabled="true">Tournaments</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#" tabindex="-1" aria-disabled="true">Calendars</a>
          </li>
        </ul>
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">

          <?php if (isset($_SESSION['logged_in'])) { ?>
            <li class="nav-item dropdown">
              <a class="nav-link active dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <?= $_SESSION['player_name'] ?>
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="player_registration_review.php?player_id=<?= base64_encode($_SESSION['player_id']); ?>">My Profile</a></li>
                <li>
                  <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="change_password.php">Change Password</a></li>
                <li>
                  <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="logout.php">Logout</a></li>
              </ul>
            <?php } else { ?>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="login.php">Login</a>
            </li>
          <?php } ?>

        </ul>
      </div>
    </nav>