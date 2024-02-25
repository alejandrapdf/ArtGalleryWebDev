<!DOCTYPE html>
<html>
<head>
    <link rel="icon" href="photos/cara%20icon.png" type="image/png" >
    <title>Cara Art | Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <head>
        <link rel="stylesheet" href="styling.css">
    </head>
<body>

<div id="mySidebar" class="sideNav">
        <a href="javascript:void(0)" class="closeNav" onclick="closeNav()">&times;</a>
        <a href="https://devweb2021.cis.strath.ac.uk/~gtb19141/wad2/index.php"><img alt="icon" src="photos/homeIcon.png" width="50%" height ="50%" >
            <a href="https://devweb2021.cis.strath.ac.uk/~gtb19141/wad2/listart.php?page=1">Art Listings</a>
        <a href="https://devweb2021.cis.strath.ac.uk/~gtb19141/wad2/track&trace.php">Track & Trace</a>

</div>

<div id="main">
    <div id="headerBackground">
        <button class="headerButtons" style="float:left;" onclick="openNav()">☰</button>
        <button class="headerButtons" style="float:right;" onclick="openAdmin()">Admin</button>
        <h1>Admin</h1>
    </div>

    <?php
    $password = strip_tags(isset($_POST["password"]) ? $_POST["password"] : "");
    $correctPass = "caraART21";
    $passwordErr = "";

    if($password != $correctPass) {
        if($_SERVER["REQUEST_METHOD"]==="POST") {
        $passwordErr = "Incorrect password. Please try again!";
        }

    ?>


        <form class="loginForm" action="admin.php" method="post">
                <p><?php echo $passwordErr; ?></p>
                <p>Enter password to access database:</p>
                <p><input type="text" id="password" name="password" value ="<?php echo $password; ?>" ></p>
                <p><input class="select-submit-buttons" type="submit"></p>
        </form>

        <?php
    }
    else {
?>
        <div class="loginForm">
        <p><b><i>Click on the Database you would like to access:</i></b></p>
        <p><button class="select-submit-buttons"  onclick="adminPages('orders')">Orders</button>
        <button class="select-submit-buttons"  onclick="adminPages('listings')" >Listings</button>
        <button class="select-submit-buttons" onclick="adminPages('bookings')" >Bookings</button></p>
        </div>
     <?php
    }
    ?>

</div>

<script> window.onscroll = function() {scrollFunction()};</script>
<script type="text/javascript" src="script.js"></script>

</body>
</html>