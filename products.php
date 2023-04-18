<?php 
require "connection.php";

header('Access-Control-Allow-Origin:*');
header('Content-Type:application/json');
header('Access-Control-Allow-Methods:GET');
header('Access-Control-Allow-Headers:Content-Type,Access-Control-Allow-Headers,Authorization,X-Request-With');

 
include "profunction.php";
$requestmethod = $_SERVER["REQUEST_METHOD"];

if($requestmethod == 'GET'){

    if(isset($_GET['id'])){
         $customer = getCustomer($_GET);
         echo $customer;
    }

else{
$customlist = getcustomlist();
echo $customlist;
} 
 
}else{
    $data = [
'status'=>405,
'message'=> $requestmethod.'method not allowed',

    ];
    header("HTTP/1.0 405 Method Not Allowed");
    echo json_encode($data);
}


?>