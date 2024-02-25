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

    $currentPage = isset($_GET['page']) ? $_GET['page'] : "";
    $upperIndex = $currentPage * 12;
    $lowerIndex = $upperIndex - 11;

//Handle the results
$result->data_seek(0); // set the pointer back to the beginning to loop through data again
?>


<!DOCTYPE html>
<html>
<link rel="icon" href="photos/cara%20icon.png" type="image/png" >
<title>Cara Art | Art Listings</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    <button class="headerButtons" onclick="openNav()">☰</button>
    <h1>Art Listings</h1>
    </div>

    <?php
    echo "<hr>\n";
    echo "<table>\n";
    echo "<tr>\n";
    echo "<th><b>Art</b></th>\n";
    echo "<th><b>Art ID</b></th>\n";
    echo "<th><b>Name</b></th>\n";
    echo "<th><b>Price (£)</b></th>\n";
    echo "<th><b>Details</b></th>\n";

    if ($result->num_rows > 0) {

        echo "<tr>\n";
        while ($row = $result->fetch_assoc()) {

           if($row["id"] >= $lowerIndex && $row["id"] <= $upperIndex) {

               echo "<td>" .'<img src="data:image/png;base64,'.base64_encode($row['image']).'" width="5%" />'. "</td>\n";
               echo "<td>" . $row["id"] . "</td>\n";
                echo "<td>" . $row["name"] . "</td>\n";
                echo "<td>" . $row["price"] . "</td>\n";
               ?>
            <td><button class="orderButtons" type="button" onclick="selectedArt(<?php echo $row["id"]; ?>,<?php echo $currentPage; ?>)" id="<?php echo $row["id"]; ?>" value="<?php echo $row["id"]; ?>" >More</button></td>
            <?php

            echo "</tr>\n";
            }
        }
        echo "</table>\n";
        ?>


        <?php
    }
    //Disconnect
    $conn->close();

    ?>

    <p><button  class="select-submit-buttons" style="font-size:160%; width:20%; float:left;" type="button" onclick="showPages(<?php echo $currentPage - 1; ?>)" id="previous" value="previous"> &#x2190 Previous</button>
    <button  class="select-submit-buttons" style="font-size:160%; width:20%; float:right;" type="button" onclick="showPages(<?php echo $currentPage + 1; ?>)" id="next" value="next" >Next &#x2192 </button>
    </p>
</div>


<script> window.onscroll = function() {scrollFunction()};</script>
<script type="text/javascript" src="script.js"></script>

<script>
    function showPages(n) {

        if(n <= 1) {
            location.href = 'https://devweb2021.cis.strath.ac.uk/~gtb19141/wad2/listart.php?page='+ 1;
        }
        else {
            location.href = 'https://devweb2021.cis.strath.ac.uk/~gtb19141/wad2/listart.php?page=' + n;
        }
    }
</script>

</body>
</html>

