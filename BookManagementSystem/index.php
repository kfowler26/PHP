<?php
/*
Author: Kendall Fowler
Date: December 12, 2021
Purpose: CIS-2288 Final Exam - Part 1 - Bookorama Management System
Dependencies: none
*/

//Starts Session
session_start();

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
<div id="container">
    <div class="jumbotron">
        <h1 class="display-4">Bookorama Management System</h1>
    </div>
    <br>
    <?php
    //DB Connection
    @ $db = new mysqli('localhost', 'root', '', 'books');

    //Error Handling
    if (mysqli_connect_errno()) {
        echo 'Error: Could not connect to database.  Please try again later.</body></html>';
        exit;
    }

    //Display Options by default of title
    $sortBy = " order by books.title asc";

    //Adds other options
    if (isset($_GET['sort'])) {
        $sortBy = " order by {$_GET['sort']} asc";
    }
    //Select Query
    $query = "SELECT id AS 'ID', isbn AS 'ISBN',  author AS 'Author', title AS 'Title', price as 'Price' FROM books $sortBy";
    $result = $db->query($query);
    $num_results = $result->num_rows;

    echo "Number of Books: " . $num_results . "";

    //Results Display
    if ($num_results > 0) {
        $books = $result->fetch_all(MYSQLI_ASSOC);
        //Creates Table
        echo "<table class='table table-bordered'><tr>";
        foreach ($books[0] as $k => $v) {
            if ($k == 'ID') {
                echo "<th>" . $k . "</th>";
            } else {
                //Adds link to sort table by
                echo "<th><a href='?sort=" . $k . "' title='sort by $k'>$k</span></a></th>";
            }
        }
        //Adds Action header if user is logged in
        if (isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"] == true) {
            echo "<th>Action</th>";
        }
        echo "</tr>";

        //Adds row with book content
        foreach ($books as $book) {
            echo "<tr>";
            //Variables to control the Action column iterations
            $i = 0;
            $bookId = "";
            foreach ($book as $k => $v) {
                if ($k == 'ID') {
                    echo "<td>" . $v . "</td>";
                    $bookId = $v;
                } else {
                    echo "<td>" . $v . "</td>";
                }
                //Adds edit and delete functions in column
                if (($i == count($book) - 1) && (isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"] == true)) {
                    echo "<td>";
                    echo "<a href='edit.php?bookId=" . $bookId . "' >Edit</a>";
                    echo "<a> </a>";
                    echo "<a href='delete.php?bookId=" . $bookId . "' >Delete</a>";
                    echo "</td>";
                }
                $i++;
            }
            echo "</tr>";
        }
        echo "</table>";

    } else {
        echo "<p>Sorry there are no entries in the database.</p>";
    }
    //Adds button if session is active
    if (isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"] == true) {
        ?><a class="btn btn-outline-dark btn-block" href="newBook.php" role="button">Add a New Book</a><?php
    }
    //Free results and Closes connection to DB
    $result->free();
    $db->close();
    ?>
</div>
</body>

