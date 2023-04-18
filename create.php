<?php




header('Access-Control-Allow-Origin:*');
header('Content-Type:application/json');
header('Access-Control-Allow-Methods:GET');
header('Access-Control-Allow-Headers:Content-Type,Access-Control-Allow-Headers,Authorization,X-Request-With');

//$data=file_get_contents("php://input");

//echo '"hello there"="we the peoples"';
include "functionn.php";
$requestmethod = $_SERVER["REQUEST_METHOD"];

if($requestmethod == "GET"){

    if(isset($_GET['id'])){
         $customer = getCustomer($_GET);
         echo $customer;
    }

else{
$custlist = getcustlist();
echo $custlist;
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