 <?php
 
 $servername="localhost";
      $username="root";
      $password="";
      $database="medicines";

      $con = new mysqli($servername, $username, $password, $database);
      
if($con->connect_error){
    die("connection failed".$conn->connect_error );
}
      ?>