<?php
include('../connect.php');
        
        
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="css/style.css">
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
        <div class="modal fade" id="addproduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Admin Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>

            </div>
          </div>
        </div>

        <div class="card shadow mb-4">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Admin category</h6>
          </div>
          <div class="card-body">

            <div class="table-responsive">
            
              <?php 
                $conn = mysqli_connect("localhost", "root", "", "thecoingiftshop");
                $query = "SELECT * FROM category_detail";
                $query_run = mysqli_query($conn, $query);
              ?>
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                      <th> ID </th>
                      <th> Category name </th>
                      <th> Description </th>
                      <th> EDIT</th>
                      <th> DELETE</th>
                      <th> DETAIL</th>
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
                    <td><?php  echo $row['category_detail_id']; ?></td>
                    <td><?php  echo $row['category_name']; ?></td>
                    <td><?php  echo $row['Category_content']; ?></td>
                    <td>
                        <form action="product_admin_edit.php" method="post">
                            <input type="hidden" name="edit_id" value="<?php echo $row['pro_detail_id']; ?>">
                            <button  type="submit" name="edit_category_btn" class="btn btn-success"> EDIT</button>
                        </form>
                    </td>
                    <td>
                        <form action="code.php" method="post">
                          <input type="hidden" name="delete_id" value="<?php echo $row['pro_detail_id']; ?>">
                          <button type="submit" name="delete_category_btn" class="btn btn-danger"> DELETE</button>
                        </form>
                    </td>
                    <td>
                        <form action="code.php" method="post">
                          <input type="hidden" name="delete_id" value="<?php echo $row['pro_detail_id']; ?>">
                          <button type="submit" name="Detail_category_btn" class="btn btn-danger"> DETAIL</button>
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