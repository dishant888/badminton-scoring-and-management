<?php
$activePage = basename($_SERVER['PHP_SELF'], ".php");
?>
<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse d-print-none">
    <div class="position-sticky pt-3">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link <?= ($activePage == "index") ? "active" : "" ?>" aria-current="page" href="index.php">
                    <span data-feather="home"></span>
                    Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= ($activePage == "players") ? "active" : "" ?>" href="players.php">
                    <span data-feather="users"></span>
                    Players
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= ($activePage == "tournaments") ? "active" : "" ?>" href="tournaments.php">
                    <span data-feather="file-text"></span>
                    Tournaments
                </a>
            </li>
        </ul>
    </div>
</nav>