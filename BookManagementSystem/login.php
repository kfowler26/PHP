<?php
/*
Author: Kendall Fowler
Date: December 12, 2021
Purpose: CIS-2288 Final Exam - Part 1 - Bookorama Management System
Dependencies: none
*/
//Starts Session
session_start();
if (!isset($_POST['submit'])) {
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Bookorama Management System</title>
        <link href="css/bootstrap.css" rel="stylesheet">
        <link rel="stylesheet" href="css/custom.css">
    </head>
    <?php include "./navMenu.php"; ?>
    <body>
    <div id="container">
        <div class="row">
            <div class="col-sm-2">
            </div>
            <div class="col-sm-2">
            </div>
            <div class="col-sm-8">
                <div class="card w-50">
                    <div class="logScreen">
                        <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                            <h2>Log in</h2>
                            <?php if (isset($_GET["message"])) {
                                //Error message handling
                                if ($_GET["message"] == "loginError") {
                                    echo '<p id="error" style="color: red;">Invalid Login</p>';
                                }
                            }
                            ?>
                            <br>
                            <div class="form-group">
                                <input type="text" name="username" class="form-control" placeholder="Username"
                                       required="required">
                            </div>
                            <div class="form-group">
                                <input type="password" name="password" class="form-control" placeholder="Password"
                                       required="required">
                            </div>
                            <br>
                            <div class="form-group">
                                <button type="submit" name="submit" class="btn btn-outline-dark btn-block">Log in
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </body>
    </html>
    <?php
} else {

    include("config.php");
    $username = $mysqli->real_escape_string($_POST['username']);
    $password = $mysqli->real_escape_string($_POST['password']);

    //SQL query to access username and password
    $query = "SELECT custUser FROM external_users WHERE BINARY custUser='" . $username . "' AND custPass=sha1('" . $password . "')";

    $result = $mysqli->query($query);

    if ($result = $mysqli->query($query)) {
        if ($result->num_rows == 1) {
            //Sets session to true
            $_SESSION["loggedIn"] = true;
            //Sets session username
            $_SESSION["username"] = $username;
            //returns to index page
            header("location:index.php?message=LoggedIn?username=" . $username);
        } else {
            //Sets error messaging if login creds don't match
            $location = $_SERVER['PHP_SELF'] . "?message=loginError";
            header("Location: login.php?message=notLoggedIn");
            header("Location:" . $location);
        }
    } else {
        echo "ERROR: Could not able to execute $sql. " . $mysqli->error;
    }
}




