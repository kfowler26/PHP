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

if (isset($_GET['bookId'])) {

    //Set Variable from URL
    $bookId = $_GET['bookId'];

    //Connect to DB
    require("config.php");

    $bookId = $mysqli->real_escape_string($bookId);

    //Edit Query
    $query = "SELECT * FROM books WHERE books.id = $bookId";
    $result = $mysqli->query($query);
    $num_results = $result->num_rows;

    //Error Handling
    if ($num_results == 0) {
        $message = "Book not found.";
    } else {
        //Assign Variables
        $row = $result->fetch_assoc();
        $isbn = $row['isbn'];
        $title = $row['title'];
        $author = $row['author'];
        $price = $row['price'];
    }
//Free results and Closes connection to DB
    $result->free();
    $mysqli->close();
} else {
    $message = "Sorry, no id provided.";
}
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
    <h1>Bookorama Management System</h1>
    <h2>Edit Book</h2>
    <?php
    if (isset($message)) {
        echo $message;
    } else {
        ?>
        <div>
            <form action="update.php" method="post">
                <div class="form-group">
                    <label for="isbn">ISBN (format 0-672-31509-2):</label>
                    <input type="text" class="form-control" id="isbn" value='<?php echo $isbn ?>'
                           placeholder="Enter book isbn" name="isbn">
                </div>
                <div class="form-group">
                    <label for="author">Author:</label>
                    <input type="text" class="form-control" id="author" value='<?php echo $author ?>'
                           placeholder="Enter book author" name="author">
                </div>
                <div class="form-group">
                    <label for="title">Title:</label>
                    <input type="text" class="form-control" id="title" value='<?php echo $title ?>'
                           placeholder="Enter book title" name="title">
                </div>
                <div class="form-group">
                    <label for="price">Price $</label>
                    <input type="text" class="form-control" id="price" value='<?php echo $price ?>'
                           placeholder="Enter book price" name="price">
                </div>
                <div class="form-group">
                    <input type="hidden" class="form-control" id="bookId" value='<?php echo $bookId ?>' name="bookId">
                    <br>
                    <button type="submit" name="submit" class="btn btn-outline-dark btn-block">Update Entry</button>
                </div>
            </form>
        </div>
        <?php
    }
    ?>
</body>
</html>

