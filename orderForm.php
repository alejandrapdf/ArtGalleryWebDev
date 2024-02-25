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

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {

            if($row["id"] == $paintingID){
                $paintingName = $row["name"];
            }

        }

    }

    ?>
<!DOCTYPE html>
<html lang="en">

    <meta charset="UTF-8">
    <link rel="icon" href="photos/cara%20icon.png" type="image/png" >
    <title>Cara Art | Order Form</title>
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
            <button class="headerButtons" onclick="openNav()">☰</button>
            <h1>Order Form</h1>
        </div>


   <?php

    //extraction of the user input, input is checked for html tags to avoid errors
    $name = strip_tags(isset($_POST["name"]) ? $_POST["name"] : "");
    $number = strip_tags(isset($_POST["number"]) ? $_POST["number"] : "");
    $email = strip_tags(isset($_POST["email"]) ? $_POST["email"] : "");
    $address = strip_tags(isset($_POST["address"]) ? $_POST["address"] : "");
    $specialChars = '/[\'^£$%&*()}{@#~?><>,|=_+¬-]/';
   $nameErr = "";
   $numErr = "";


    //conditions for error checking to work out the correct error message
    //height and width are checked to be between 0.2 and 2 m inclusive
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
        <form class="form" name="form" action="orderForm.php?id=<?php echo $paintingID; ?>" method="POST" onsubmit="checkForm();">
            <p class="formTitle">Order Form</p>
                <p style="padding-left:20%; text-align:left;">Painting Name:</p><p style="padding-bottom: 5%;"><?php echo $paintingName; ?></p>
                <p style="padding-left:20%; text-align:left;">Painting ID:</p><p style="padding-bottom: 5%;"><?php echo $paintingID; ?></p>

            <p><?php echo $nameErr; ?></p>
            <p style="padding-bottom: 5%;"><input type ="text" name="name" value = "<?php echo $name; ?>" placeholder="Name" required/></p>
            <p><?php echo $numErr; ?></p>
            <p style="padding-bottom: 5%;"><input type ="text" name="number" value = "<?php echo $number; ?>" placeholder = "Phone Number" required/></p>
            <p style="padding-bottom: 5%;"><input type ="text" name="address" value = "<?php echo $address; ?>" placeholder = "Postal Address" required/></p>
            <p style="padding-bottom: 5%;"><input type ="text" name="email"  value = "<?php echo $email; ?>" placeholder="Email" title="e.g user@example.com" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" required/></p>

            <p style="padding-bottom: 5%;"><input type="submit"  class="select-submit-buttons" /></p>

        </form>
    </div>

        <?php
    }

    else {

        ?>
        <p class="formTitle">Thank you for your order!</p>

        <?php
        //create the sql query and run it
        $sql =  "INSERT INTO `gtb19141`.`artOrders` (`id`, `name`, `phone`, `email`, `address`, `painting`,`paintingID` ) VALUES "
            . "(NULL, '$name', '$number', '$email', '$address', '$paintingName', '$paintingID');";


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