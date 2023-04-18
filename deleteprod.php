<?php 
require "connection.php";

header('Access-Control-Allow-Origin:*');
header('Content-Type:application/json');
header('Access-Control-Allow-Methods:DELETE');
header('Access-Control-Allow-Headers:Content-Type,Access-Control-Allow-Headers,Authorization,X-Request-With');


include "profunction.php";
$requestmethod = $_SERVER["REQUEST_METHOD"];

if($requestmethod == 'DELETE'){

    if(isset($_GET['p_id'])){
         $deleteCustomer = deleteCustomer($_GET);
         echo $deleteCustomer;
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