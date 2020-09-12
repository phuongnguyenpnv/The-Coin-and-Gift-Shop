<?php   
 session_start();  
 $connect = mysqli_connect("localhost", "root", "", "thecoingiftshop");
 
//  if(isset($_GET["action"]))  
//  {  
//       if($_GET["action"] == "delete")  
//       {  
//            foreach($_SESSION["shopping_cart"] as $keys => $values)  
//            {  
//                 if($values["item_id"] == $_GET["id"])  
//                 {  
//                      unset($_SESSION["shopping_cart"][$keys]);  
//                      echo '<script>alert("Item Removed")</script>';  
//                      echo '<script>window.location="cart.php"</script>';  
//                 }  
//            }  
//       }  
//  }  
 ?> 
<header>
    <div class="div_logo">
        <a href="homepage.php"><img src="Image/logo.png" alt="no Image"></a>
    </div>
    <div class="div_menu">
        <ul>
            <li><a href="homepage.php">Home</a></li>
            <li><a href="">Services</a></li>
            <li><a href="Jeweiry_shop.php">Jeweiry Shop</a></li>
            <li><a href="">Blog</a></li>
            <li><a href="">About Us</a></li>
            <li><a href="">Local Artwork</a></li>
            <li><a href="">Contact Us</a></li>
            </ul>
    </div>
    <div class="div_social">
        <i class="fab fa-facebook-square"></i>
        <i class="fab fa-instagram"></i>
        <i class="fab fa-youtube"></i>

    </div>
    <div class="shopping_cart">
        <a href="cart.php">
            <div class="cart_image">
            <img src="image/shopping-cart.png" alt="cart">
            </div>
            <div class="cart_content">
                <b class="cart-badge">
                    <?php
                        if (isset($_SESSION['shopping_cart']) && is_array($_SESSION['shopping_cart'])) {
                            $totalquantity = 0;
                            foreach ($_SESSION['shopping_cart'] as $key => $value) {

                                $totalquantity = $totalquantity + $_SESSION['shopping_cart'][$key]["item_quantity"];
                            }
                        } else {
                            $totalquantity = 0;
                        }
                        if( $totalquantity == 0 ){
                            unset($_SESSION['cart']);
                        }
                        echo $totalquantity." Item in cart";
                    ?>
                </b>
                <b class="cart-badge">
                    <?php
                        if(!empty($_SESSION["shopping_cart"]))  
                        {  
                            $total = 0;  
                            foreach($_SESSION["shopping_cart"] as $keys => $values)  
                            {  
                                $total = $total + ($values["item_quantity"] * $values["item_price"]);  
                            }  
                        } 
                        echo "$ ".$total; 
                    ?>  
                </b>
            </div>

        </a>
    </div>
</header>