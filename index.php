

<!DOCTYPE html>


<html>
    <body>
    <style>
.error {color: #FF0000;}
</style>
<?php 
$name= $email= $mobile= $date= "";
$namerr= $emailrr= $mobilerr= $daterr= "";



if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty($_POST["fname"])) {
      $namerr = "Name is required";
    } else {
      $name = ($_POST["name"]);
    }
    
    if (empty($_POST["mail"])) {
      $emailrr = "Email is required";
    } else {
      $email = ($_POST["mail"]);
    }
      
    if (empty($_POST["mobile"])) {
      $mobilerr = "number is required";
    } else {
      $mobile = ($_POST["mobile"]);
    }
  
    if (empty($_POST["date"])) {
      $daterr = "date is required";
    } else {
      $date = ($_POST["date"]);
    }
  

  }
  
  ?>
   

    <h1><u>REGISTRATION FORM</u></h1>    
<P><span class="error">* required</span></P>
<div>
<form method="post" action="">
NAME:<input type="text" name="fname"> 
<span class="error">* <?php echo $namerr;?></span>                               
<br><br> 
EMAIL:<input type="text" name="mail">
<span class="error">* <?php echo $emailrr;?></span>
<br><br>
MOBILE NO:<input type="numbers" name="mobile" maxlength="10" size="10">
<span class="error">* <?php echo $mobilerr;?></span>
<br><br>
DATE OF BIRTH:<input type="date" name="date" max="2020-12-10">
<span class="error">* <?php echo $daterr;?></span>
<br><br>
SUBMIT<input type="submit" name="submit">
<button><a href="register.php">VIEW</a>   </button>
</form>
</div>

<?php



if(isset($_POST['submit'])){

$name= $_POST["fname"];
$email= $_POST["mail"];
$mobile= $_POST["mobile"];
$date= $_POST["date"];
}
      $servername="localhost";
      $username="root";
      $password="";
      $database="test";

      $conn = new mysqli($servername, $username, $password, $database);
      
if($conn->connect_error){
    die("connection failed".$conn->connect_error );
}else{
echo  ("connection successful");
echo "<br>";
}
$sql = "INSERT INTO info (`fname`, `mail`, `mobile`, `date`) VALUES ('$name','$email','$mobile','$date')" ;

$result = mysqli_query($conn, $sql);

 if ($result){
    
   echo "Registration successful";
   echo "<br><br>";
    }
else{
    echo "Registration Error";
}

?>



















</body>
</html>