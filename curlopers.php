<?php
include "connection.php";
$sql="select * from users";
$result=mysqli_query($con,$sql);
$count=mysqli_num_rows($result);
header('content-Type:application/json');
if($count>0) {
while($row=mysqli_fetch_assoc($result)){
    $arr[]=$row;
}
 echo json_encode(['status'=>true, 'data'=>$arr]);
}else{
    echo json_encode(['status'=>false, 'data'=> 'no data found']);;
}



/*
$url="https://www.google.com/";
$ch=curl_init();
curl_setopt($ch,CURLOPT_URL,$url);
curl_exec($ch);
curl_close($ch);

$url="https://thumbs.dreamstime.com/b/environment-earth-day-hands-trees-growing-seedlings-bokeh-green-background-female-hand-holding-tree-nature-field-gra-130247647.jpg";
$image="image.jpg";
$fimage=fopen($image,'w+');
$ch=curl_init($url);
curl_setopt($ch,CURLOPT_FILE,$fimage);
curl_exec($ch);
curl_close($ch);
*/


?>