<?php
session_start();
include('../connection/connect.php');
{
    if(isset($_SESSION['auth'])){

        if (isset($_POST['scope'])) {

            $scope = $_POST['scope'];
            switch ($scope) {

                case "add";
                    $product_id = $_POST['prod_id'];
                    $cart_qty = $_POST['cart_qty'];

                    $user_id = $_SESSION['auth_user']['user_id'];

                    $cart_validation = "SELECT * FROM `cart` WHERE prod_id = '$product_id' AND user_id = '$user_id'";

                    $cart_run = mysqli_query($conn, $cart_validation);
                    if(mysqli_num_rows($cart_run) > 0){

                        echo "existed";

                    } else {

                        $insert_query = "INSERT INTO `cart` (`user_id`, `prod_id`, `cart_qty`) VALUES ('$user_id','$product_id','$cart_qty')";
                        $insert_query_run = mysqli_query($conn, $insert_query);

                        if ($insert_query_run) {
                            echo 201;
                        } else {
                            echo 500;
                        }
                    }
                    break;

                case "update":
                    $product_id = $_POST['prod_id'];
                    $cart_qty = $_POST['cart_qty'];

                    $user_id = $_SESSION['auth_user']['user_id'];
                    $cart_validation = "SELECT * FROM `cart` WHERE prod_id = '$product_id' AND user_id = '$user_id'";

                    $cart_run = mysqli_query($conn, $cart_validation);
                    if(mysqli_num_rows($cart_run) > 0){

                       $update_q = "UPDATE `cart` SET cart_qty = '$cart_qty' WHERE prod_id = '$product_id' AND user_id = '$user_id'";
                        $update_run = mysqli_query($conn, $update_q);

                        if($update_run){
                            echo 200;
                        }else{
                            echo 500;
                        }

                    } else {
                        echo "Something went wrong";
                    }
                    break;

                case "delete":
                    $c_id = $_POST['c_id'];
                    $user_id = $_SESSION['auth_user']['user_id'];
                    $cart_validation = "SELECT * FROM `cart` WHERE cart_id = '$c_id' AND user_id = '$user_id'";
                    $cart_run = mysqli_query($conn, $cart_validation);
                    
                    if(mysqli_num_rows($cart_run) > 0){

                        $delete_q = "DELETE FROM `cart` WHERE cart_id ='$c_id'";
                         $delete_run = mysqli_query($conn, $delete_q);
 
                         if($delete_run){
                            echo 201;
                         }else{
                            echo 500;
                         }
 
                     } else {
                         echo "Something went wrong";
                     }
                    break;

                default:
                    echo 500;
            }
        }
    }
    else
    {
        echo 401;
    }
}
