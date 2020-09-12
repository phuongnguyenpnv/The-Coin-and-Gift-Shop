<?php
    $conn = mysqli_connect("localhost", "root", "", "thecoingiftshop");
    if ( ! $conn ) {
        echo "\jdhsfjjsdf";
    } else {
        function get_category(){
            $conn = mysqli_connect( "localhost", "root", "", "thecoingiftshop" );
            $sql = "SELECT category_name FROM category_detail";
            $result = $conn->query($sql);
            $category = array("product categories");
            if ($result->num_rows>0){
                $rowcount = 1;
                while($row = mysqli_fetch_assoc($result)){
                echo "<tr>";
                    foreach ($row as $var => $value) {
                        array_push($category, $value);
                    }
                ++$rowcount;
                }
                return $category;
            }
        }
    }


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
                        'item_quantity'          =>     1,
                        'item_image'          =>     $_POST["hidden_image"] 
                    );  
                    $_SESSION["shopping_cart"][$count] = $item_array;  
            }  
            else  
            {  
                    echo '<script>alert("Item Already Added")</script>';  
                    echo '<script>window.location="cart.php"</script>';  
            }  
        }  
        else  
        {  
            $item_array = array(  
                    'item_id'               =>     $_GET["id"],  
                    'item_name'               =>     $_POST["hidden_name"],  
                    'item_price'          =>     $_POST["hidden_price"],  
                    'item_quantity'          =>     1,  
                    'hidden_image'          =>     $_POST["hidden_image"]
            );  
            $_SESSION["shopping_cart"][0] = $item_array;  
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
    <title>The Coin & Gift Shop</title>
</head>
<body class="container-fluid" >
    <?php include("header.php")?>
    <main class="main_jeweiry_shop">
        <div class="background_image">
            <img src="Image/image-shop-default.jpg" alt="">
        </div>
        <section class="shop_title">
            <div class="div_intro_producr">
            <h2>Shop</h2>
            <p>We pride ourselves on the growing catalogue of gold pieces we have to offer! From 10KT to 24KT, 
                every piece has a story to tell and a surprise in store. These pieces often feature precious gems 
                such as diamonds, emeralds, and sapphires in varying designs. Or, if you’d rather skip the flashy 
                stuff, we have plain gold chains, charms, pendants, and more. We bought all of these pieces from 
                Valley locals who came into our physical location in Harrisonburg, Virginia, to see what we have to 
                offer.</p>
            </div>
            <div class="div_filter_pro">
                <form action="/action_page.php">
                    <label for="cars">Filter by:</label>
                    <select class="filter_product" id="cars" name="cars">
                        <option value="volvo">All product</option>
                        <option value="saab">Jewelry</option>
                    </select>
                    <select class="filter_product" id="cars" name="cars">
                    <?php
                        foreach( get_category() as $category ) { ?>
                            <option value="<?php echo $category;?>"><?php echo $category; ?></option>
                    <?php }?>
                    </select>
                </form>
            </div>
        </section>
        <section class="show_Product">
            <div class="div_show_Product">
                <?php
                    
                    $conn = mysqli_connect("localhost", "root", "", "thecoingiftshop");
                    if (!$conn) {
                      echo "\jdhsfjjsdf";
                    }
                    
                    $sql = "SELECT * FROM products_detail";
                    $result = $conn->query($sql);
                    
                    if ($result->num_rows > 0) {
                      // output data of each row
                      while($row = $result->fetch_assoc()) {
                        ?>
                        <form method="post" action="Jeweiry_shop.php?action=add&id=<?php echo $row["pro_detail_id"]; ?>">
                            <div class="Product">
                                <?php $row['pro_detail_id']?>
                                
                                <a href="product_detail.php?id=<?php echo $row['pro_detail_id']; ?>">
                                    
                                <!-- <a class='info' href='chitietsp.php?id=$product[0]'>Chi tiết</a> -->
                                    <div class="product_image">
                                        <img src="image/<?php echo$row['image'];?>" alt="none">
                                    </div>
                                    <br>
                                    <span><?php echo $row["pro_name"];?></span>
                                    <p><?php echo substr($row["comments"],0,70);?></p>
                                    <b>$<?php echo $row["price"];?></b>
                                    <input type="hidden" name="hidden_name" value="<?php echo $row["pro_name"]; ?>" />  
                                    <input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>" />
                                    <input type="hidden" name="hidden_image" value="<?php echo $row["image"]; ?>" />
                                    <input type="submit" id="input_add" name="add_to_cart"class="btn btn-success" value="ADD" />
                                    <!-- <input id="input_add" type="submit" name="add_to_cart" value="ADD"> -->
                                </a>
                            </div>
                      </form>
                        <?php 
                        // echo "id: " . $row["pro_detail_id"]. " - Name: " . $row["pro_name"]. " " . $row["price"]. "<br>";
                      }
                    } else {
                      echo "0 results";
                    }
                    $conn->close();
                    
                ?>
            </div>
        </section>
    </main>
</body>

</html>