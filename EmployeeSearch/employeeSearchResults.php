<?php
/*
Author: Kendall Fowler
Date: December 6, 2021
Purpose: CIS-2288 Assignment 6 - Employee Search
Dependencies: none
*/
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Employee Search Results</title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="css/custom.css">
</head>
<div id="employeeArea">
    <h1>Employee Search</h1>
    <?php
    //DB Connection
    @ $db = new mysqli('localhost', 'root', '', 'cis2288');

    //Error Handling
    if (mysqli_connect_errno()) {
        echo 'Error: Could not connect to database.  Please try again later.</body></html>';
        exit;
    }

    //Order Detail Report Query
    $query = "SELECT EMP_ID AS 'Employee ID', FIRST_NAME AS 'First Name',  LAST_NAME AS 'Last Name', START_DATE AS 'Start Date' FROM employee";

    //Append to where clause depending on number of URL Get variables
    if (isset($_GET['fName']) && !empty($_GET['fName'])) {
        $fName = $db->real_escape_string($_GET['fName']);
        $query .= " WHERE FIRST_NAME LIKE '%$fName%'";
    }

    if(isset($_GET['lName']) && !empty($_GET['lName'])) {
        $lName = $db->real_escape_string($_GET['lName']);
        $query .= " WHERE LAST_NAME LIKE '%$lName%'";
    }

    //Order by
    if (isset($_GET['orderBy']) && !empty($_GET['orderBy'])) {
        $orderBy = $db->real_escape_string($_GET['orderBy']);
        $query .= " Order by $orderBy ";
    }
    //Order direction ACS/DESC
    if (isset($_GET['orderDirection']) && !empty($_GET['orderDirection'])) {
        $orderDirection = $db->real_escape_string($_GET['orderDirection']);
        $query .= $orderDirection;
    }

    //Query Row Limit
    if (isset($_GET['numberOfResults']) && !empty($_GET['numberOfResults'])) {
        $numOfResults = $db->real_escape_string($_GET['numberOfResults']);
        $query .= " LIMIT $numOfResults";
    }

    $result = $db->query($query);

    $num_results = $result->num_rows;

    echo "<h2>Search Results</h2>";

    //Results Display
    if ($num_results > 0) {
        $employees = $result->fetch_all(MYSQLI_ASSOC);

        echo "<table class='table table-bordered'><tr>";
        foreach ($employees[0] as $k => $v) {
            echo "<th>" . $k . "</th>";
        }
        echo "</tr>";
        foreach ($employees as $employee) {
            echo "<tr>";
            foreach ($employee as $k => $v) {
                echo "<td>" . $v . "</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p>Sorry there are no entries in the database.</p>";
    }

    //Freeing and Closing from DB
    $result->free();

    $db->close();

    ?>
    <a class="btn btn-primary" href="employeeSearch.php" role="button">Back to Employee Search</a>
</div>
</body>
</html>