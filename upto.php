<?php include "signup.php"; 
$id=$_GET['id'];
$select = "SELECT * FROM users WHERE id='$id'";
$data =mysqli_query($con,$select);
$row=mysqli_fetch_array($data);
?>

<div class="container">
                <div class="row">
                    <div class="col-xs-4 col-xs-offset-4">
                        <h1><b>SIGN UP</b></h1>
                        <form method="post" action="">
                            <div class="form-group">
                                <input type="text"  name="name" placeholder="Name"  value="<?php echo $row['name']; ?>">
                            </div>
                            <div class="form-group">
                                <input type="email"  name="email" placeholder="Email"  pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" value="<?php echo $row['email']; ?>">
                            </div> 
                            <div class="form-group">
                                <input type="password"  name="password" placeholder="Password(min. 6 characters)"  pattern=".{6,}" value="<?php echo $row['password']; ?>">
                            </div>
                            <div class="form-group"> 
                                <input type="tel"  name="contact" placeholder="Contact"  value="<?php echo $row['contact']; ?>">
                            </div>
                            <div class="form-group">
                                <input type="text"  name="city" placeholder="City"  value="<?php echo $row['city']; ?>">
                            </div>
                            <div class="form-group">
                                <input type="text"  name="address" placeholder="Address"  value="<?php echo $row['address']; ?>">
                            </div>
                            <div class="form-group">
                                <input type="submit" name="update_btn" value="update">
                                <button><a href="upto.php">BACK</a></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <br><br><br><br><br><br>

<?php



if(isset($_POST['update_btn'])){
    
$name= $_POST['name'];
$email= $_POST['email'];
$password= $_POST['password'];
$contact= $_POST['contact'];
$city= $_POST['city'];
$address= $_POST['address'];

$update ="UPDATE users SET name='$name', email='$email', password='$password', contact='$contact', city='$city', address='$address' WHERE id='$id' " ;
$result =mysqli_query($con,$update);

 if ($result){
    ?>
    <script>
   alert("Data updated successfully");
   window.open("http://localhost/valid.php","_self");
</script>
   <?php
    }
else{
    echo "unalbe to update data".$con->error;
}
}
?>