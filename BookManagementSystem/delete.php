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

//DB connection
require_once('config.php');

//Set Variable
$bookId = "";

//Post to accept Yes
if (isset($_POST["bookId"]) && !empty($_POST["bookId"])) {

    //Post Variables
    $bookId = $_POST['bookId'];

    //Error Handling
    if (!$bookId) {
        echo "You have not entered all the required details.<br />"
            . "Please go back and try again.</body></html>";
        exit;
    }

    //Set Variable
    $bookId = $mysqli->real_escape_string($bookId);

    //Delete SQL Query
    $queryDelete = "Delete from books WHERE id='$bookId'";
    $result = $mysqli->query($queryDelete);

    if ($result) {
        //Ensure value is deleted from linked tables
        $queryDeleteReview = "Delete from book_reviews WHERE isbn='$bookId'";
        $result2 = $mysqli->query($queryDeleteReview);
        if ($result2) { ?>
            <!DOCTYPE html>
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
                <h1>Delete Record</h1>
                <?php echo "Entry Deleted. <a href='index.php'>View all Books</a>"; ?>
            </div>
            </div>
            </body>
            </html>
            <?php
        }
    } else {
        echo "Error! The book was not deleted.";
    }
} else {

    //Error Handling
    if (empty(trim($_GET["bookId"]))) {
        echo "Error. There is no bookID.";
        exit();
    } else {
        if (isset($_GET['bookId']) && !empty($_GET['bookId'])) {
            $bookId = $mysqli->real_escape_string($_GET['bookId']);
        }
        //Select Query
        $query = "SELECT * FROM `books` where books.id=$bookId";
        $result = $mysqli->query($query);
        $num_results = $result->num_rows;
        ?>
        <!DOCTYPE html>
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
        <h1>Delete Record</h1>
        <?php
        if ($num_results > 0) {
            //If successful create Table
            $books = $result->fetch_all(MYSQLI_ASSOC);
            echo "<table class='table table-bordered'><tr>";
            foreach ($books[0] as $k => $v) {
                echo "<th>" . $k . "</th>";
            }
            echo "</tr>";
            foreach ($books as $book) {
                echo "<tr>";
                foreach ($book as $k => $v) {
                    echo "<td>" . $v . "</td>";
                }
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No entries in the database.</p>";
        }
        //Free results and Closes connection to DB
        $result->free();
        $mysqli->close();
    }
    ?>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <input type="hidden" name="bookId" value="<?php echo trim($bookId); ?>"/>
        <div>
            <p>Delete this record?</p>
            <p>
                <input type="submit" value="Yes" class="btn btn-outline-dark btn-block">
                <a href="index.php" class="btn btn-outline-dark btn-block">No</a>
            </p>
        </div>
    </form>
</div>
</body>
    </html>
    <?php
}