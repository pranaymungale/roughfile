<?php
error_reporting(0);
require "connection.php";
function error422($message)
{

    $data = [
        'status' => 422,
        'message' => $message . 'unkonown entity',

    ];
    header("HTTP/1.0 422 unkonown entity");
    echo json_encode($message);
    exit();
}




function getcustomlist()
{

    global $con;
    $query = "SELECT * FROM products";
    $result = mysqli_query($con, $query);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $res = mysqli_fetch_all($result, MYSQLI_ASSOC);
            $data = [
                'status' => 200,
                'message' => "list fetched successfully",
                'data' => $res
            ];
            header("HTTP/1.0 200 ok");
            return json_encode($data);
        } else {
            $data = [
                'status' => 404,
                'message' => "no customer found",

            ];
            header("HTTP/1.0 404 no customer found");
            return json_encode($data);
        }
    } else {

        $data = [
            'status' => 405,
            'message' => "internal server error",

        ];
        header("HTTP/1.0 405 internal server error");
        return json_encode($data);
    }
}


function getCustomer($productsParams)
{

    global $con;
    if ($productsParams['id'] == null) {
        return error422('Enter prod id');
    }
    $product_ID = mysqli_real_escape_string($con, $productsParams['id']);
    $query = "SELECT * FROM products WHERE id = '$product_ID'";
    $result = mysqli_query($con, $query);
    if ($result) {

        $res = mysqli_fetch_all($result);
        $data = [
            'status' => 200,
            'message' => "customer fetched successfully",
            'data' => $res
        ];
        header("HTTP/1.0 200 ok");
        return json_encode($data);
    } else {
        $data = [
            'status' => 405,
            'message' => "no customer found"

        ];
        header("HTTP/1.0 405 no customer found");
        return json_encode($data);
    }
}


function updateCustomer($customerInput, $customerParams)
{

    global $con;

    if (!isset($customerParams['p_id'])) {
        return error422('product id not found');
    } elseif ($customerParams['p_id'] == NULL) {
        return error422('Enter product id');
    }

    $product_ID = mysqli_real_escape_string($con, $customerParams['p_id']);
    $id = mysqli_real_escape_string($con, $customerInput['id']);
    $name = mysqli_real_escape_string($con, $customerInput['name']);
    $description = mysqli_real_escape_string($con, $customerInput['description']);
    $composition = mysqli_real_escape_string($con, $customerInput['composition']);
    $category = mysqli_real_escape_string($con, $customerInput['category']);
    $scientific_name = mysqli_real_escape_string($con, $customerInput['scientific_name']);


    if (empty(trim($id))) {
        return error422('Enter id');
    } elseif (empty(trim($name))) {
        return error422('Enter the name');
    } elseif (empty(trim($description))) {
        return error422('Enter the description');
    } elseif (empty(trim($composition))) {
        return error422('Enter the composition');
    } elseif (empty(trim($category))) {
        return error422('Enter the category');
    } elseif (empty(trim($scientific_name))) {
        return error422('Enter the scientific_name');
    } else {
        $sql = "UPDATE products SET id='$id', name='$name', description='$description', composition='$composition', category='$category', scientific_name='$scientific_name' WHERE p_id='$product_ID' LIMIT 1";
        $result = mysqli_query($con, $sql);
        if ($result) {
            $data = [
                'status' => 201,
                'message' => "data updated successfully"

            ];
            header("HTTP/1.0 201 data updated successfully");
            return json_encode($data);
        } else {
            $data = [
                'status' => 500,
                'message' => "internal server error"

            ];
            header("HTTP/1.0 500 internal server error");
            return json_encode($data);
        }
    }
}



function deleteCustomer($customerParams)
{

    global $con;

    if (!isset($customerParams['p_id'])) {
        return error422('product id not found');
    } elseif ($customerParams['p_id'] == NULL) {
        return error422('Enter product id');
    }

    $customer_ID = mysqli_real_escape_string($con, $customerParams['p_id']);

    $query = "DELETE FROM products WHERE p_id = '$customer_ID' LIMIT 1";
    $result = mysqli_query($con, $query);
    if ($result) {
        $data = [
            'status' => 203,
            'message' => "data deleted successfully"

        ];
        header("HTTP/1.0 203 data deleted successfully");
        return json_encode($data);
    } else {
        $data = [
            'status' => 500,
            'message' => "unable to delete data"

        ];
        header("HTTP/1.0 500 unable to delete data");
        return json_encode($data);
    }
}


function storeCategories($CategoriesInput)
{

    global $con;
    $c_id = mysqli_real_escape_string($con, $CategoriesInput['c_id']);
    $name = mysqli_real_escape_string($con, $CategoriesInput['name']);

    $cat_image_base64 = mysqli_real_escape_string($con, $CategoriesInput['image']);



    if (empty(trim($c_id))) {
        return error422('Enter c_id');
    } elseif (empty(trim($name))) {
        return error422('Enter the name');
    } elseif (empty(trim($cat_image_base64))) {
        return error422('select ca image');
    } else {
        $image_parts = explode(";base64,", $cat_image_base64);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);
        $file_name = uniqid() . '.' . $image_type;

        $image_upload_dir = "./images/";
        if (!file_exists($image_upload_dir)) {
            mkdir($image_upload_dir, 0777, true);
        }

        $file = $image_upload_dir . $file_name;
        if (!file_put_contents($file, $image_base64)) {
            $data = [
                'status' => 500,
                'message' => 'Error saving image file',
            ];
            header("HTTP/1.1 500 Internal Server Error");
            header("Access-Control-Allow-Origin: *");
            header("Content-Type: application/json; charset=UTF-8");
            return json_encode($data);
        }


        $sql = "INSERT INTO categories (`c_id`, `name`, `image`) VALUES ('$c_id','$name','$cat_image_base64')";
        $result = mysqli_query($con, $sql);
        if ($result) {
            $data = [
                'status' => 201,
                'message' => "data inserted successfully",

            ];
            header("HTTP/1.0 201 data inserted successfully");
            return json_encode($data);
        } else {
            $data = [
                'status' => 502,
                'message' => "internal server error"

            ];
            header("HTTP/1.0 500 internal server error");
            return json_encode($data);
        }
    }
}




function storeCustomer($CustomerInput)
{

    global $con;
    $id = mysqli_real_escape_string($con, $CustomerInput['id']);
    $name = mysqli_real_escape_string($con, $CustomerInput['name']);
    $description = mysqli_real_escape_string($con, $CustomerInput['description']);
    $composition = mysqli_real_escape_string($con, $CustomerInput['composition']);
    $category = mysqli_real_escape_string($con, $CustomerInput['category']);
    $scientific_name = mysqli_real_escape_string($con, $CustomerInput['scientific_name']);
    $prod_image_base64 = mysqli_real_escape_string($con, $CustomerInput['prod_image']);



    if (empty(trim($id))) {
        return error422('Enter id');
    } elseif (empty(trim($name))) {
        return error422('Enter the name');
    } elseif (empty(trim($description))) {
        return error422('Enter the description');
    } elseif (empty(trim($composition))) {
        return error422('Enter the composition');
    } elseif (empty(trim($category))) {
        return error422('Enter the category');
    } elseif (empty(trim($scientific_name))) {
        return error422('Enter the scientific name');
    } elseif (empty(trim($prod_image_base64))) {
        return error422('select product image');
    } else {
        $image_parts = explode(";base64,", $prod_image_base64);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);
        $file_name = uniqid() . '.' . $image_type;

        $image_upload_dir = "./images/";
        if (!file_exists($image_upload_dir)) {
            mkdir($image_upload_dir, 0777, true);
        }

        $file = $image_upload_dir . $file_name;
        if (!file_put_contents($file, $image_base64)) {
            $data = [
                'status' => 500,
                'message' => 'Error saving image file',
            ];
            header("HTTP/1.1 500 Internal Server Error");
            header("Access-Control-Allow-Origin: *");
            header("Content-Type: application/json; charset=UTF-8");
            return json_encode($data);
        }


        $sql = "INSERT INTO products (`id`, `name`, `prod_image`, `description`, `composition`, `category`, `scientific_name`) VALUES ('$id','$name','$prod_image_base64', '$description','$composition','$category','$scientific_name')";
        $result = mysqli_query($con, $sql);
        if ($result) {
            $data = [
                'status' => 201,
                'message' => "data inserted successfully",

            ];
            header("HTTP/1.0 201 data inserted successfully");
            return json_encode($data);
        } else {
            $data = [
                'status' => 500,
                'message' => "internal server error"

            ];
            header("HTTP/1.0 500 internal server error");
            return json_encode($data);
        }
    }
}



function getCategories($categoriesParams)
{

    global $con;
    if ($categoriesParams['c_id'] == null) {
        return error422('Enter prod id');
    }
    $category_ID = mysqli_real_escape_string($con, $categoriesParams['c_id']);
    $query = "SELECT * FROM categories WHERE c_id = '$category_ID' limit 1";
    $result = mysqli_query($con, $query);
    if ($result) {

        $res = mysqli_fetch_all($result);
        $data = [
            'status' => 200,
            'message' => "customer fetched successfully",
            'data' => $res
        ];
        header("HTTP/1.0 200 ok");
        return json_encode($data);
    } else {
        $data = [
            'status' => 405,
            'message' => "no customer found"

        ];
        header("HTTP/1.0 405 no customer found");
        return json_encode($data);
    }
}



function getCategorieslist()
{

    global $con;
    $query ="SELECT * FROM categories";
    $result = mysqli_query($con, $query);
   

     if ($result) {
        if (mysqli_num_rows($result) > 0) {
             $res = mysqli_fetch_all($result, MYSQLI_ASSOC);
            $data = [
                'status' => 200,
                'message' => "list fetched successfully",
                'data' => $res,
            ];
            header("HTTP/1.0 200 ok");
            return json_encode($data);
        } else {
            $data = [
                'status' => 404,
                'message' => "no customer found"

            ];
            header("HTTP/1.0 404 no customer found");
            return json_encode($data);
        }
    } else {

        $data = [
            'status' => 405,
            'message' => "internal server error",

        ];
        header("HTTP/1.0 405 internal server error");
        return json_encode($data);
    }
}





function storeConsumer($CustomerInput)
{

    global $con;
    $cat_id = mysqli_real_escape_string($con, $CustomerInput['c_id']);
    $cat_name = mysqli_real_escape_string($con, $CustomerInput['name']);
    $prod_image_base64 = mysqli_real_escape_string($con, $CustomerInput['image']);



    if (empty(trim($cat_id))) {
        return error422('Enter cat_id');
    } elseif (empty(trim($cat_name))) {
        return error422('Enter the cat_name');
    } elseif (empty(trim($prod_image_base64))) {
        return error422('select cat_image');
    } else {
        $image_parts = explode(";base64,", $prod_image_base64);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);
        $file_name = uniqid() . '.' . $image_type;

        $image_upload_dir = "./imagess/";
        if (!file_exists($image_upload_dir)) {
            mkdir($image_upload_dir, 0777, true);
        }

        $file = $image_upload_dir . $file_name;
        if (!file_put_contents($file, $image_base64)) {
            $data = [
                'status' => 500,
                'message' => 'Error saving image file',
            ];
            header("HTTP/1.1 500 Internal Server Error");
            header("Access-Control-Allow-Origin: *");
            header("Content-Type: application/json; charset=UTF-8");
            return json_encode($data);
        }


        $sql = "INSERT INTO categories (`c_id`, `name`, `image`) VALUES ('$cat_id','$cat_name','$prod_image_base64')";
        $result = mysqli_query($con, $sql);
        if ($result) {
            $data = [
                'status' => 201,
                'message' => "data inserted successfully",

            ];
            header("HTTP/1.0 201 data inserted successfully");
            return json_encode($data);
        } else {
            $data = [
                'status' => 555,
                'message' => "internal server error"

            ];
            header("HTTP/1.0 500 internal server error");
            return json_encode($data);
        }
    }
}
?>
