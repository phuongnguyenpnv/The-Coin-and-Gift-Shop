<?php
    if (isset($_SESSION['shopping_cart']) && is_array($_SESSION['shopping_cart']) && !empty($_SESSION['shopping_cart'])) {
    if (isset($_POST["checkout_place_order"])) {

    $billing_first_name = $_POST['f_name'];
    $billing_last_name = $_POST['l_name'];
    $billing_address_1 = $_POST['street'];
    $billing_address_2 = $_POST['street1'];
    $billing_city = $_POST['City'];
    $billing_state = $_POST['City1'];
    $billing_postcode = $_POST['billing_postcode'];
    $billing_phone = $_POST['phone'];
    $billing_email = $_POST['email'];
    $order_comments = $_POST['Order_notes1'];
    $password = md5("1234");
    $order_date = date("Y/m/d");


    if (isset($_POST['ship_to_different_address']) && $_POST['ship_to_different_address'] == "1") {//ship đến 1 địa chỉ khác
        $shipping_first_name = $_POST['f_name1'];
        $shipping_last_name = $_POST['l_name1'];
        $shipping_address_1 = $_POST['street'];
        $shipping_address_2 = $_POST['street1'];
        $shipping_city = $_POST['City'];
        $shipping_state = $_POST['State'];
        $shipping_postcode = $_POST['zip'];

        if (empty($shipping_first_name)) {
            $errors[] = 'Shipping First name';
        }
        if (empty($shipping_last_name)) {
            $errors[] = 'Shipping Last name';
        }
        if (empty($shipping_address_1)) {
            $errors[] = 'Shipping Address';
        }
        if (empty($shipping_address_2)) {
            $errors[] = 'Shipping Address';
        }
        if (empty($shipping_city)) {
            $errors[] = 'Shipping City';
        }
        if (empty($shipping_state)) {
            $errors[] = 'Shipping State';
        }
        if (empty($shipping_postcode)) {
            $errors[] = 'Shipping Post code';
        }


        if (isset($errors) && $errors > 0) {
            foreach ($errors as &$value) {//error query entered
?>
    <li><strong> <?php echo $value ?> </strong><?php echo "is a required field." ?></li>
    </br>
<?php
}
        } else {
            $query = "SELECT * from customers where email = '$billing_email' ";
            $query_run = mysqli_query($conn, $query);

            if (mysqli_num_rows($query_run) == 0) {//Send it to different address, in case the email not used
                $sender_name = $billing_first_name.' '.$billing_last_name;
                $sender_postcode = $billing_postcode;
                $sender_address = $billing_address_1;
                $sender_city = $billing_city;
                $recipient_name = $shipping_first_name.' '.$shipping_last_name;
                $recipient_postcode = $shipping_postcode;
                $recipient_city = $shipping_city;
                $recipient_address = $shipping_address_1;

                $query_user = "INSERT INTO customers (firstname, lastname, phone, email, password, street_address, city, state, zip, order_note) 
                VALUES('$billing_first_name', '$billing_last_name', '$billing_phone', '$billing_email', '$password', '$sender_address', '$sender_city', '$billing_state', '$sender_postcode', '$order_comments')";
                mysqli_query($conn, $query_user);

                if ($conn->query($query_user) === true) {
                    $last_user_id = $conn->insert_id;
                    $ship_address = $shipping_address_1;

                    $query_order = "INSERT INTO orders (user_id ,recipient_name ,order_date ,payment ,ship_address ) 
                    VALUES('$last_user_id','$recipient_name','$order_date','$payment','$ship_address')";
                    mysqli_query($conn, $query_order);

                    if ($conn->query($query_order) === true) {
                        $last_order_id = $conn->insert_id;

                        foreach ($_SESSION['shopping_cart'] as $key => $value) {
                            $product_dt_id = $_SESSION['shopping_cart'][$key]["item_id"];
                            $quantity = $_SESSION['shopping_cart'][$key]["item_quantity"];
                            $query = "SELECT * FROM products_detail where pro_detail_id ='$product_dt_id'";
                            $query_run = mysqli_query($conn, $query);
                            while ($row = mysqli_fetch_assoc($query_run)) {
                                $price = $row['price'];
                                $quantitypro = $row['quantity'];
                                //update quantity product
                                $query = "UPDATE products_detail set quantity= $quantitypro - $quantity  where pro_detail_id ='$product_dt_id'";
                                $query_run = mysqli_query($conn, $query);
                            }

                            $query_order_detail = "INSERT INTO orders_detail (order_detail_id ,product_id  ,price ,quantity ) 
                        VALUES('$last_order_id','$product_dt_id','$price','$quantity')";
                            mysqli_query($conn, $query_order_detail);
                        }
                            //send mail order
                        //  include_once("./mailorder.php");
                    }
                }


            ?>
                <script>
                    if (window.history.replaceState) {
                        window.history.replaceState(null, null, window.location.href);
                    }
                </script>
            <?php
            } else {//Send it to different address, in case the email is already in use
                while ($row = mysqli_fetch_assoc($query_run)) {
                    $sender_name = $row['firstname'].$row['lastname'];
                    $sender_postcode = $row['zip'];
                    $sender_address = $row['street_address'];
                    $sender_city = $row['city'];
                    $recipient_name = $shipping_first_name.' '.$shipping_last_name;
                    $recipient_postcode = $shipping_postcode;
                    $recipient_city = $shipping_city;
                    $recipient_address = $shipping_address_1;
                    $user_id = $row['cus_id'];

                    $query_order = "INSERT INTO orders (cus_id ,recipient_name ,order_date  ,ship_address ) 
                    VALUES('$user_id','$recipient_name','$order_date','$recipient_address')";
                    mysqli_query($conn, $query_order);

                    if ($conn->query($query_order) === true) {
                        $last_order_id = $conn->insert_id;

                        foreach ($_SESSION['shopping_cart'] as $key => $value) {
                            $product_dt_id = $_SESSION['shopping_cart'][$key]["product_id"];
                            $quantity = $_SESSION['cart'][$key]["item_quantity"];
                            $query = "SELECT * FROM product_details where pro_detail_id ='$product_dt_id'";
                            $query_run = mysqli_query($conn, $query);
                            while ($row = mysqli_fetch_assoc($query_run)) {
                                $price = $row['price'];
                                $quantitypro = $row['quantity'];
                                //update quantity product
                                $query = "UPDATE product_details set quantity= $quantitypro - $quantity  where product_dt_id ='$product_dt_id'";
                                $query_run = mysqli_query($conn, $query);
                            }

                            $query_order_detail = "INSERT INTO order_detail (order_id ,product_id  ,price ,quantity ) 
                        VALUES('$last_order_id','$product_dt_id','$price','$quantity')";
                            mysqli_query($conn, $query_order_detail);
                        }
                            // //send mail order
                            // include_once("./mailorder.php");
                            echo '<script>window.location="Jeweiry_shop.php"</script>';
                    }
                }
            }
        }
    } else { // Do not ship to different address
        if (isset($errors) && $errors > 0) {// error query entered
            foreach ($errors as &$value) {
            ?>
                <li><strong> <?php echo $value ?> </strong><?php echo "is a required field." ?></li>
                </br>
            <?php
            }
        } else {
            $sender_name = $billing_first_name.' '.$billing_last_name;
            $sender_postcode = $billing_postcode;
            $sender_address = $billing_address_1;
            $sender_city = $billing_city;
            $recipient_name = $billing_first_name.' '.$billing_last_name;
            $recipient_postcode = $billing_postcode;
            $recipient_city = $billing_city;
            $recipient_address = $billing_address_1;

            $query = "SELECT * from users where email = '$billing_email' ";
            $query_run = mysqli_query($conn, $query);

            if (mysqli_num_rows($query_run) == 0) {// Do not ship to different address, in case the email has not been used
                
                $query_user = "INSERT INTO users (first_name, last_name, phone, email, password, street_address, city, state, zip_code, order_note, role_id) 
                VALUES('$billing_first_name', '$billing_last_name', '$billing_phone', '$billing_email', '$password', '$sender_address', '$sender_city', '$billing_state', '$sender_postcode', '$order_comments', '0')";
                mysqli_query($conn, $query_user);

                if ($conn->query($query_user) === true) {
                    $last_user_id = $conn->insert_id;
                    $recipient_name = $billing_first_name . ' ' . $billing_last_name;

                    $query_order = "INSERT INTO orders (user_id ,recipient_name ,order_date ,payment ,ship_address ) 
                    VALUES('$last_user_id','$recipient_name','$order_date','$payment','$billing_address_1')";
                    mysqli_query($conn, $query_order);

                    if ($conn->query($query_order) === true) {
                        $last_order_id = $conn->insert_id;

                        foreach ($_SESSION['shopping_cart'] as $key => $value) {
                            $product_dt_id = $_SESSION['shopping_cart'][$key]["product_id"];
                            $quantity = $_SESSION['shopping_cart'][$key]["item_quantity"];
                            $query = "SELECT * FROM product_details where pro_detail_id ='$product_dt_id'";
                            $query_run = mysqli_query($conn, $query);
                            while ($row = mysqli_fetch_assoc($query_run)) {
                                $price = $row['price'];
                                $quantitypro = $row['quantity'];
                                //update quantity product
                                $query = "UPDATE product_details set quantity= $quantitypro - $quantity  where product_dt_id ='$product_dt_id'";
                                $query_run = mysqli_query($conn, $query);
                            }

                            $query_order_detail = "INSERT INTO order_detail (order_id ,product_id  ,price ,quantity ) 
                        VALUES('$last_order_id','$product_dt_id','$price','$quantity')";
                            mysqli_query($conn, $query_order_detail);
                        }
                            //send mail order
                            // include_once("./mailorder.php");
                    }
                }


            ?>
                <script>
                    if (window.history.replaceState) {
                        window.history.replaceState(null, null, window.location.href);
                    }
                </script>
<?php
    } else {//Do not ship to different address, in case the email is already in use 
        while ($row = mysqli_fetch_assoc($query_run)) {
            $sender_name = $row['first_name'].$row['last_name'];
            $sender_postcode = $row['zip_code'];
            $sender_address = $row['street_address'];
            $sender_city = $row['city'];
            $recipient_name = $row['first_name'].$row['last_name'];
            $recipient_postcode = $row['zip_code'];
            $recipient_city = $row['city'];
            $recipient_address = $row['street_address'];

            $recipient_name = $billing_first_name . ' ' . $billing_last_name;
            $user_id = $row['user_id'];

            $query_order = "INSERT INTO orders (user_id ,recipient_name ,order_date ,payment ,ship_address ) 
            VALUES('$user_id','$recipient_name','$order_date','$payment',' $recipient_address')";
            mysqli_query($conn, $query_order);

            if ($conn->query($query_order) === true) {
                $last_order_id = $conn->insert_id;

                foreach ($_SESSION['cart'] as $key => $value) {
                    $product_dt_id = $_SESSION['cart'][$key]["product_id"];
                    $product_name = $_SESSION['cart'][$key]["product_name"];
                    $quantity = $_SESSION['cart'][$key]["item_quantity"];
                    $query = "SELECT * FROM product_details where product_dt_id ='$product_dt_id'";
                    $query_run = mysqli_query($conn, $query);
                    while ($row = mysqli_fetch_assoc($query_run)) {
                        $price = $row['price'];
                        $quantitypro = $row['quantity'];
                        //update quantity product
                        $query = "UPDATE product_details set quantity= $quantitypro - $quantity  where product_dt_id ='$product_dt_id'";
                        $query_run = mysqli_query($conn, $query);
                    }

                    $query_order_detail = "INSERT INTO order_detail (order_id ,product_dt_id ,product_name ,price ,quantity ) 
                VALUES('$last_order_id','$product_dt_id','$product_name','$price','$quantity')";
                    mysqli_query($conn, $query_order_detail);
                }

                //send mail order
                include_once("./mailorder.php");
            }
        }
    }
    ?>
        <script>
            if (window.history.replaceState) {
                window.history.replaceState(null, null, window.location.href);
            }
        </script>
    <?php
    }
    }
}
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="Style/style.css">
    <title>Document</title>
</head>
<body>





    <?php include("header.php")?>
    <main class="cont_checkout">
        <section class="title_checkout">
            <h2>Checkout</h2>
        </section>
        <section class="coupon">
            <div class="click_coupon">
                <p>Have a coupon? <a href="#" onclick="myFunction()">Click here to enter your code</a></p>
            </div>
            <div class="enter_code" id="enter_code">
                <input type="text" class="c_code" name="c_code" placeholder="Coupon code">
                <input type="submit" class="btn_apply_code" name="apply_coupon" value="Apply coupon">
            </div>
        </section>
        <section class="Billing_details">
            <h3>Billing details</h3>
            <div class="input_name">
                <div class="f_name">
                    <label for="f_name">FIrst name *</label><br>
                    <input type="text" class="f_name" name="f_name" placeholder="">
                </div>
                <div class="l_name">
                    <label for="l_name">Last name *</label><br>
                    <input type="text" class="l_name" name="l_name" placeholder="">
                </div>
            </div>
            <div>
                <label for="country_region">Country / Region *</label>
                <p>United States (US)</p>
            </div>
            <div class="address"> 
                <label for="address ">Street address *</label> <br>
                <input type="text" class="street" name="street" placeholder="House number and street name">

                <label for="city ">Town / City *</label> <br>
                <input type="text" class="City" name="City" placeholder="">

                <label for="State ">State *</label> <br>
                <select class="select_State" id="State" name="State">
                    <option value="AL">Alabama</option>
                    <option value="AK">Alaska</option>
                    <option value="AZ">Arizona</option>
                    <option value="AR">Arkansas</option>
                    <option value="CA">California</option>
                    <option value="CO">Colorado</option>
                </select>
                <br>

                <label for="zip ">Zip *</label> <br>
                <input type="text" class="zip" name="zip" placeholder="">

                <label for="phone ">Phone *</label> <br>
                <input type="text" class="phone" name="phone" placeholder="">

                <label for="email ">Email *</label> <br>
                <input type="text" class="email" name="email" placeholder="">
            </div>
        </section>
        <section class="different_address">
            <div class="other_add"> 
                <h3>Ship to a different <br> address? </h3>
                <input onclick="func_show_otheradd()" type="checkbox" checked="checked" name="radio"> 
            </div>
            <div id="other_address">
                <div class="input_name">
                    <div class="f_name">
                        <label for="f_name">FIrst name *</label><br>
                        <input type="text" class="f_name" name="f_name" placeholder="">
                    </div>
                    <div class="l_name">
                        <label for="l_name">Last name *</label><br>
                        <input type="text" class="l_name" name="l_name" placeholder="">
                    </div>
                </div>
                <div>
                    <label for="country_region">Country / Region *</label>  
                    <p>United States (US)</p>
                </div>
                <div class="address"> 
                    <label for="address ">Street address *</label> <br>
                    <input type="text" class="street" name="street" placeholder="House number and street name">
                    <br>
    
                    <label for="city ">Town / City *</label> <br>
                    <br>
                    <input type="text" class="City" name="City" placeholder="">
                    <br>
    
                    <label for="State ">State *</label> <br>
                    <select class="select_State" id="State" name="State">
                        <option value="AL">Alabama</option>
                        <option value="AK">Alaska</option>
                        <option value="AZ">Arizona</option>
                        <option value="AR">Arkansas</option>
                        <option value="CA">California</option>
                        <option value="CO">Colorado</option>
                    </select>
                    <br>
    
                    <label for="zip ">Zip *</label>
                    <br>
                    <input type="text" class="zip" name="zip" placeholder="">
                    <br>
                </div> 
            </div>   
            <div>
                <label for="Order_notes ">Order notes (optional) *</label>
                <br>
                <textarea name="Order_notes" id="" cols="49" rows="10" placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
            </div>
        </section>
        <section class="Your_order">
            <h3>Your order</h3>
            <div class="">
            <table class="table_product_checkout">
                <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                </tr>

                <?php   
                          if(!empty($_SESSION["shopping_cart"]))  
                          {  
                               $total = 0;  
                               foreach($_SESSION["shopping_cart"] as $keys => $values)  
                               {  
                          ?>  
                          <tr>  
                               <td><?php echo $values["item_name"]; ?></td>  
                               <td>1</td> 
                               <td>$ <?php echo number_format(1 * $values["item_price"], 2); ?></td>  
                          </tr>  
                          <?php  
                                    $total = $total + ($values["item_quantity"] * $values["item_price"]);  
                               }  
                          }  
                          ?> 
            </table>
            <table class="table_product_checkout">
                <tr>
                    <td class="title_total">Subtotal:</td>
                    <td class="detail_total"><span>$<?php echo number_format($total, 2); ?></span></td>
                </tr>
                <tr>
                    <td class="title_total">Shipping:</td>
                    <td class="detail_total">Free shipping</td>
                </tr>
                <tr>
                    <?php $tax = $total*3/100?>
                    <td class="title_total">Tax:</td>
                    <td class="detail_total">$<?php echo number_format($tax, 2); ?></td>
                </tr>
                <tr>
                    <td class="title_total">Total:</td>
                    <td class="detail_total">$<?php echo number_format($total + $tax, 2); ?></td>
                </tr>
            </table>
        </section>
        
        <div class="form-row place-order">
            <input type="submit" class="btn_checkout_submit btn" name="checkout_place_order" id="place_order" value="Process to checkout" data-value="Process to checkout">
        </div>
    </main>
    <script>
        function myFunction() {
          var x = document.getElementById("enter_code");
          if (x.style.display === "none") {
            x.style.display = "block";
          } else {
            x.style.display = "none";
          }
        }
        function func_show_otheradd() {
          var x = document.getElementById("other_address");
          if (x.style.display === "none") {
            x.style.display = "block";
          } else {
            x.style.display = "none";
          }
        }
    </script>
</body>
</html>