<?php
//Connect to MySQL
$host = "devweb2021.cis.strath.ac.uk";
$user = "gtb19141";//your username
require_once "password.php";
$pass = get_password();//your MySQL password
$dbname = $user;
$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed : " . $conn->connect_error);
}

//Issue the query
$sql = "SELECT * FROM `artOrders`";
$result = $conn->query($sql);

if (!$result) {
    die("Query failed " . $conn->error);
}

//Handle the results
$result->data_seek(0); // set the pointer back to the beginning to loop through data again
?>

<!DOCTYPE html>
<html lang="en">
<link rel="icon" href="photos/cara%20icon.png" type="image/png" >
<title>Cara Art | Admin | Orders</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<head>
    <link rel="stylesheet" href="styling.css">
</head>
<body>

<div id="mySidebar" class="sideNav">
    <a href="javascript:void(0)" class="closeNav" onclick="closeNav()">&times;</a>

    <a href="https://devweb2021.cis.strath.ac.uk/~gtb19141/wad2/index.php"><img alt="icon" src="photos/homeIcon.png" width="50%" height ="50%" >
            <p><a href="https://devweb2021.cis.strath.ac.uk/~gtb19141/wad2/listart.php?page=1">Art Listings</a></p>
            <p><a href="https://devweb2021.cis.strath.ac.uk/~gtb19141/wad2/track&trace.php">Track & Trace</a></p>

    </div>
</head>


    <div id="main">
        <div id="headerBackground">
            <button class="headerButtons" style="float:left;" onclick="openNav()">☰</button>
            <button class="headerButtons" style="float:right;" onclick="openAdmin()">Admin</button>
            <h1>Orders Page Admin</h1>
    </div>

    <?php

    echo "<hr>\n";

    echo "<table>\n";
    echo "<tr>\n";
    echo "<th><b>Name</b></th>\n";
    echo "<th><b>Phone</b></th>\n";
    echo "<th><b>Email</b></th>\n";
    echo "<th><b>Address</b></th>\n";
    echo "<th><b>Painting</b></th>\n";
    echo "<th><b>PaintingID</b></th>\n";



    if ($result->num_rows > 0) {

        echo "<tr>\n";
        while ($row = $result->fetch_assoc()) {

            echo "<td>".$row["name"]."</td>\n";
            echo "<td>".$row["phone"]."</td>\n";
            echo "<td>".$row["email"]."</td>\n";
            echo "<td>".$row["address"]."</td>\n";
            echo "<td>".$row["painting"]."</td>\n";
            echo "<td>".$row["paintingID"]."</td>\n";
            echo "</tr>\n";
        }
        echo "</table>\n";
    }

    //Disconnect
    $conn->close();

    ?>

    </div>
<script> window.onscroll = function() {scrollFunction()};</script>
<script type="text/javascript" src="script.js"></script>

</body>
</html>