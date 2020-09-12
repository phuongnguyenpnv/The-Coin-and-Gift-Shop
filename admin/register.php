<?php
include('../connect.php');
        
        
?>
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
<div class="container-fluid">
  
  <div id="wrapper">

    <?php include("include/navbar.php");?>
 
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <?php include('include/topbar.php');?>

        <!-- Begin Page Content -->
        <div class="modal fade" id="addadminprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Admin Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form action="code.php" method="POST">

                <div class="modal-body">

                    <div class="form-group">
                        <label> Username </label>
                        <input type="text" name="username" class="form-control" placeholder="Enter Username">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control checking_email" placeholder="Enter Email">
                        <small class="error_email" style="color: red;"></small>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Enter Password">
                    </div>
                    <div class="form-group">
                        <label>Confirm Password</label>
                        <input type="password" name="confirmpassword" class="form-control" placeholder="Confirm Password">
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="registerbtn" class="btn btn-primary">Save</button>
                </div>
              </form>

            </div>
          </div>
        </div>

        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addadminprofile">
              Add Admin Profile 
        </button>

        <div class="card shadow mb-4">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Admin Profile</h6>
          </div>
          <div class="card-body">

            <div class="table-responsive">
            
              <?php 
                $conn = mysqli_connect("localhost", "root", "", "thecoingiftshop");
                $query = "SELECT * FROM register";
                $query_run = mysqli_query($conn, $query);
              ?>
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                      <th> ID </th>
                      <th> Username </th>
                      <th>Email </th>
                      <th>Password</th>
                      <th>EDIT</th>
                      <th>DELETE</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                if(mysqli_num_rows($query_run) > 0)        
                {
                    while($row = mysqli_fetch_assoc($query_run))
                    {
                      ?>
                  <tr>
                    <td><?php  echo $row['admin_id']; ?></td>
                    <td><?php  echo $row['username']; ?></td>
                    <td><?php  echo $row['email']; ?></td>
                    <td><?php  echo $row['password']; ?></td>
                    <td>
                        <form action="register_edit.php" method="post">
                            <input type="hidden" name="edit_id" value="<?php echo $row['admin_id']; ?>">
                            <button  type="submit" name="edit_btn" class="btn btn-success"> EDIT</button>
                        </form>
                    </td>
                    <td>
                        <form action="code.php" method="post">
                          <input type="hidden" name="delete_id" value="<?php echo $row['admin_id']; ?>">
                          <button type="submit" name="delete_btn" class="btn btn-danger"> DELETE</button>
                        </form>
                    </td>
                  </tr>
                  <?php
                    } 
                }
                else {
                    echo "No Record Found";
                }
                ?>
                </tbody>
              </table>
          
            </div>
          </div>
        </div>
        

        
        
    <div>

    
    <!-- /.container-fluid -->
  </div>
</div>

  <!-- End of Main Content -->

  <!-- Footer -->
  <footer class="sticky-footer bg-white">
    <div class="container my-auto">
      <div class="copyright text-center my-auto">
        <span>Copyright &copy; Your Website 2020</span>
      </div>
    </div>
  </footer>
  <!-- End of Footer -->

</div>


<!-- /.container-fluid -->
<?php include('include/script.php');?>
</body>
</html>