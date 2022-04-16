<?php
/*
Author: Class Example
Date: December 12, 2021
Purpose: CIS-2288 Final Exam - Part 1 - Bookorama Management System
Dependencies: none
*/
// Checks for logged-in session
if (!isset($_SESSION['loggedIn']) || !$_SESSION['loggedIn']) {
    header("Location: login.php?message=notLoggedIn");
    exit;
}
