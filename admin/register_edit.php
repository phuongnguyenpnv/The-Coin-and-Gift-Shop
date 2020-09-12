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
              
              $query_update = "SELECT * FROM register WHERE admin_id='$id' ";
              $query_run = mysqli_query($conn, $query_update);
              // var_dump($query_run);
              foreach($query_run as $row){
          ?>

                <form action="code.php" method="POST">
                      
                    <input type="hidden" name="edit_id" value="<?php echo $row['admin_id'] ?>" >
                    
                    <div class="form-group">
                        <label> Username </label>
                        <input type="text" name="edit_username" value="<?php echo $row['username'] ?>" class="form-control" placeholder="Enter Username">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="edit_email" value="<?php echo $row['email'] ?>" class="form-control" placeholder="Enter Email">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="edit_password" value="<?php echo $row['password'] ?>" class="form-control" placeholder="Enter Password">
                    </div>

                    <a href="register.php" class="btn btn-danger" > CANCEL  </a>
                    <button type="submit" name="updatebtn" class="btn btn-primary"> Update </button>

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