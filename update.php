<?php include "register.php"; 
 $id=$_GET['id'];
$select = "SELECT * FROM info WHERE id='$id'";
$data =mysqli_query($conn,$select);
$row=mysqli_fetch_array($data);
?>
<div>
<form method="post" action="">
NAME:<input type="text" name="fname" value="<?php echo $row['fname']; ?>">                                  
<br><br> 
EMAIL:<input type="text" name="mail" value="<?php echo $row['mail']; ?>">
<br><br>
MOBILE NO:<input type="numbers" name="mobile" maxlength="10" size="10" value="<?php echo $row['mobile']; ?>">
<br><br>
DATE OF BIRTH:<input type="date" name="date" max="2000-12-10" value="<?php echo $row['date']; ?>">
<br><br>
SUBMIT:<input type="submit" name="update" value="update">
<button><a href="register.php">BACK</a>   </button>
</form>
</div>

<?php



if(isset($_POST['update'])){
    
$name= $_POST["fname"];
$email= $_POST["mail"];
$mobile= $_POST["mobile"];
$date= $_POST["date"];

$update ="UPDATE `info` SET `fname`='$name', `mail`='$email', `mobile`='$mobile', `date`='$date' WHERE `info`.`id`='$id'" ;
$result =mysqli_query($conn,$update);

 if ($result){
    ?>
    <script>
   alert("Data updated successfully");
   window.open("http://localhost/register.php","_self");
</script>
   <?php
    }
else{
    echo "unalbe to update data".$conn->error;
}
}
?>