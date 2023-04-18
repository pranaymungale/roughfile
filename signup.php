
<!DOCTYPE html>
<html>
    
    <body>
        <?php 
        //signup
        //user_registration
        //valid
        //upto
        //dell
        //successfully created
    $servername="localhost";
      $username="root";
      $password="";
      $database="test";

      $con = new mysqli($servername, $username, $password, $database);
      
if($con->connect_error){
    die("connection failed".$conn->connect_error );
}else{
echo  ("connection successful");
echo "<br>";
}
      ?>
            <div class="container">
                <div class="row">
                    <div class="col-xs-4 col-xs-offset-4">
                        <h1><b>SIGN UP</b></h1>
                        <form method="post" action="user_registration.php">
                            <div class="form-group">
                                <input type="text" class="form-control" name="name" placeholder="Name" required="true">
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" name="email" placeholder="Email" required="true" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$">
                            </div> 
                            <div class="form-group">
                                <input type="password" class="form-control" name="password" placeholder="Password(min. 6 characters)" required="true" pattern=".{6,}">
                            </div>
                            <div class="form-group"> 
                                <input type="tel" class="form-control" name="contact" placeholder="Contact" required="true">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="city" placeholder="City" required="true">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="address" placeholder="Address" required="true">
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary" value="Sign Up">
                                <button><a href="valid.php">VIEW</a></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <br><br><br><br><br><br>
            <?php
            /*$name= $email= $passwword= $contact= $city= $address= "";

if(isset($_POST['btn btn-primary'])){

    $name= $_POST["name"];
    $email= $_POST["email"];
    $password= $_POST["password"];
    $contact= $_POST["contact"];
    $city= $_POST["city"];
    $address= $_POST["address"];

}








  
$sql = "INSERT INTO next (`name`, `email`, `password`, `contact`, `city`, `address`) VALUES ('$name','$email','$passwword','$contact','$city','$address')" ;

$result = mysqli_query($conn, $sql);

 if ($result){
    
   echo "Registration successful";
   echo "<br><br>";
    }
else{
    echo "Registration Error";
}
*/
?>
    </body>
</html>
