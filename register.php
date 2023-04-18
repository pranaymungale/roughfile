<?php

include "index.php";
?>
<table border="1px" cellpadding="10px" cellspacing="0">
<tr>
    <th>ID</th>
<th>Name</th>
<th>MAIL</th>
<th>MOBILE</th>
<th>DATE</th>
<th colspan = "2">ACTIONS</th>
</tr>

<?php 
       //  echo "ID:".$row["id"]." ". "Name:".$row["fname"]. " "."Email:".$row["mail"]." ". "Mobile No:".$row["mobile"]. " " ."DOB:".$row["date"]."<br>";

$sql = "SELECT * FROM `info`";
$abc = mysqli_query($conn, $sql);
$result = mysqli_num_rows($abc);
if ($result){
    while($row = mysqli_fetch_array($abc)){
        ?>
         <tr>
            <td><?php echo $row["id"];?></td>
            <td><?php echo $row["fname"];?></td>
            <td><?php echo $row["mail"];?></td>
            <td><?php echo $row["mobile"];?></td>
            <td><?php echo $row["date"];?></td>
            <td><a href="update.php?id=<?php echo $row['id']; ?>">EDIT</a></td>
            <td><a href="delete.php?id=<?php echo $row['id']; ?>">DELETE</a></td>
         </tr>
    <?php
    }
}else{
    echo "NO DATA FOUND";
}

?>
</table>































 
