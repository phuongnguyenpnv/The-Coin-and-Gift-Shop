<?php
// include('security.php');
$conn = mysqli_connect("localhost", "root", "", "thecoingiftshop");
if(isset($_POST['registerbtn']))
{
    
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['confirmpassword'];

    $email_query = "SELECT * FROM register WHERE email='$email' ";
    $email_query_run = mysqli_query($conn, $email_query);
    if(mysqli_num_rows($email_query_run) > 0)
    {
        $_SESSION['status'] = "Email Already Taken. Please Try Another one.";
        $_SESSION['status_code'] = "error";
        header('Location: register.php');  
    }
    else
    {
        if($password === $cpassword)
        {
            $query = "INSERT INTO register (username,email,password) VALUES ('$username','$email','$password')";
            $query_run = mysqli_query($conn, $query);
            
            if($query_run)
            {
                // echo "Saved";
                $_SESSION['status'] = "Admin Profile Added";
                $_SESSION['status_code'] = "success";
                header('Location: register.php');
            }
            else 
            {
                $_SESSION['status'] = "Admin Profile Not Added";
                $_SESSION['status_code'] = "error";
                header('Location: register.php');  
            }
        }
        else 
        {
            $_SESSION['status'] = "Password and Confirm Password Does Not Match";
            $_SESSION['status_code'] = "warning";
            header('Location: register.php');  
        }
    }

}

if(isset($_POST['updatebtn']))
{
    $id = $_POST['edit_id'];
    $username = $_POST['edit_username'];
    $email = $_POST['edit_email'];
    $password = $_POST['edit_password'];

    $query = "UPDATE register SET username='$username', email='$email', password='$password' WHERE admin_id='$id' ";
    $query_run = mysqli_query($conn, $query);

    if($query_run)
    {
        $_SESSION['status'] = "Your Data is Updated";
        $_SESSION['status_code'] = "success";
        header('Location: register.php'); 
    }
    else
    {
        $_SESSION['status'] = "Your Data is NOT Updated";
        $_SESSION['status_code'] = "error";
        header('Location: register.php'); 
    }
}


if(isset($_POST['delete_btn']))
{
    $id = $_POST['delete_id'];

    $query = "DELETE FROM register WHERE admin_id='$id' ";
    $query_run = mysqli_query($conn, $query);

    if($query_run)
    {
        $_SESSION['status'] = "Your Data is Deleted";
        $_SESSION['status_code'] = "success";
        header('Location: register.php'); 
    }
    else
    {
        $_SESSION['status'] = "Your Data is NOT DELETED";       
        $_SESSION['status_code'] = "error";
        header('Location: register.php'); 
    }    
}


if(isset($_POST['addproductbtn']))
{
    
    $pro_name = $_POST['pro_name'];
    $cost_price = $_POST['cost_price'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $comments = $_POST['comments'];
    $image = $_POST['image'];
    // $image = basename($_FILES["fileToUpload"]["name"]);
    // var_dump($image);
    // die();
    $sku = $_POST['sku'];


    $pro_name_query = "SELECT * FROM products_detail WHERE pro_name='$pro_name' ";
    $pro_name_query_run = mysqli_query($conn, $pro_name_query);
    if(mysqli_num_rows($pro_name_query_run) > 0)
    {
        $_SESSION['status'] = "Product Already Taken. Please Try Another one.";
        $_SESSION['status_code'] = "error";
        header('Location: product_admin.php');  
    }
    else
    {
        $query = "INSERT INTO products_detail (pro_name,cost_price, price, quantity, comments, image, sku) VALUES ('$pro_name','$cost_price','$price','$quantity','$comments','$image','$sku')";
        $query_run = mysqli_query($conn, $query);
        
        if($query_run)
        {
            // echo "Saved";
            $_SESSION['status'] = "Admin product Added";
            $_SESSION['status_code'] = "success";
            header('Location: product_admin.php');
            // $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            // if($check !== false) {
            //     echo "File is an image - " . $check["mime"] . ".";
            //     $uploadOk = 1;
            // } else {
            //     echo "File is not an image.";
            //     $uploadOk = 0;
            // }
        }
        else 
        {
            $_SESSION['status'] = "Admin product Not Added";
            $_SESSION['status_code'] = "error";
            header('Location: product_admin.php');  
        }
        
    }

}

if(isset($_POST['update_product_btn']))
{
    

    $id = $_POST['edit_product_id'];
    $edit_pro_name = $_POST['edit_pro_name'];
    $edit_cost_price = $_POST['edit_cost_price'];
    $edit_price = $_POST['edit_price'];
    $edit_quantity = $_POST['edit_quantity'];
    $edit_comments = $_POST['edit_comments'];
    $edit_image = $_POST['edit_image'];
    $edit_sku = $_POST['edit_sku'];

    $sql = "SELECT image FROM products_detail where pro_detail_id = $id";
    $query_run_save_image = mysqli_query($conn, $sql);

    if ($edit_image == null){
        if(mysqli_num_rows($query_run_save_image) > 0)        
        {
            while($row = mysqli_fetch_assoc($query_run_save_image))
            {
                $edit_image = $row['image'];
            }
        }
    }else{
        $edit_image = $_POST['edit_image'];
    }
    $query = "UPDATE products_detail SET pro_name='$edit_pro_name', cost_price='$edit_cost_price', price='$edit_price', quantity='$edit_quantity', comments='$edit_comments', image='$edit_image', sku='$edit_sku' WHERE pro_detail_id='$id' ";
    $query_run = mysqli_query($conn, $query);
   
    if($query_run)
    {   
        $_SESSION['status'] = "Your Data is Updated";
        $_SESSION['status_code'] = "success";
        header('Location: product_admin.php'); 
    }
    else
    {
        $_SESSION['status'] = "Your Data is NOT Updated";
        $_SESSION['status_code'] = "error";
        header('Location: product_admin.php'); 
    }
}

if(isset($_POST['delete_product_btn']))
{
    $id = $_POST['delete_id'];

    $query = "DELETE FROM products_detail WHERE pro_detail_id='$id' ";
    $query_run = mysqli_query($conn, $query);

    if($query_run)
    {
        $_SESSION['status'] = "Your Data is Deleted";
        $_SESSION['status_code'] = "success";
        header('Location: product_admin.php'); 
    }
    else
    {
        $_SESSION['status'] = "Your Data is NOT DELETED";       
        $_SESSION['status_code'] = "error";
        header('Location: product_admin.php'); 
    }    
}

?>
<script>
    function update_success() {
        alert("update success!");
    }

    function update_fail() {
        alert("update fail!");
    }

</script>
