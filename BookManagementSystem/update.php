<?php
/*
Author: Kendall Fowler
Date: December 12, 2021
Purpose: CIS-2288 Final Exam - Part 1 - Bookorama Management System
Dependencies: none
*/
//Starts Session
session_start();

//Checks if logged in
require_once('checkLogin.php');
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Bookorama Management System</title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="css/custom.css">
</head>
<?php include "./navMenu.php"; ?>
<body>
<body>
<div id="container">
    <h1>Bookorama Management System</h1>
    <br>
    <?php

    //Variables
    $bookId = $_POST['bookId'];
    $isbn = $_POST['isbn'];
    $author = $_POST['author'];
    $title = $_POST['title'];
    $price = $_POST['price'];

    //Error Handling
    if (empty($isbn) || empty($author) || empty($title) || empty($price)) {
        echo "You have not entered all the required details.<br />"
            . "Please go back and try again.</body></html>";
        exit;
    }

    //DB Connection
    require("config.php");

    //Set Variables
    $isbn = $mysqli->real_escape_string($isbn);
    $author = $mysqli->real_escape_string($author);
    $title = $mysqli->real_escape_string($title);
    $price = $mysqli->real_escape_string(doubleval($price));

    //Update query
    $query = "UPDATE books SET isbn='$isbn', title='$title', author='$author', price=$price WHERE id=$bookId LIMIT 1";
    $result = $mysqli->query($query);


    if ($result) {
        echo $mysqli->affected_rows . " book updated in database. <a href='index.php'>View all Books</a>";
        //Select Query
        $query = "SELECT * FROM `books` where books.id=$bookId";
        $result = $mysqli->query($query);
        $num_results = $result->num_rows;

        if ($num_results > 0) {
            //Creates Table
            $books = $result->fetch_all(MYSQLI_ASSOC);

            echo "<table class='table table-bordered'><tr>";

            foreach ($books[0] as $k => $v) {
                echo "<th>" . $k . "</th>";
            }
            echo "</tr>";
            //Create a new row for each book
            foreach ($books as $book) {
                echo "<tr>";
                foreach ($book as $k => $v) {
                    echo "<td>" . $v . "</td>";
                }
                echo "</tr>";
            }
            echo "</table>";
        } else {

            echo "<p>Sorry there are no entries in the database.</p>";
        }
        //Free results and Closes connection to DB
        $result->free();
        $mysqli->close();
    } else {
        echo "Error! The book entry was not updated.";
    }
    ?>
</div>
</body>

