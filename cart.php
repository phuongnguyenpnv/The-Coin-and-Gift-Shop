<?php   
 session_start();  
 $connect = mysqli_connect("localhost", "root", "", "thecoingiftshop");
 if(isset($_POST["add_to_cart"]))  
 {  
      if(isset($_SESSION["shopping_cart"]))  
      {  
           $item_array_id = array_column($_SESSION["shopping_cart"], "item_id");  
           if(!in_array($_GET["id"], $item_array_id))  
           {  
                $count = count($_SESSION["shopping_cart"]);  
                $item_array = array(  
                     'item_id'               =>     $_GET["id"],  
                     'item_name'               =>     $_POST["hidden_name"],  
                     'item_price'          =>     $_POST["hidden_price"],  
                     'item_quantity'          =>     $_POST["quantity"]  
                );  
                $_SESSION["shopping_cart"][$count] = $item_array;  
           }  
           else  
           {  
                echo '<script>alert("Item Already Added")</script>';  
                echo '<script>window.location="Jeweiry_shop.php"</script>';  
           }  
      }  
      else  
      {  
           $item_array = array(  
                'item_id'               =>     $_GET["id"],  
                'item_name'               =>     $_POST["hidden_name"],  
                'item_price'          =>     $_POST["hidden_price"],  
                'item_quantity'          =>     $_POST["quantity"]  
           );  
           $_SESSION["shopping_cart"][0] = $item_array;  
      }  
 } 
 if(isset($_GET["action"]))  
 {  
      if($_GET["action"] == "delete")  
      {  
           foreach($_SESSION["shopping_cart"] as $keys => $values)  
           {  
                if($values["item_id"] == $_GET["id"])  
                {  
                     unset($_SESSION["shopping_cart"][$keys]);  
                     echo '<script>alert("Item Removed")</script>';  
                     echo '<script>window.location="cart.php"</script>';  
                }  
           }  
      }  
 }  
 ?> 

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=, initial-scale=1.0">
        <link rel="stylesheet" href="Style/style.css">
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <script src='https://kit.fontawesome.com/a076d05399.js'></script>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <title>The Coin & Gift Shop</title>
    </head>
<body>
    <?php include("header.php")?>
    <main class="card_page">
        <h2>Card</h2>
        <div class="List_Pro_Card">
            <table class="table_product">
                <tr>
                    <th></th>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                    <th></th> 
                </tr>

                <?php   
                          if(!empty($_SESSION["shopping_cart"]))  
                          {  
                               $total = 0;  
                               foreach($_SESSION["shopping_cart"] as $keys => $values)  
                               {  
                          ?>  
                          <tr>  
                               <td><img src="image/<?php echo $values["item_image"]; ?>" alt="none"></td>
                               <td><?php echo $values["item_name"]; ?></td>  
                               <td>$ <?php echo $values["item_price"]; ?></td>  
                               <td>1</td> 
                               <td>$ <?php echo number_format(1 * $values["item_price"], 2); ?></td>  
                               <td><a href="cart.php?action=delete&id=<?php echo $values["item_id"]; ?>"><span class="text-danger">Remove</span></a></td>  
                          </tr>  
                          <?php  
                                    $total = $total + ($values["item_quantity"] * $values["item_price"]);  
                               }  
                          }  
                          ?> 
            </table>
            <div class="Total_Bill">
                <p>Subtotal: <span>$<?php echo number_format($total, 2); ?></span></p>
                <br>
                <p>Shipping</p>
                <p>Free shipping</p>
                <p>Shipping to VA.</p>
                <br>
                <?php $tax = $total*3/100?>
                <p>Tax:<span>$<?php echo number_format($tax, 2); ?></span></p>
                <p>Total: <span>$<?php echo number_format($total + $tax, 2); ?></span></p>
            </div>
            <div class="btn_checkout">
                <a href="Jeweiry_shop.php"><input type="submit" value="Continue shopping"></a>
                <a href="Checkout.php"><input type="submit" value="Process to checkout"></a>
            </div>
        </div>
        
    </main>
</body>