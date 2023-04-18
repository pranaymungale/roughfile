<?php


$url="https://www.flipkart.com/";
$ch=curl_init();
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);

$result=curl_exec($ch);
curl_close($ch);
preg_match_all('!https://www.flipkart.com(.*).jpg!',$result,$data);
echo '<pre>';
 print_r($data);
foreach($data[0] as $list){
    echo "<img src='$list'/>";
}

/*
 $result=json_decode($result);
 echo '<pre>';
 print_r($result);


*/


?>