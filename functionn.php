<?php
error_reporting(0);
include "connection.php";
function error422($message){

    $data = [
        'status'=> 422,
        'message'=> $message.'unkonown entity',
        
            ];
            header("HTTP/1.0 422 unkonown entity");
            echo json_encode($message);
            exit();



}

function storeCustomer($customerInput){

    global $con;

    $name = mysqli_real_escape_string($con,$customerInput['name']);
    $email = mysqli_real_escape_string($con,$customerInput['email']);
    $password = mysqli_real_escape_string($con,$customerInput['password']);
    $contact = mysqli_real_escape_string($con,$customerInput['contact']);
    $city = mysqli_real_escape_string($con,$customerInput['city']);
    $address = mysqli_real_escape_string($con,$customerInput['address']);

    if(empty(trim($name))) {
        return error422('Enter Your name');
    }elseif(empty(trim($email))) {
        return error422('Enter Your email');
    }
    elseif(empty(trim($password))) {
        return error422('Enter Your password');
    }
    
    else{
        $sql = "INSERT INTO users (`name`, `email`, `password`, `contact`, `city`, `address`) VALUES ('$name','$email','$password','$contact','$city','$address')" ;
        $result = mysqli_query($con,$sql);
        if($result){
            $data = [
                'status'=>201,
                'message'=>"data inserted successfully",
                
                    ];
                    header("HTTP/1.0 201 data inserted successfully");
                    return json_encode($data);  
        }else{
            $data = [
                'status'=>500,
                'message'=>"internal server error"
                
                    ];
                    header("HTTP/1.0 500 internal server error");
                    return json_encode($data);
    
        }

    }
}


function getcustlist(){

global $con;
$query= "SELECT * FROM users";
$result=mysqli_query($con,$query);
 
if($result){
    if(mysqli_num_rows($result)>0){
           $res=mysqli_fetch_all($result, MYSQLI_ASSOC);
           $data = [
            'status'=>200,
            'message'=>"list fetched successfully",
            'data' => $res,
                ];
                header("HTTP/1.0 200 ok");
                return json_encode($data);
                

    }else{
        $data = [
            'status'=>404,
            'message'=>"no customer found",
            
                ];
                header("HTTP/1.0 404 no customer found");
                return json_encode($data);

    }
}else{

    $data = [
        'status'=>405,
        'message'=>"internal server error",
        
            ];
            header("HTTP/1.0 405 internal server error");
            return json_encode($data);
}

}

function getCustomer($customerParams){

global $con;
if($customerParams['id'] == null){
    return error422('Enter your id');
}
$customerID = mysqli_real_escape_string($con, $customerParams['id']);
$query = "SELECT * FROM users WHERE id ='$customerID' LIMIT 1";
$result = mysqli_query($con, $query);

if($result){
 if(mysqli_num_rows($result) == 1){
    $res = mysqli_fetch_assoc($result);
    $data = [
        'status'=>200,
        'message'=>"customer fetched successfully",
        'data' => $res,
            ];
            header("HTTP/1.0 200 ok");
            return json_encode($data);
 }

}else{
    $data = [
        'status'=>405,
        'message'=>"no customer found"
        
            ];
            header("HTTP/1.0 405 no customer found");
            return json_encode($data);
}


}




?>