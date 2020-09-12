<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>
<body>
<?php
    // session_start();
    include('../connect.php');
    // include("include/navbar.php");

?>

<div class="container-fluid">
  <div id="wrapper">

    <?php include("include/navbar.php");?>
  
    <div id="content-wrapper" class="d-flex flex-column">
    <!-- Main Content -->
      <div id="content">

        <?php include('include/topbar.php');?>

      <!-- DataTales Example -->
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary"> EDIT Admin Profile </h6>
        </div>
        <div class="card-body">
          <?php
            $conn = mysqli_connect("localhost", "root", "", "thecoingiftshop");
            if(isset($_POST['edit_btn']))
            {
              // echo "sdjfskfjdsjfjdfj";
              $id = $_POST['edit_id'];
              echo $id;
              
              $query_update = "SELECT * FROM products_detail WHERE pro_detail_id='$id' ";
              $query_run = mysqli_query($conn, $query_update);
              // var_dump($query_run);
              foreach($query_run as $row){
          ?>

                <form action="code.php" method="POST">
                      
                    <input type="hidden" name="edit_product_id" value="<?php echo $row['pro_detail_id'] ?>" >
                    
                    <div class="form-group">
                        <label> Product name </label>
                        <input type="text" name="edit_pro_name" class="form-control" value="<?php  echo $row['pro_name']; ?>" placeholder="Enter product name">
                    </div>
                    <div class="form-group">
                        <label>Cost price</label>
                        <input type="text" name="edit_cost_price" class="form-control" value="<?php  echo $row['cost_price']; ?>" placeholder="Enter cost price">
                        <!-- <small class="error_email" style="color: red;"></small> -->
                    </div>
                    <div class="form-group">
                        <label>Price</label>
                        <input type="text" name="edit_price" class="form-control" value="<?php  echo $row['price']; ?>" placeholder="Enter price">
                    </div>
                    <div class="form-group">
                        <label>Quantity</label>
                        <input type="text" name="edit_quantity" class="form-control" value="<?php  echo $row['quantity']; ?>" placeholder="Enter quantity">
                    </div>
                    <div class="form-group">
                        <label>Comments</label>
                        <input type="text" name="edit_comments" class="form-control" value="<?php  echo $row['comments']; ?>" placeholder="Enter comments">
                    </div>
                    <div class="form-group">
                        <label>Image</label>
                        <input type="file" name="edit_image" class="form-control" value="<?php  echo $row['image']; ?>" placeholder="Enter image">
                    </div>
                    <div class="form-group">
                        <label>Sku</label>
                        <input type="text" name="edit_sku" class="form-control" value="<?php  echo $row['sku']; ?>" placeholder="Enter sku">
                    </div>


                    <a href="product_admin.php" class="btn btn-danger" > CANCEL  </a>
                    <button onclick="update_success()" type="submit" name="update_product_btn" class="btn btn-primary"> Update </button>

                </form>
              <?php
                }
              }
              ?>
        </div>
        </div>
      </div>

    </div>
  </div>
</div>
<!-- /.container-fluid -->
<?php include('include/script.php');?>
</body>
</html>