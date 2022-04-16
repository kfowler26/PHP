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
<body>
<div id="employeeArea">
    <h1>Employee Search</h1>
    <div class="login-form">
        <form action="employeeSearchResults.php" method="GET">
            <div class="form-group">
                <label for="id">First Name:</label>
                <input type="text" class="form-control" id="fName" placeholder="Enter Employee First Name" name="fName">
            </div>
            <div class="form-group">
                <label for="name">Last Name:</label>
                <input type="text" class="form-control" id="lName" placeholder="Enter Employee Last Name" name="lName">
            </div>
            <div class="form-group">
                <label for="numberOfResults">Number of Results:</label>
                <select class="form-control" name="numberOfResults" id="numberOfResults">
                    <option value=5>5</option>
                    <option value=2>2</option>
                    <option value=10>10</option>
                    <option value=15>15</option>
                    <option value=10000>All</option>
                </select>
            </div>
            <div class="form-group">
                <label for="orderBy">Order By:</label>
                <select class="form-control" name="orderBy" id="orderBy">
                    <option value=LAST_NAME>Employee Last Name</option>
                    <option value=FIRST_NAME>Employee First name</option>
                    <option value=EMP_ID>Employee id</option>
                    <option value=START_DATE>Employee Start Date</option>
                </select>
            </div>
            <div class="form-group">
                <label for="orderDirection">Order Direction:</label>
                <select class="form-control" name="orderDirection" id="orderDirection">
                    <option value="ASC">Ascending</option>
                    <option value="DESC">Descending</option>
                </select>
            </div>
            <br>
            <div class="form-group">
                <button type="submit" name="submit" class="btn btn-primary btn-block">Search Employees</button>
            </div>
        </form>
</div>
</body>
</html>