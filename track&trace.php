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
$sql = "SELECT * FROM `bookings`";
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
<title>Cara Art | Bookings Calender</title>
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
            <button class="headerButtons" style="float:left;"  onclick="openNav()">☰</button>
            <h1>Bookings Calendar</h1>
        </div>

       <?php

       function getMonth($mont){
        if($mont == 1){
            return "January";
        } else if($mont == 2){
            return "February";
        }
        else if($mont == 3){
            return "March";
        }
        else if($mont == 4){
            return "April";
        }
        else if($mont == 5){
            return "May";
        }
        else if($mont == 6){
            return "June";
        }
        else if($mont == 7){
            return "July";
        }
        else if($mont == 8){
            return "August";
        }
        if($mont == 9){
            return "September";
        }
        if($mont == 10){
            return "October";
        }
        if($mont == 11){
            return "November";
        }
        if($mont == 12){
            return "December";
        }
        }

       $today = date("Y-m-d");
       $month = date("m",strtotime($today));
       $year = date("y",strtotime($today));
       $date = date("d",strtotime($today));
       $day = date('D', strtotime($today));
       $calDays = cal_days_in_month(CAL_GREGORIAN, $month, $year);
       $backgroundColor = "green";


        ?>
        <p class="loginForm" style="font-size: 200%;"><?php echo getMonth($month)?></p>
        <table>

            <tr>
                <th>Mon</th>
                <th>Tue</th>
                <th>Wed</th>
                <th>Thur</th>
                <th>Fri</th>
                <th>Sat</th>
                <th>Sun</th>
            </tr>

                <?php
                $avial = "";
                $weeksinDays = 0;
                echo "<tr>";
                    if ($day == "Mon") {

                        ?>
                        <td><button class="orderButtons" type="button" style="background-color:green;" onclick="checkAvailability(<?php echo $date; ?>,<?php echo $month;?>)" id="<?php echo $date; ?>" value="<?php echo $date ?>" ><?php echo $date ?></button></td>
                        <td><button class="orderButtons" type="button" style="background-color: grey;" ><?php echo $date =$date +1; ?></button></td>
                        <td><button class="orderButtons" type="button" style="background-color: orange" onclick="checkAvailability(<?php echo $date = $date + 1; ?>,<?php echo $month;?>)"  ><?php echo $date; ?></button></td>
                        <td><button class="orderButtons" type="button" style="background-color: green;" onclick="checkAvailability(<?php echo $date = $date + 1; ?>,<?php echo $month;?>)"  ><?php echo $date; ?></button></td>
                        <td><button class="orderButtons" type="button" style="background-color: green;" onclick="checkAvailability(<?php echo $date = $date + 1; ?>,<?php echo $month;?>)"  ><?php echo $date; ?></button></td>
                        <td><button class="orderButtons" type="button" style="background-color: grey;"   ><?php echo $date = $date + 1; ?></button></td>
                        <td><button class="orderButtons" type="button" style="background-color: orange;" onclick="checkAvailability(<?php echo $date = $date + 1; ?>,<?php echo $month;?>)"  ><?php echo $date; ?></button></td>
                        <?php
                        $weeksinDays = 7;

                    }
                    if ($day == "Tue") {
                        ?>
                        <td> </td>
                        <td><button class="orderButtons" type="button" style="background-color: orange;" onclick="checkAvailability(<?php echo $date; ?>,<?php echo $month;?>)" id="<?php echo $date; ?>" value="<?php echo $date ?>" ><?php echo $date ?></button></td>
                        <td><button class="orderButtons" type="button" style="background-color: green;" onclick="checkAvailability(<?php echo $date = $date + 1; ?>,<?php echo $month;?>)"  ><?php echo $date ?></button></td>
                        <td><button class="orderButtons" type="button" style="background-color: grey;" ><?php echo $date = $date + 1; ?></button></td>
                        <td><button class="orderButtons" type="button" style="background-color: green;" onclick="checkAvailability(<?php echo $date = $date + 1; ?>,<?php echo $month;?>)"  ><?php echo $date?></button></td>
                        <td><button class="orderButtons" type="button" style="background-color: green;" onclick="checkAvailability(<?php echo $date = $date + 1; ?>,<?php echo $month;?>)"  ><?php echo $date ?></button></td>
                        <td><button class="orderButtons" type="button" style="background-color: green;" onclick="checkAvailability(<?php echo $date = $date + 1; ?>,<?php echo $month;?>)"  ><?php echo $date ?></button></td>
                        <?php
                        $weeksinDays = 6;
                    }
                    if ($day == "Wed") {
                        ?>
                        <td> </td>
                        <td> </td>
                        <td><button class="orderButtons" type="button" style="background-color: <?php echo $backgroundColor ?>;" onclick="checkAvailability(<?php echo $date; ?>,<?php echo $month;?>)" id="<?php echo $date; ?>" value="<?php echo $date ?>" ><?php echo $date ?></button></td>
                        <td><button class="orderButtons" type="button" style="background-color: <?php echo $backgroundColor ?>;" onclick="checkAvailability(<?php echo $date = $date + 1; ?>,<?php echo $month;?>)"  ><?php echo $date ?></button></td>
                        <td><button class="orderButtons" type="button" style="background-color: orange;" onclick="checkAvailability(<?php echo $date = $date + 1; ?>,<?php echo $month;?>)"  ><?php echo $date ?></button></td>
                        <td><button class="orderButtons" type="button" style="background-color: <?php echo $backgroundColor ?>;" onclick="checkAvailability(<?php echo $date = $date + 1; ?>,<?php echo $month;?>)"  ><?php echo $date?></button></td>
                        <td><button class="orderButtons" type="button" style="background-color: <?php echo $backgroundColor ?>;" onclick="checkAvailability(<?php echo $date = $date + 1; ?>,<?php echo $month;?>)"  ><?php echo $date ?></button></td>
                        <?php
                        $weeksinDays = 5;
                    }
                    if ($day == "Thu") {
                        ?>
                        <td></td>
                        <td> </td>
                        <td></td>
                        <td><button class="orderButtons" type="button" style="background-color: <?php echo $backgroundColor ?>;" onclick="checkAvailability(<?php echo $date; ?>,<?php echo $month;?>)" id="<?php echo $date; ?>" value="<?php echo $date ?>" ><?php echo $date ?></button></td>
                        <td><button class="orderButtons" type="button" style="background-color: grey;" id="<?php echo $date; ?>" value="<?php echo $date = $date + 1; ?>"  ><?php echo $date ?></button></td>
                        <td><button class="orderButtons" type="button" style="background-color: <?php echo $backgroundColor ?>;" onclick="checkAvailability(<?php echo $date = $date + 1; ?>,<?php echo $month;?>)"  ><?php echo $date?></button></td>
                        <td><button class="orderButtons" type="button" style="background-color: orange;" onclick="checkAvailability(<?php echo $date = $date + 1; ?>,<?php echo $month;?>)"  ><?php echo $date; ?></button></td>
                        <?php
                        $weeksinDays = 4;
                    }
                    if ($day == "Fri") {
                        ?>
                        <td> </td>
                        <td> </td>
                        <td> </td>
                        <td> </td>
                        <td><button class="orderButtons" type="button" style="background-color: <?php echo $backgroundColor ?>;" onclick="checkAvailability(<?php echo $date; ?>,<?php echo $month;?>)" id="<?php echo $date; ?>" value="<?php echo $date ?>" ><?php echo $date ?></button></td>
                        <td><button class="orderButtons" type="button" style="background-color: orange;" onclick="checkAvailability(<?php echo $date = $date + 1; ?>,<?php echo $month;?>)"  ><?php echo $date; ?></button></td>
                        <td><button class="orderButtons" type="button" style="background-color: <?php echo $backgroundColor ?>;" onclick="checkAvailability(<?php echo $date = $date + 1; ?>,<?php echo $month;?>)"  ><?php echo $date; ?></button></td>
                        <?php
                        $weeksinDays = 3;
                    }
                    if ($day == "Sat") {
                        ?>
                        <td> </td>
                        <td> </td>
                        <td> </td>
                        <td> </td>
                        <td> </td>
                        <td><button class="orderButtons" type="button" style="background-color: grey;" id="<?php echo $date; ?>" value="<?php echo $date ?>" ><?php echo $date ?></button></td>
                        <td><button class="orderButtons" type="button" style="background-color: orange;" onclick="checkAvailability(<?php echo $date = $date + 1; ?>,<?php echo $month;?>)"  ><?php echo $date; ?></button></td>
                        <?php
                        $weeksinDays = 2;
                    }

                    if ($day == "Sun") {
                        ?>
                        <td> </td>
                        <td> </td>
                        <td> </td>
                        <td> </td>
                        <td> </td>
                        <td style = "background-color=lightgrey";> </td>
                        <td><button class="orderButtons" type="button" style="background-color: orange;" onclick="checkAvailability(<?php echo $date; ?>,<?php echo $month;?>)" id="<?php echo $date; ?>" value="<?php echo $date ?>" ><?php echo $date ?></button></td>
                        <?php
                        $weeksinDays = 1;
                    }

                echo "</tr>";

                $lastDate =0;
                $weekIndex = 1;

                $firstPass = 0;
                $date = $date + 1;

                    while($weeksinDays < 28) {
                        echo "<tr>";
                        while ($weekIndex <= 7 && $weeksinDays <= 28) {

                            if($date > $calDays){
                                if($firstPass == 0) {
                                       $date = 1;
                                       $firstPass = 1;
                                 }
                                ?>

                                <td><button class="orderButtons" type="button" style="color:white; background-color: grey;" id="<?php echo $date; ?>" value="<?php echo $date; ?>" ><?php echo $date; ?></button></td>

                                <?php
                                $date = $date + 1;
                           }
                            else{

                                if(date("d",strtotime($today)) > $date){
                                    ?>
                                    <td><button class="orderButtons" type="button" style="color:white; background-color: <?php echo $backgroundColor ?>;" onclick="checkAvailability(<?php echo $date; ?>,<?php echo (($month+1) % 12);?>)" id="<?php echo $date; ?>" value="<?php echo $date; ?>" ><?php echo $date; ?></button></td>
                                    <?php
                                }
                                else{
                                    ?>
                                    <td><button class="orderButtons" type="button" style="background-color: <?php echo $backgroundColor ?>;" onclick="checkAvailability(<?php echo $date; ?>,<?php echo $month;?>)" id="<?php echo $date; ?>" value="<?php echo $date; ?>" ><?php echo $date; ?></button></td>
                                <?php
                                        }
                                $date = $date + 1;
                            }

                            $weeksinDays = $weeksinDays + 1;
                            $weekIndex = $weekIndex + 1;

                        }

                        echo "</tr>";


                    $weekIndex = 1;

                    }


                echo"</table>";



                    ?>
            <div id="show"  style="display:none; background-color: goldenrod;">
                <p class="formTitle">Choose a time for your booking:</p>
                <select style="background-color: goldenrod; width: 50%; margin-left: 25%; margin-right: 25%;" id="timeDrops">
                    <option value="10">10:00</option>
                    <option value="11">11:00</option>
                    <option value="12">12:00</option>
                    <option value="13">13:00</option>
                    <option value="14">14:00</option>
                    <option value="15">15:00</option>
                    <option value="16">16:00</option>
                </select>
                <p><button class="orderButtons" type="button" id="timeButton" >Confirm</button></p>
            </div>


</div>
<script> window.onscroll = function() {scrollFunction()};</script>
<script type="text/javascript" src="script.js"></script>
<script>
    disp.style.display = "none";
    function checkAvailability(date,month){
       showTimes();
        document.getElementById("timeButton").onclick = function() {
               location.href = 'https://devweb2021.cis.strath.ac.uk/~gtb19141/wad2/bookings.php?date=' + date + "&month=" + month + "&time=" + document.getElementById('timeDrops').value;
           }
    }

    function showTimes() {

        var disp = document.getElementById("show");
        if (disp.style.display === "none") {
            disp.style.display = "block";
        } else {
            disp.style.display = "none";
        }
    }
</script>

</body>
</html>