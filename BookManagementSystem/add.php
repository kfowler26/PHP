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
<html>
<head>
    <meta charset="UTF-8">
    <title>Bookorama Management System</title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="css/custom.css">
</head>
<?php include "./navMenu.php"; ?>
<body>
<div id="container">
        <div class="jumbotron">
            <h1 class="display-4">Bookorama Management System</h1>
        </div>
    <?php
    if (isset($_POST['submit'])) {

        //Post Variables
        $isbn = $_POST['isbn'];
        $author = $_POST['author'];
        $title = $_POST['title'];
        $price = $_POST['price'];

        //Checks for values, if empty redirects
        if (empty($isbn) || empty($author) || empty($title) || empty($price)) {

            header("location:newBook.php?error=empty");
            exit();

        }

        //Calls DB object
        require_once('config.php');

        //Assigns Variables
        $isbn = $mysqli->real_escape_string($isbn);
        $author = $mysqli->real_escape_string($author);
        $title = $mysqli->real_escape_string($title);
        $price = $mysqli->real_escape_string(doubleval($price));

        //Error Message if the DB is down
        if (mysqli_connect_errno()) {
            echo "Error: Could not connect to database.  Please try again later.";
            exit;
        }

        //Query to insert into DB
        $queryInsert = "INSERT INTO books VALUES (NULL, '" . $isbn . "', '" . $author . "', '" . $title . "', " . $price . ")";
        $result = $mysqli->query($queryInsert);

        //If successful
        if ($result) {

            echo $mysqli->affected_rows . " book inserted into database. <a href='newBook.php'>Add another?</a>";

            //Query to select from DB
            $query = "SELECT * FROM books";
            $result = $mysqli->query($query);
            $num_results = $result->num_rows;

            echo "<p>Number of books found: " . $num_results . "</p>";
            echo "<h2>Bookorama Management System</h2>";
            echo "<table class='table table-bordered table-striped'>";

            //Creates Table if successful
            if ($num_results > 0) {
                $books = $result->fetch_all(MYSQLI_ASSOC);
                echo "<table class='table table-bordered'><tr>";

                foreach ($books[0] as $k => $v) {
                    echo "<th>" . $k . "</th>";
                }
                foreach ($books as $book) {
                    echo "<tr>";
                    foreach ($book as $k => $v) {
                        echo "<td>" . $v . "</td>";
                    }
                    echo "</tr>";
                }

                echo "</table>";
                echo "<a href='index.php'>View All Books</a>";
            }
            //Free results and Closes connection to DB
            $result->free();
            $mysqli->close();
        } else {
            echo "An error has occurred.  The item was not added. <a href='newBook.php'>Try again?</a>";
        }
    } else {
        exit();
    }
    ?>
</div>
</body>
</html>

