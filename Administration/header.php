<?php
session_start();

if (!isset($_SESSION['logged_in'])) {
    header("location:login.php");
}

$connection = mysqli_connect("localhost", "root", "", "badminton_scoring_system");

if (!$connection) {
    die('<center><h1>Unable to connect...!</h1></center>');
}
?>
<html>

<head>
    <title>Administration</title>

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
            border: 0.5px dashed #b7111159;
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

    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/dashboard.css" rel="stylesheet">
    <link href="../css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="../css/draws.css" rel="stylesheet">

    <script src="../js/jquery.js"></script>
    <script src="../js/jqueryvalidation.js"></script>
    <script src="../js/dataTables.min.js"></script>
    <script src="../js/dataTables.bootstrap4.min.js"></script>
    <script src="../js/dataTables.Buttons.min.js"></script>
    <script src="../js/dataTable.Print.js"></script>
    <script src="../js/dataTables.pdfMake.min.js"></script>
    <script src="../js/dataTables.vsf_fonts.min.js"></script>
    <script src="../js/dataTables.buttons.html5.min.js"></script>
    <script src="../js/html2canvas.min.js"></script>
    <script src="../js/jszip.min.js"></script>

</head>

<body>

    <header class="navbar navbar-dark sticky-top bg-primary d-print-none flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="index.php">Administration Panel</a>
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <span class="w-100 text-center"><img src="../images/header-logo-text.png" alt=""></span>
        <ul class="navbar-nav px-3">
            <li class="nav-item text-nowrap">
                <a class="nav-link" href="logout.php">(<?= $_SESSION['admin_name']; ?>) Logout</a>
            </li>
        </ul>
    </header>

    <div class="container-fluid">
        <div class="row">
            <?php include("navigation.php"); ?>