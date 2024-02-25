<!DOCTYPE html>
<html lang="en">
<link rel="icon" href="photos/cara%20icon.png" type="image/png" >
<title>Cara Art | Home</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<head>
<link rel="stylesheet" href="styling.css">
</head>
<body>

    <div id="mySidebar" class="sideNav">
        <a href="javascript:void(0)" class="closeNav" onclick="closeNav()">&times;</a>
        <a href="https://devweb2021.cis.strath.ac.uk/~gtb19141/wad2/index.php"><img alt="icon" src="photos/homeIcon.png" width="50%" height ="50%"> </a>
            <a href="https://devweb2021.cis.strath.ac.uk/~gtb19141/wad2/listart.php?page=1">Art Listings</a>
            <a href="https://devweb2021.cis.strath.ac.uk/~gtb19141/wad2/track&trace.php">Track & Trace</a>
    </div>

    <div id="main">
    <div id="headerBackground">
        <button class="headerButtons" style="float:left;" onclick="openNav()">☰</button>
        <button class="headerButtons" style="float:right;" onclick="openAdmin()">Admin</button>
        <h1>Cara Art</h1>
    </div>


    <div class="slideshow-container">
        <div class="mySlides fade">
            <div class="numberText">1 / 2</div>
            <img src="photos/orkney1.jpg" style="width:100%">
                <div class="text">Discover more inspiring art</div>
            <button class="explore" onclick="openArtListings()" >Explore &#x2192</button>
        </div>

        <div class="mySlides fade">
            <div class="numberText">2 / 2</div>
            <img src="photos/orkney2.jpg" style="width:100%">
            <div class="text">Discover more inspiring art</div>
            <button class="explore" onclick="openArtListings()" >Explore &#x2192</button>

        </div>

        <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
        <a class="next" onclick="plusSlides(1)">&#10095;</a>

    </div>

    <div style="text-align:center">
        <span class="dot" onclick="currentSlide(1)"></span>
        <span class="dot" onclick="currentSlide(2)"></span>
    </div>
        <br>

        <p style="font-size:180%; display:block; border-top:1px solid gray; padding-top:5%;"><b><i>About The Artist</i></b></p>
        <p><img alt="CC Image Cara C by Jose Mesa flic.kr/p/cKF1Dw" src="photos/cara.png" style="display: block; border: 1px solid black;width:20%;height:30%;float: left;" > </p>
        <p style="display:block; font-size: 130%; height:20%;">Cara is an artist from from Glasgow who has recently moved to a small Scottish Island to open an art gallery and framing company. </p>

    </div>
    <script> window.onscroll = function() {scrollFunction()};</script>
    <script type="text/javascript" src="script.js"></script>
    <script> var slideIndex = 1; showSlides(slideIndex);</script>
</body>
</html>