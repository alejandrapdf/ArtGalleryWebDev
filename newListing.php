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

//Handle the results
$result->data_seek(0); // set the pointer back to the beginning to loop through data again
?>

<!DOCTYPE html>
<html lang="en">
<link rel="icon" href="photos/cara%20icon.png" type="image/png" >
<title>Cara Art | Admin | New Listing</title>
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
        <h1>New Listing Admin</h1>
    </div>
        <?php
        //extraction of the user input, input is checked for html tags to avoid errors
        $name = strip_tags(isset($_POST["name"]) ? $_POST["name"] : "");
        $date = strip_tags(isset($_POST["date"]) ? $_POST["date"] : "");
        $width = strip_tags(isset($_POST["width"]) ? $_POST["width"] : "");
        $height = strip_tags(isset($_POST["height"]) ? $_POST["height"] : "");
        $price = strip_tags(isset($_POST["price"]) ? $_POST["price"] : "");
        $description = strip_tags(isset($_POST["description"]) ? $_POST["description"] : "");
        $image = realpath(isset($_POST["image"]) ? $_POST["image"] : "").(isset($_POST["image"]) ? $_POST["image"] : "");

        if(($name === "" || is_numeric($name))) {
        if($_SERVER["REQUEST_METHOD"]==="POST") {
            //conditions for error messages
            echo "<p>*Please try again and complete all the fields correctly!</p>";
            ?>

            <?php
        }

        ?>

        <div class="formImage">
        <form class="form" action="newListing.php" style="display: inline-block; " action="" method="POST">
            <p class="formTitle">New Record:</p>
            <p style="padding-bottom: 5%;"><input type="text" name="name" id ="name" placeholder="Name" required/></p>
            <p style="padding-bottom: 5%;">Date of Completion: <input style="background-color: darkgoldenrod;" type="date" id="date" name="date"></p>
            <p style="padding-bottom: 5%;"><input type ="text" name="width" id ="width" placeholder="Width (mm)" required/></p>
            <p style="padding-bottom: 5%;"><input type ="text" name="height" id="height" placeholder="Height (mm)" required/></p>
            <p style="padding-bottom: 5%;"><input type ="text" name="price" id="price" placeholder="Price (£)" required/></p>
            <p style="padding-bottom: 5%;"><input type ="text" name="description" id ="description" placeholder="Description" required/></p>

            <p style="padding-bottom: 5%;">Upload File: <input type ="file" name="file" id ="file" value="" /></p>
            <p style="padding-bottom: 5%;"><input type="submit"  class="select-submit-buttons"/></p>
        </form>
    </div>
</div>
<?php

}
else{
    //Connect to MySQL
    $host = "devweb2021.cis.strath.ac.uk";
    $user = "gtb19141";//your username
    require_once "password.php";
    $pass = get_password();//your MySQL password
    $dbname = $user;
    $conn = new mysqli($host, $user, $pass, $dbname);

    if ($conn->connect_error) {
        die("Connection failed : " . $conn->connect_error); //FIXME remove once working.
    }

    $sql = "INSERT INTO `gtb19141`.`artDatabase` (`id`, `name`, `date`, `width`, `height`, `description`, `price`, `image`) VALUES "
        ."(NULL, '$name', '$date', '$width', '$height', '$description', '$price' ,'$image' );";


    if ($conn->query($sql) === TRUE){
        ?>
        <script>
            location.href = 'https://devweb2021.cis.strath.ac.uk/~gtb19141/wad2/listingsAdmin.php?insert=' + 1;
        </script>
    <?php
    } else {
      ?>
        <script>
            location.href = 'https://devweb2021.cis.strath.ac.uk/~gtb19141/wad2/listingsAdmin.php?insert=' + 2 ;
        </script>
<?php
    }

}



?>
    <?php
    //Disconnect
    $conn->close();
    ?>
</div>

<script> window.onscroll = function() {scrollFunction()};</script>
<script type="text/javascript" src="script.js"></script>
<script>
    function getPath() {
        var inputName = document.getElementById('file');
        var imgPath;

        imgPath = inputName.value;
        alert(imgPath);
        return imgPath;
    }
</script>
</body>
</html>
