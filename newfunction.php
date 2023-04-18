<?php
error_reporting(0);
require "connection.php";
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

    $image_id = mysqli_real_escape_string($con,$customerInput['image_id']);
    $path = mysqli_real_escape_string($con,$customerInput['path']);
    $prod_id = mysqli_real_escape_string($con,$customerInput['prod_id']);
    

    if(empty(trim($image_id))) {
        return error422('Enter image id');
    }elseif(empty(trim($path))) {
        return error422('Enter the path of image');
    }
    elseif(empty(trim($prod_id))) {
        return error422('Enter product id');
    }
    
    else{
        $sql = "INSERT INTO images (`image_id`, `path`, `prod_id`) VALUES ('$image_id','$path','$prod_id')" ;
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



function getcustomlist(){

global $con;
$query= "SELECT * FROM images";
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


function getCustomer($imageParams){

    global $con;
    if($imageParams['image_id'] == null){
        return error422('Enter image id');
    }
    $image_ID = mysqli_real_escape_string($con, $imageParams['image_id']);
    $query = "SELECT * FROM images WHERE image_id = '$image_ID' LIMIT 1";
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
