

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <link rel="stylesheet" href="Style/style.css">
    <!-- <link rel="stylesheet" href="Style.slick.css"> -->
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <!-- <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/> -->
    
    <title>The Coin & Gift Shop</title>
</head>
<body class="container-fluid">
    <?php include("header.php");?>
    <!-- <section> -->
        <section class="div_slide">
            <div class="img_slide single-item">
                <?php
                    $conn = mysqli_connect("localhost", "root", "", "thecoingiftshop");
                    if (!$conn) {
                      echo "\jdhsfjjsdf";
                    }
                    $sql = "SELECT image_link FROM thecoingiftshop.image where content = 'Slide'";
                    $result = $conn->query($sql);
                    
                    if ($result->num_rows > 0) {
                      while($row = $result->fetch_assoc()) {
                        ?>
                            <div class="mySlides Item" style="background-image: url('image/<?php echo $row["image_link"]?>');">
                            </div>
                        <?php 
                      }
                    } else {
                      echo "0 results";
                    }
                    $conn->close();
                ?>
            </div>
            <div class="slide_content">
                <h1>The Coin and Gift Shop</h1>
                <h2>in Harrisonburg, Virginia</h2>
            </div>
            <div class="btn_button">
                <button class="btn_left" onclick="plusDivs(-1)">&#10094;</button>
                <button class="btn_right" onclick="plusDivs(1)">&#10095;</button>
            </div>      
        </section>
        <section class="Our_Services">
            <div class="Serv_Image">
                <img src="Image/Our-Service.jpg" alt="">
            </div>
            <div class="Serv_content">
                <h2>Our Products</h2>
                <p>The Coin & Gift Shop is a coin dealer that buys and sells scrap gold, silver, jewelry, and precious metals. 
                    Whether you are looking to buy precious metals at incredibly low prices or make some quick cash by selling 
                    your own unwanted gold or silver, we are always happy to serve you.</p>
                <p>The Coin & Gift Shop specializes in buying and selling rare coins, jewelry, and bullion. We carry gold, silver 
                    and copper coins. Additionally, we are authorized dealers for PCGS (Professional Coin Grading Service) and NGC 
                    (Numismatic Guaranty Corporation). Stop by today to view our inventory.</p>
                <p>The Coin & Gift Shop are experts with digitizing and selling coins and jewelry for online venues such as auctions 
                    and Ebay.</p>
            </div>
        </section>
        <section class="Our_Products">
            <div class="cont_Product">
                <h2>Our Products</h2>
                <p>We have been proudly serving the greater Harrisonburg community since 1993. Backed by more than 50 years of experience 
                    in the gold and silver buying and selling field, our team excels in finding the very best deals for all.</p>
            </div>
            <div class="Imgages_product">
                <ul class="Img_4_Product">
                    <li class="Img_Pro">
                        <img src="Image/coin.jpg" alt="">
                        <p>Coin</p>
                    </li>
                    <li class="Img_Pro">
                        <img src="Image/paper-money.jpg" alt="">
                        <p>Paper Money</p>
                    </li>
                    <li class="Img_Pro">
                        <img src="Image/Gold.jpg" alt="">
                        <p>Gold</p>
                    </li>
                    <li class="Img_Pro">
                        <img src="Image/silver.jpg" alt="">
                        <p>Sliver</p>
                    </li>
                </ul>
            </div>
        </section>
        <section class="Online_shop">
            <div class="cont_online_shop">
                <h2>Jewelry and Gift Online Shop</h2>
                <p>Interested in a boutique bracelet or a diamond ring?</p>
                <p>Browse our selection of jewelry and buy with a few clicks!</p>
                <p>Shipping is Free!</p>
            </div>
            <div class="Img_online_shop">
                <a href="Jeweiry_shop.php">
                    <img src="Image/JJP794-3-340x360.jpg" alt="">
                    <span style="color: #ffffff;"><p>Jewelry</p></span>
                </a>
            </div>
        </section>
        <section class="about_us">
            <div class="About_content">
                <h2>About Us</h2>
                <p>The Coin and Gift Shop is a special place full of history, character, jewelry and yes, an abundance of coins. 
                    This is a place where people can bring their treasures, estate items, scrap gold and silver, and/or coins and 
                    currency, to get a very fair price. The current owners are business partners with various expertise and experiences 
                    that add to the character and charm of The Coin and Gift Shop.</p>
                <p>Here at The Coin & Gift Shop, our team is dedicated to buying and selling gold, silver, and precious metals at prices 
                    that make everyone happy. We are always on the lookout for gold and silver jewelry. If you have jewelry or scrap 
                    metal that you need to get rid of, bring it to The Coin & Gift Shop to sell it to us for top dollar. The market for 
                    gold and silver is incredibly lucrative right now, so don’t wait too long!</p>
                <p>We look forward to meeting you or, seeing you again!</p>
            </div>
            <div class="About_Image">
                <img src="Image/Exterior-Photo-Slide1.jpg" alt="">
            </div>
        </section>
        <section class="Local_Artwork">
            <div class="Local_Image">
                <img src="Image/Art-Wall_Test21.jpg" alt="">
            </div>
            <div class="Local_content">
                <h2>Local Artwork</h2>
                <p>The Coin and Gift Shop is proud to have designated a wall for local artist to display their art for a contracted 
                    period of time. This wall provides a safe space for artists who can either display their art, and/or offer artwork 
                    for purchase to the public. An application, examples of artwork and a signed contract provided by The Coin and Gift 
                    Shop must be completed. Come in to see this month’s featured artist!</p>
                <p>The wall has been named, Gloria B. Art Wall, as a tribute to the previous owner. Gloria is a native to the Commonwealth, 
                    who became an expert with precious metals, gemstones, and costume jewelry creating one-of-a kind collections that have
                     given thousands of customers pleasure from viewing and purchasing.</p>
            </div>
        </section>
        <section class="Testimonials">
            <div>
                <h2>Testimonials</h2>
            </div>
            <div>
                <img src="Image/testimonials.svg" alt="">
            </div>
            <div class="cont_Testimonials">
                <p>I was greeted by a staff that was very personable. I was actually surprised that a 10 carat gold chain was worth more than
                     what I originally purchased it for at retailer. If someone comes to me and say “Where would you go to sell some old broken 
                     jewelry?” I would say: “Definitely The Coin & Gift Shop in Harrisonburg.”</p>
                <div class="auther">
                    <h3> Nicole Klingensmith </h3>
                    <P>Custommers</P>
                </div>
            </div>
        </section>
        <section>
            <div class="tab-content">
                <div id="map-canvas" class="map-canvas">
                    <a href="https://www.google.com/maps/place/Coin+%26+Gift+Shop/@38.4312,-78.843467,18z/data=!4m5!3m4!1s0x89b4929f2ec9fe4f:0x257414e9d6644cb5!8m2!3d38.4311974!4d-78.8434629" target="_blank">
                    <img src="https://dm6euc7wbbgqw.cloudfront.net/uploads/2017/02/map.png" alt=""></a>
                </div>
            </div>
        </section>
        <section class="contact_us">
            <div class="content_contact">
                <h2>Contact Us</h2>
                <h4>DO NOT USE THIS FORM TO SOLICIT PRODUCTS OR SERVICES! ANY SUCH ENTRIES WILL BE IGNORED!</h4>
                <div class="details_cont_contact">
                    <p>Are you curious to know what that old coin your grandfather left you might be worth? Or how
                         about a pile of jewelry that you haven’t worn in years? Send us a note using this form!
                        <br> We love to hear from you!</p>
                    
                    <p> <strong>Hours of Operation:</strong> <br> Tuesday – Saturday: 10 am – 5 pm</p>
                    <p>
                        <strong>The Coin & Gift Shop:</strong>
                        <br>1855 E Market Street, Harrisonburg, VA 22801 – 5101.
                        <br>Phone number: (540) 434 – 1938
                    </p>
                    <p>
                        <strong>Member:</strong>
                        <br>American Numismatic Association (ANA)
                        <br>Virginia Numismatic Association (VNA)
                    </p>
                    <p>
                        <strong>Serving:</strong>
                        <br>The Shenandoah Valley and beyond.
                    </p>
                    
                </div>
            </div>
            <div class="form_contact">
                <input type="text" id="fname" name="fname" placeholder="First name & Last name"><br>
                <input type="text" id="email" name="email" placeholder="Email"><br>
                <input type="text" id="phone" name="phone" placeholder="Phone number"><br>
                <textarea name="your-message" cols="54" rows="10" placeholder="Message"></textarea>
                <div class="form_under_content">
                    <p>This site is protected by reCAPTCHA and the Google 
                        <a href="https://policies.google.com/privacy"><span>Privacy Policy</span></a> and 
                        <a href="https://policies.google.com/terms"><span>Terms of Service</span></a>
                         apply.</p>
                </div>
                <div class="form_button">
                    <input type="submit" value="Send">
                </div>
            </div>
        </section>
    <!-- </section> -->
    <footer>

    </footer>
<script src='https://kit.fontawesome.com/a076d05399.js'></script>
<script src="Js/script.js"></script>
<!-- <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script> -->
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
<!-- <script type="text/javascript" src="jquery-3.3.1.js"></script> -->


<script>
    var slideIndex = 1;
    showDivs(slideIndex);
    function plusDivs(n) {
        showDivs(slideIndex += n);
    }
    function showDivs(n) {
        var i;
        var x = document.getElementsByClassName("mySlides");
         if (n > x.length) {
            slideIndex = 1
        }
         if (n < 1) {
             slideIndex = x.length
        }
        for (i = 0; i < x.length; i++) {
            x[i].style.display = "none";  
        }
    x[slideIndex-1].style.display = "block";  

    }
// -------------------------------------------------
    var slideIndex = 0;
    carousel();

    function carousel() {
    var i;
    var x = document.getElementsByClassName("mySlides");
    for (i = 0; i < x.length; i++) {
        x[i].style.display = "none";
    }
    slideIndex++;
    if (slideIndex > x.length) {slideIndex = 1}
    x[slideIndex-1].style.display = "block";
    setTimeout(carousel, 2000); // Change image every 2 seconds
    }
</script>
</body>

</html>


