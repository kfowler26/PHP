<?php
/*
Modified by: Kendall Fowler
Date: December 12, 2021
Purpose: CIS-2288 Final Exam - Part 1 - Bookorama Management System
Dependencies: none
*/

/* Database credentials. only works for me if I use root/' '*/

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'BOOKS');

//Connect to MySQL database
$mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Checks connection
if ($mysqli === false) {
    die("ERROR: Could not connect. " . $mysqli->connect_error);
}