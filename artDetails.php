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
    $paintingID = isset($_GET['id']) ? $_GET['id'] : "";
    $page = isset($_GET['page']) ? $_GET['page'] : "";

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {

            if($row["id"] == $paintingID){
                $paintingName = $row["name"];
                $paintingDate = $row["date"];
                $paintingWidth = $row["width"];
                $paintingHeight = $row["height"];
                $paintingDesp = $row["description"];
                $paintingPrice = $row["price"];
                $image = $row["image"];

            }

        }

    }

    ?>
<!DOCTYPE html>
<html lang="en">

    <meta charset="UTF-8">
    <link rel="icon" href="photos/cara%20icon.png" type="image/png" >
    <title>Cara Art | Details</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <head>
        <link rel="stylesheet" href="styling.css">
    </head>
    <body>

    <div id="mySidebar" class="sideNav">
        <a href="javascript:void(0)" class="closeNav" onclick="closeNav()">&times;</a>

        <a href="https://devweb2021.cis.strath.ac.uk/~gtb19141/wad2/index.php"><img alt="icon" src="photos/homeIcon.png" width="50%" height ="50%" >
            <p> <a href="https://devweb2021.cis.strath.ac.uk/~gtb19141/wad2/listart.php?page=1">Art Listings</a></p>
            <p><a href="https://devweb2021.cis.strath.ac.uk/~gtb19141/wad2/track&trace.php">Track & Trace</a></p>

    </div>

    <div id="main">
        <div id="headerBackground">
            <button class="headerButtons" onclick="openNav()">☰</button>
            <h1>Art Details</h1>
        </div>

    <div style="padding:5%;" class="loginForm">
        <p style="padding: 1%; margin: 1%; " class="formTitle"><?php echo $paintingName; ?></p>
        <?php echo "<p>" .'<img src="data:image/png;base64,'.base64_encode($image).'" width="50%" />'. "</p>\n";
        ?>
        <p>Painting ID: <?php echo $paintingID; ?></p>
        <p>Date of Completion: <?php echo $paintingDate; ?></p>
        <p>Width (mm): <?php echo $paintingWidth; ?></p>
        <p>Height (mm): <?php echo $paintingHeight; ?></p>
        <p>Description: <?php echo $paintingDesp; ?></p>
        <p>Price (£): <?php echo $paintingPrice; ?></p>



        <p><button class="select-submit-buttons" style="font-size:160%; width:20%;float:left;" type="button" onclick="backtoArt(<?php echo $page; ?>)" > &#x2190 Back</button>
        <button class="select-submit-buttons" style="font-size:160%; width:20%; float:right;" type="button" onclick="selectedOrder(<?php echo $paintingID; ?>,<?php echo $page; ?>)" id="<?php echo $paintingID; ?>" value="<?php echo $paintingID; ?>" >Order &#x2192 </button>
        </p>
    </div>


</div>
    <script> window.onscroll = function() {scrollFunction()};
            function backtoArt(page){
            location.href = 'https://devweb2021.cis.strath.ac.uk/~gtb19141/wad2/listart.php?page=' + page;
        }
    </script>
    <script type="text/javascript" src="script.js"></script>

    </body>
</html>