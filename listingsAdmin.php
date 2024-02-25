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
$sql = "SELECT * FROM `artDatabase`";
$result = $conn->query($sql);

if (!$result) {
    die("Query failed " . $conn->error);
}

$insert = isset($_GET['insert']) ? $_GET['insert'] : "";

if($insert == 1 ) {
    ?>
    <script> setTimeout(function insertionSuccess(){ alert('Insert Successful'); }, 300); </script>
    <?php
}
else if($insert == 2){
    ?>
    <script>
    setTimeout( function insertionUnsuccess() { alert('Insert Unsuccessful, please try enter the record again');}, 300);
   </script>
    <?php
}

//Handle the results
$result->data_seek(0); // set the pointer back to the beginning to loop through data again
?>
<!DOCTYPE html>
<html lang="en">
<link rel="icon" href="photos/cara%20icon.png" type="image/png" >
<title>Cara Art | Admin | Art Listings</title>
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

<div id="main">
     <div id="headerBackground">
         <button class="headerButtons" style="float:left;" onclick="openNav()">☰</button>
         <button class="headerButtons"  style="float:right;"  onclick="openAdmin()">Admin</button>
        <h1>Art Listings Admin</h1>
     </div>

   <?php
    echo "<hr>\n";

    echo "<table>\n";
    echo "<tr>\n";
    echo "<th><b>ID</b></th>\n";
    echo "<th><b>Name</b></th>\n";
    echo "<th><b>Date of Completion</b></th>\n";
    echo "<th><b>Width</b></th>\n";
    echo "<th><b>Height</b></th>\n";
    echo "<th><b>Description</b></th>\n";
    echo "<th><b>Price</b></th>\n";


    if ($result->num_rows > 0) {

        echo "<tr>\n";
        while ($row = $result->fetch_assoc()) {

            echo "<td>".$row["id"]."</td>\n";
            echo "<td>".$row["name"]."</td>\n";
            echo "<td>".$row["date"]."</td>\n";
            echo "<td>".$row["width"]."</td>\n";
            echo "<td>".$row["height"]."</td>\n";
            echo "<td>".$row["description"]."</td>\n";
            echo "<td>".$row["price"]."</td>\n";
            echo "</tr>\n";

        }
        echo "</table>\n";
    }
    ?>
    <p>
        <button onclick="newListing()" style="font-size: 150%; width:30%; height: 20%;" class="select-submit-buttons">Enter New Record</button><p>

</div>

<script> window.onscroll = function() {scrollFunction()};</script>
<script type="text/javascript" src="script.js"></script>

</body>
</html>