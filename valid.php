<?php

include "signup.php";
?>
<table border="1px" cellpadding="10px" cellspacing="0">
<tr>
    <th>ID</th>
<th>Name</th>
<th>EMAIL</th>
<th>PASSWORD</th>
<th>CONTACT</th>
<th>CITY</th>
<th>ADDRESS</th>
<th colspan = "2">ACTIONS</th>
</tr>

<?php 

$sql = "SELECT * FROM `USERS`";
$abc = mysqli_query($con, $sql);
$result = mysqli_num_rows($abc);
if ($result){
    while($row = mysqli_fetch_array($abc)){
        ?>
         <tr>
            <td><?php echo $row["id"];?></td>
            <td><?php echo $row["name"];?></td>
            <td><?php echo $row["email"];?></td>
            <td><?php echo $row["password"];?></td>
            <td><?php echo $row["contact"];?></td>
            <td><?php echo $row["city"];?></td>
            <td><?php echo $row["address"];?></td>
            <td><a href="upto.php?id=<?php echo $row['id']; ?>">EDIT</a></td>
            <td><a href="dell.php?id=<?php echo $row['id']; ?>">DELETE</a></td>
         </tr>
    <?php
    }
}else{
    echo "NO DATA FOUND";
}

?>
</table>
