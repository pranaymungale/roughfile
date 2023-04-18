<?php 
include "update.php";
$id=$_GET['id'];
$select = "DELETE FROM info WHERE id='$id'";
$data =mysqli_query($conn,$select);

if($data){
?>
  <script>
    alert("Data deleted successfully");
    window.open("http://localhost/register.php","_self");
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