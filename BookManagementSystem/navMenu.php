<?php
/*
Author: Kendall Fowler
Class: CIS-2288
Date: December 12, 2021
Purpose: CIS-2288 Final Exam - Part 1 - Bookorama Management System
*/
?>
<nav class="navbar  navbar-light bg-light">
    <a class="navbar-brand" href="index.php">Bookorama Management System</a>
    <ul class="nav justify-content-center">
        <li class="nav-item ">
            <?php
            if (!isset($_SESSION['loggedIn']) || !$_SESSION['loggedIn']) {
                ?> <a></a><?php
            } else {
                $userName = $_SESSION["username"];
                ?> <a>Logged In User: <?php echo $userName ?></a>
                <?php
            }
            ?>
        </li>
    </ul>
    <ul class="nav justify-content-end">
        <li class="nav-item ">
            <?php
            if (!isset($_SESSION['loggedIn']) || !$_SESSION['loggedIn']) {
                ?> <a class="nav-link" href="login.php">Log In</a><?php
            } else {
                ?> <a class="nav-link" href="logout.php">Log Out</a>
                <?php
            }
            ?>
        </li>
    </ul>
</nav>
