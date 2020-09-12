<?php
    // include("Jeweiry_shop.php");
  $conn = mysqli_connect("localhost", "root", "", "thecoingiftshop");
    // Kiểm tra kết nối
    if ($conn->connect_error) {
        die("Kết nối thất bại: " . $conn->connect_error);
    }
    $conn->set_charset("utf8");

    $id=$_GET['id'];
   
    function get_info_product_detail($conn, $id) {
        $sql = "SELECT * FROM products_detail WHERE pro_detail_id = '".$id."'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = mysqli_fetch_array($result)){
                $product[] = $row;
            }
            mysqli_free_result($result);
            return $product[0];
        }
    }

    $info = get_info_product_detail($conn, $id);
    
    ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=, initial-scale=1.0">
        <link rel="stylesheet" href="Style/style.css">
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <script src='https://kit.fontawesome.com/a076d05399.js'></script>
        <script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>
        <title>The Coin & Gift Shop</title>
    </head>
<body>
    <?php include("header.php")?>
    <main class="detail_product_page">
        <div class="back_shop">
            <a href="Jeweiry_shop.html">back to shop</a>
        </div>
        <div class="div_detail">
            <div class="img_detail">
                <img id="js-img-detail-thumnail" src="image/<?php echo $info[6];?>" alt="">
            </div>
            <div class="other_img">
                <ul class="ul_Images">
                <?php
                    
                    $conn = mysqli_connect("localhost", "root", "", "thecoingiftshop");
                    if (!$conn) {
                      echo "\jdhsfjjsdf";
                    }
                    $id=$_GET['id'];
                    $sql = "SELECT * FROM image, product_relationship_image  
                            where image.image_id = product_relationship_image.image_id
                            and  product_relationship_image.product_detail_id = '".$id."'";
                    $result = $conn->query($sql);
                    
                    if ($result->num_rows > 0) {
                      // output data of each row
                      while($row = $result->fetch_assoc()) {
                        ?>
                            <li class="li_image">
                                <img src="image/<?php echo $row['image_link']?>" alt="">
                            </li>
                        <?php 
                      }
                    } else {
                      echo "0 results";
                    }
                    $conn->close();
                    
                ?>
                </ul>
            </div>
            <div class="content_detail">
                <div class="cont_top">
                    <a href=""><h3>ARTISAN JEWELRY</h3></a>
                    <h2><?php echo $info[1];?></h2>
                    <p>$<?php echo $info[3];?></p>
                    <div class="btn_add">
                        <input type="submit" value="Add to card" id="input_add" name="add_to_cart"class="btn btn-success">
                    </div>
                </div>
                <div class="cont_under">
                    <p><span>SKU: </span><?php echo $info[7];?></p>
                    <p><span>Categories: </span>Artisan Jewelry, Jewelry</p>
                    <p><span>Share on: </span></p>
                </div>

            </div>
        </div>
    </main>

    <script>
        $( document ).ready(function() {
            $('.li_image').click(function(e) {
                var imgUrl = $(this).children().attr('src');
                $('#js-img-detail-thumnail').attr('src', imgUrl);
            });
        });
    </script>
    
</body>
</html>