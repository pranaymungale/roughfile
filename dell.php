<?php 
include "upto.php";
$id=$_GET['id'];
$select = "DELETE FROM users WHERE id='$id'";
$data =mysqli_query($con,$select);

if($data){
?>
  <script>
    alert("Data deleted successfully");
    window.open("http://localhost/valid.php","_self");
    </script>
    <?php
}
else{
    ?>
     <script>
    alert("Unable to delete ");
    </script>
    <?php
}

?>