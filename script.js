function openNav() {
    document.getElementById("mySidebar").style.width = "20%";
    document.getElementById("main").style.marginLeft = "20%";
}
function openAdmin() {
    location.href = 'https://devweb2021.cis.strath.ac.uk/~gtb19141/wad2/admin.php' ;
}
function closeNav() {
    document.getElementById("mySidebar").style.width = "0";
    document.getElementById("main").style.marginLeft= "0";
}

function openArtListings() {
    location.href = 'https://devweb2021.cis.strath.ac.uk/~gtb19141/wad2/listart.php?page=1';
}

function scrollFunction() {
    if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
        document.getElementById("headerBackground").style.fontSize = "70%";
    } else {
        document.getElementById("headerBackground").style.fontSize = "150%";
    }
}

/*adapted from https://www.w3schools.com/howto/tryit.asp?filename=tryhow_js_slideshow*/
function plusSlides(n) {
    showSlides(slideIndex += n);
}

function currentSlide(n) {
    showSlides(slideIndex = n);
}

/*adapted from https://www.w3schools.com/howto/tryit.asp?filename=tryhow_js_slideshow*/
function showSlides(n) {
    var i;
    var slides = document.getElementsByClassName("mySlides");
    var dots = document.getElementsByClassName("dot");
    if (n > slides.length) {slideIndex = 1}
    if (n < 1) {slideIndex = slides.length}
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
    }
    slides[slideIndex-1].style.display = "block";
    dots[slideIndex-1].className += " active";
}

function adminPages(page) {
    if (page === "orders") {
        location.href = 'https://devweb2021.cis.strath.ac.uk/~gtb19141/wad2/ordersAdmin.php';
    } else if (page === "listings") {
        location.href = 'https://devweb2021.cis.strath.ac.uk/~gtb19141/wad2/listingsAdmin.php';
    }
    else{
        location.href = 'https://devweb2021.cis.strath.ac.uk/~gtb19141/wad2/bookingsAdmin.php';
    }

}

function selectedOrder(id) {

    location.href = 'https://devweb2021.cis.strath.ac.uk/~gtb19141/wad2/orderForm.php?id='+ id;
}
function selectedArt(id,page) {

    location.href = 'https://devweb2021.cis.strath.ac.uk/~gtb19141/wad2/artDetails.php?id='+ id + "&page=" + page;
}


function newListing() {
    location.href = 'https://devweb2021.cis.strath.ac.uk/~gtb19141/wad2/newListing.php';
}


function track(id) {
    alert("Thanks for Completing Track & Trace");
    location.href = 'https://devweb2021.cis.strath.ac.uk/~gtb19141/wad2/index.php';
}


