<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Home</title>
    <link rel="stylesheet" href="style.css">
    <style>
        * {box-sizing: border-box}
        .mySlides {
            display: none;
        }
        img {
            vertical-align: middle;
        }
 
        /* Slideshow container */
        .slideshow-container {
            max-width: 1000px;
            position: relative;
            margin: auto;
        }

        /* Next & previous buttons */
        .prev, .next {
            cursor: pointer;
            position: absolute;
            top: 50%;
            width: auto;
            padding: 16px;
            margin-top: -22px;
            color: white;
            font-weight: bold;
            font-size: 18px;
            transition: 0.6s ease;
            border-radius: 0 3px 3px 0;
            user-select: none;
        }

        /* Position the "next button" to the right */
        .next {
            right: 0;
            border-radius: 3px 0 0 3px;
        }

        /* On hover, add a black background color with a little bit see-through */
        .prev:hover, .next:hover {
            background-color: rgba(0,0,0,0.8);
        }

        /* Caption text */
        .text {
            color: #f2f2f2;
            font-size: 15px;
            padding: 8px 12px;
            position: absolute;
            bottom: 8px;
            width: 100%;
            text-align: center;
        }

        /* Number text (1/3 etc) */
        .numbertext {
            color: #f2f2f2;
            font-size: 12px;
            padding: 8px 12px;
            position: absolute;
            top: 0;
        }

        /* Fading animation */
        .fade {
            -webkit-animation-name: fade;
            -webkit-animation-duration: 1.5s;
            animation-name: fade;
            animation-duration: 1.5s;
        }

        @-webkit-keyframes fade {
            from {opacity: .4} 
            to {opacity: 1}
        }

        @keyframes fade {
            from {opacity: .4} 
            to {opacity: 1}
        }

        /* On smaller screens, decrease text size */
        @media only screen and (max-width: 300px) {
            .prev, .next,.text {font-size: 11px}
        }
        #imagesScroll{
            padding: 15px;
            margin: 50px auto;
            width: 1200px;
            border-radius: 50px;            
            background-color: #ddd6;
        }
        .slideshow-container{
            margin-top: 5px;
            padding-top: 5px;
        }
    </style>
</head>
<body>
    <?php include 'navBar.php';?>
    <div class="wscroll">
        <marquee width="90%" direction="left" height="20px">
            1.)*For depositing Advance tax, Self Assessment tax, Tax on Regular Assessment, Surtax, 
            Tax on Distributed Profits of Domestic Company and Tax on Distributed income to unit holders.
            2.)*For depositing Securities transaction tax, Estate duty, Wealth-tax, Gift-tax, Interest-tax, 
            Expenditure/other tax and Hotel Receipt tax
        </marquee>
    </div>
    
    <div class="webhome">
        <div id="imagesScroll">
            <div class="slideshow-container">
                <div class="mySlides fade">            
                    <img src="1628845781.jpg" style="width:100%">                  
                </div>                
                <div class="mySlides fade">                  
                    <img src="1632127541.jpg" style="width:100%">                  
                </div>                
                <div class="mySlides fade">                  
                    <img src="income-tax-india-logo-emblem.jpg" style="width:100%">                  
                </div>                
            </div>
        </div>
        <br><br><br><br>
        <div class="contentA" style="width: 100%;">
            <div class="about" style="width: 80%; float: left;">
                <p>About :</p>
                <p>
                    A tax is a compulsory financial charge or some other type of levy imposed on a taxpayer by a governmental 
                    organization in order to fund government spending and various public expenditures. A failure to pay in a 
                    timely manner, along with evasion of or resistance to taxation, is punishable by law.
                </p>
            </div>
            <div class="linksa">
                <div><a href="Home.php">Home</a></div>
                <div><a href="Application.php" >Application</a></div>
                <div><a href="">Schedule</a></div>
                <div><a href="">Payment</a></div>
                <div><a href="Login.php">Login</a></div>
            </div>
        </div>        
    </div>
    <script>
        var slideIndex = 0;
        showSlides();
        function showSlides() {
            var i;
            var slides = document.getElementsByClassName("mySlides");
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";  
            }
            slideIndex++;
            if (slideIndex > slides.length) {slideIndex = 1}    
            slides[slideIndex-1].style.display = "block";
            setTimeout(showSlides, 2000); // Change image every 2 seconds
        }
    </script>
</body>
</html>