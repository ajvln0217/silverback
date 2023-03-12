<?php


function getInfo(){
    global $conn;
    $user_id = $_SESSION['auth_user']['user_id'];
    $q = "SELECT * FROM `users` WHERE user_id ='$user_id'";
    return $q_run = mysqli_query($conn, $q);

}

function getNumber(){
    global $conn;
    $user_id = $_SESSION['auth_user']['user_id'];
    $q = "SELECT * FROM `cart` WHERE user_id ='$user_id' AND cart_id > 0";
    return $q_run = mysqli_query($conn, $q);
}

function getActive($table)
{
    global $conn;
    $dquery = "SELECT * FROM $table ";
    return $dquery_run = mysqli_query($conn, $dquery);
}

function getPopular()
{
    global $conn;
    $dquery = "SELECT * FROM `products` WHERE prod_trending='1'";
    return $dquery_run = mysqli_query($conn, $dquery);
}


function getProdByCat($category_id)
{
    global $conn;
    $query = "SELECT * FROM `products` WHERE cat_id='$category_id'";
    return $query_run = mysqli_query($conn, $query);
}

function getIndexName($table, $cat_index)
{
    global $conn;
    $query = "SELECT * FROM $table WHERE cat_index='$cat_index' LIMIT 1";
    return $query_run = mysqli_query($conn, $query);
}

function getProdIndexName($table, $prod_index)
{
    global $conn;
    $query = "SELECT * FROM $table WHERE prod_index='$prod_index' LIMIT 1";
    return $query_run = mysqli_query($conn, $query);
}


function getCart()
{
    global $conn;
    $user_id = $_SESSION['auth_user']['user_id'];
    $query = "SELECT c.cart_id, c.prod_id, c.cart_qty, p.prod_id, p.prod_name, p.prod_image, p.prod_price
    FROM cart c
    INNER JOIN products p ON c.prod_id = p.prod_id AND c.user_id='$user_id' ORDER BY
    c.prod_id DESC";
    return $query_run = mysqli_query($conn, $query);
}



function getOrderStatus($user_id){
    global $conn;
    $query = "SELECT o.*, u.*,u.fname,u.lname,u.user_id FROM orders o INNER JOIN users AS u ON o.user_id = u.user_id WHERE order_status = '2' AND o.user_id = $user_id";
    return $query_run = mysqli_query($conn, $query);
}

function getNotIn(){
    global $conn;
    $query = "SELECT * FROM orders WHERE order_id NOT IN (SELECT order_id FROM orders);";
    return $query_run = mysqli_query($conn, $query);
}

function getIPAddress(){
    if(!empty($_SERVER['HTTP_CLIENT_IP'])){
      $ip = $_SERVER['HTTP_CLIENT_IP'];
    }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
      $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else{
      $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
  }
  
function redirect($url, $message)
{
    $_SESSION['message'] = $message;
    header('Location: ' . $url);
    exit();

}

function redirectTo($url){
    header('Location: ' . $url);
    exit();
}
