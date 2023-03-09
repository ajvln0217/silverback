<?php
include('../connection/connect.php');

function getData($table){
    global $conn;
    $dquery = "SELECT * FROM $table";
    return $dquery_run = mysqli_query($conn, $dquery);
}

function getUserRole(){
    global $conn;
    $q = "SELECT * FROM `users`";
    return $q = mysqli_query($conn, $q);
}
function getByID($table, $id)
{
    global $conn;
    $query = "SELECT * FROM $table WHERE cat_id=$id";
    return $query_run = mysqli_query($conn, $query);
}

function getProdByID($table, $id)
{
    global $conn;
    $query = "SELECT * FROM $table WHERE prod_id=$id";
    return $query_run = mysqli_query($conn, $query);
}

function getUserByID($table, $id)
{
    global $conn;
    $query = "SELECT * FROM $table WHERE user_id=$id";
    return $query_run = mysqli_query($conn, $query);
}

function getQtySUM(){

    global $conn;
    $q = "SELECT SUM(prod_qty) AS quantity FROM `products`";
    return $q_run = mysqli_query($conn, $q);
}

function getOutofStocks(){
    global $conn;
    $q = "SELECT COUNT(*) AS count FROM `products` WHERE prod_qty = 0 OR prod_qty < 0";
    return $q_run = mysqli_query($conn, $q);
}

function getRevenueMonth(){
    global $conn;
    $q = "SELECT SUM(total_price) AS revenue FROM`orders` WHERE MONTH(order_date) = MONTH(NOW()) AND YEAR(order_date) = YEAR(NOW()) AND order_status='2' AND order_status1='1'";
    return $q_run = mysqli_query($conn, $q);
}

function getAllOrder(){
    global $conn;
    $query = "SELECT o.*, u.*,u.fname,u.lname,u.user_id FROM orders o INNER JOIN users AS u ON o.user_id = u.user_id WHERE order_status = '0' OR order_status = '1' AND o.user_id = u.user_id";
    return $query_run = mysqli_query($conn, $query);
}

function getPending(){
    global $conn;
    $query = "SELECT o.*, u.*,u.fname,u.lname,u.user_id FROM orders o INNER JOIN users AS u ON o.user_id = u.user_id WHERE order_status = '0' AND order_status1 = '0' AND o.user_id = u.user_id";
    return $query_run = mysqli_query($conn, $query);
}

function itemReceived(){
    global $conn;
    $query = "SELECT o.*, u.*,u.fname,u.lname,u.user_id FROM orders o INNER JOIN users AS u ON o.user_id = u.user_id WHERE order_status = '1' AND order_status1 = '1' AND o.user_id = u.user_id";
    return $query_run = mysqli_query($conn, $query);
}

function getFrequentPurch(){
    global $conn;
    $q = "SELECT oi.*, prod.*, o.*, o.order_id, SUM(oi.oitem_qty) AS quantity FROM order_item AS oi INNER JOIN products AS prod ON oi.prod_id = prod.prod_id INNER JOIN orders AS o ON  oi.order_id = o.order_id GROUP BY o.order_id ORDER BY SUM(oi.oitem_qty) DESC;";
    return $q_run = mysqli_query($conn, $q);
}



function getProfile(){
    global $conn;
    $q = "SELECT * FROM users WHERE role = '1'";
    return $q_run = mysqli_query($conn, $q);
}


function redirect($url,$message)
{
    $_SESSION['message'] = $message;
    header('Location: ' . $url);
    exit();
}

function redirectTo($url,$message)
{
    $_SESSION['message'] = $message;
    header('Location: ' . $url);
    exit();
}
