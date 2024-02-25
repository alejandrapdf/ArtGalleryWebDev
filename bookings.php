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

$date = isset($_GET['date']) ? $_GET['date'] : "";
$month = isset($_GET['month']) ? $_GET['month'] : "";
$time = isset($_GET['time']) ? $_GET['time'] : "";
//Handle the results
$result->data_seek(0); // set the pointer back to the beginning to loop through data again


?>
<!DOCTYPE html>
<html lang="en">
<link rel="icon" href="photos/cara%20icon.png" type="image/png" >
<title>Cara Art | Track & Trace</title>
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
            <h1>Track & Trace</h1>
        </div>

    <?php

    //extraction of the user input, input is checked for html tags to avoid errors
    $name = strip_tags(isset($_POST["name"]) ? $_POST["name"] : "");
    $dateInput = "2021-".$month."-".$date;
    $timeInput = $time.":00:00";
    $number = strip_tags(isset($_POST["number"]) ? $_POST["number"] : "");
    $email = strip_tags(isset($_POST["email"]) ? $_POST["email"] : "");
    $nameErr = "";
    $numErr = "";
    $specialChars = '/[\'^£$%&*()}{@#~?><>,|=_+¬-]/';

    //conditions for error checking to work out the correct error message
    if(is_numeric($name) || !is_numeric($number) || preg_match($specialChars, $name) || strlen($number) != 11) {
        //checks if form has been completed before or not
        if($_SERVER["REQUEST_METHOD"]==="POST") {
            //conditions for error messages
            if(is_numeric($name)){
                $nameErr = "*Name must not be a numeric value";
            }
            else if(preg_match($specialChars, $name)){
            $nameErr = "*Name must not include special characters";
            }

            if(!is_numeric($number)){
                $numErr = "*Phone Number must be a numeric value";
            }
            else if(strlen($number) != 11){
                $numErr = "*Phone Number must at least 11 digits long";
            }

        }
        ?>

    <div class="formImage">

        <form class="form" name="form" action="bookings.php?date=<?php echo $date;?>&month=<?php echo $month;?>&time=<?php echo $time;?>" method="post" onsubmit="checkForm();">

            <p class="formTitle">Track & Trace Form</p>
            <p><?php echo $nameErr; ?></p>
            <p><input type ="text" name="name" value = "<?php echo $name; ?>" placeholder="Name"  required/></p>
            <p>Date of Booking: </p><p style="padding-bottom: 5%;"><input style="background-color: darkgoldenrod;" type="text" id="date" name="date" value="<?php echo $dateInput;?>"; readonly/></p>
            <p>Time of Booking: </p><p style="padding-bottom: 5%;"><input style="background-color: darkgoldenrod;" type="text" id="time" name="time" value="<?php echo $timeInput; ?>" readonly/></p>
            <p><input type ="text" name="email" value = "<?php echo $email; ?>"  placeholder = "Email" title="e.g user@example.com" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" required/></p>
            <p><?php echo $numErr; ?></p>
            <p style="padding-bottom: 5%;"><input type ="text" name="number" value = "<?php echo $number; ?>" placeholder = "Phone Number" required/></p>
            <p style="padding-bottom: 10%;"><input type="submit"  class="select-submit-buttons" /></p>

        </form>
    </div>

        <?php
    }
   else {
    ?>
    <p class="formTitle">Thank you for your booking!</p>

    <?php
    //create the sql query and run it
    $sql =  "INSERT INTO `gtb19141`.`bookings` (`id`, `name`, `date`, `time`, `phone`, `email`) VALUES "
        . "(NULL, '$name', '$dateInput', '$timeInput', '$number', '$email');";


    if ($conn->query($sql) === TRUE){

    } else {
        die ("Error on insert ".$conn->error." ");
    }

    //Disconnect
    $conn->close();
}
?>

</div>
<script> window.onscroll = function() {scrollFunction()};</script>
<script type="text/javascript" src="script.js"></script>
<script>
function checkForm(){
var name = document.forms["form"]["name"].value;
var number = document.forms["form"]["number"].value;
var errs = "";

console.log("1 "+errs);
var specialChars = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]+/;
if(!isNaN(name) || specialChars.test(name)){
errs += "- Name\n";
}

console.log("2 "+errs);
if(isNaN(number) || number.length !== 11){
errs += "- Number\n";
}

if(errs!=""){
alert("The following fields need to be corrected:\n"+errs);
}

return (errs=="");
}
</script>
</body>
</html>