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
<div id="container">
    <h2> Add a New Book</h2>
    <div class="newBook-form">
        <form action="add.php" method="post">
            <?php
            $msg = "";
            //Error Handling
            if (isset($_GET["error"])) {
                if ($_GET["error"] == 'empty') {
                    $msg = "Please enter all the required information.";
                } else if ($_GET["error"] == 'db') {
                    $msg = "DB error.Book not added.";
                } else if ($_GET["error"] == 'noform') {
                    $msg = "You must complete the form.";
                }
            }
            echo "<p class='error'>$msg</p>";
            ?>
            <div class="form-group">
                <label for="isbn">ISBN (format 0-672-31509-2):</label>
                <input type="text" class="form-control" id="isbn" placeholder="Enter ISBN" name="isbn">
            </div>
            <div class="form-group">
                <label for="author">Author:</label>
                <input type="text" class="form-control" id="author" placeholder="Enter Author" name="author">
            </div>
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" class="form-control" id="title" placeholder="Enter Title" name="title">
            </div>
            <div class="form-group">
                <label for="price">Price:</label>
                <input type="text" class="form-control" id="price" placeholder="Enter Price" name="price">
            </div>
            <div class="form-group">
                <br>
                <button type="submit" name="submit" class="btn btn-outline-dark btn-block">Add Book</button>
            </div>
            </fieldset>
        </form>
    </div>
</body>
</html>