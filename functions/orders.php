<?php

session_start();
include('../connection/connect.php');
require './userfunctions.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/vendor/autoload.php';

function sendNotification()
{
  $mail = new PHPMailer(true);

  $mail->isSMTP();
  //$mail->SMTPDebug = 2;

  $mail->SMTPAuth   = true;
  $mail->SMTPSecure = 'tls';
  $mail->Host       = 'smtp.gmail.com';
  $mail->Port       = 587;

  $mail->Username   = "mathewsandiego5@gmail.com";
  $mail->Password   = "wihuvqjyptsdnnjz";
  $mail->Mailer     = 'smtp';

  $mail->setFrom('mathewsandiego5@gmail.com', 'SilverbackPH');
  $mail->addAddress('mathewsandiego5@gmail.com');

  $mail->isHTML(true);
  $mail->Subject = 'Silverback | New Order';

  $email_body = "
  <h2>Greetings,</h2>
  <p>There was a new order from your platform. Please check your inventory by clicking the link above.<br><br>
  <a href='http://localhost/silverback/admin/transaction.php'>Click Here</a>
  ";

  $mail->Body = $email_body;
  $mail->send();
}

if(isset($_SESSION['auth'])){
    if(isset($_POST['placeOrder'])){
        

        // SA MAY CHECK OUT

        $payment_mode = mysqli_real_escape_string($conn, $_POST['payment_mode']);

        $user_id = $_SESSION['auth_user']['user_id'];
        $query = "SELECT c.cart_id, c.prod_id, c.cart_qty, p.prod_id, p.prod_name, p.prod_image, p.prod_price
        FROM cart c
        INNER JOIN products p ON c.prod_id = p.prod_id AND c.user_id='$user_id' ORDER BY
        c.prod_id DESC";
        $query_run = mysqli_query($conn, $query);

        $total = 0;
        foreach ($query_run as $cart => $res) {
            $total += $res['prod_price'] * $res['cart_qty'];
            if(mysqli_num_rows($query_run) > 0){
                $delete_q = "DELETE FROM `cart` WHERE cart_id > 0 AND user_id = $user_id ";
                $delete_run = mysqli_query($conn, $delete_q);
            }
        }


        //SA MAY MY ORDER

        $tracking_no = "SLVRBCK-1000" .mt_rand();

        $o_q = "INSERT INTO `orders` (tracking_no, user_id,total_price, payment_mode) VALUES ('$tracking_no','$user_id','$total','$payment_mode')";
        $o_run = mysqli_query($conn, $o_q);

        if($o_run){
            $order_id = mysqli_insert_id($conn);
            //sendNotification(); //Send sa Admin na may bagong Order
            foreach ($query_run as $cart => $res) {

                $prod_id = $res['prod_id'];
                $cart_qty = $res['cart_qty']; // Fetch DATA from CART DB to Order_Item DB
                $prod_price = $res['prod_price']; // Fetch DATA from PRODUCTS DB to Order_Item DB
                $ins_q = "INSERT INTO `order_item` (order_id, prod_id, oitem_qty, oitem_price)VALUES('$order_id','$prod_id','$cart_qty','$prod_price')";
                $insq_rn = mysqli_query($conn, $ins_q);

                // Select Product DB
                $prod_q = "SELECT * FROM `products` WHERE prod_id = '$prod_id' LIMIT 1";
                $prod_run = mysqli_query($conn, $prod_q);
                $prod_dt = mysqli_fetch_array($prod_run);
                $curr_qty = $prod_dt['prod_qty'];

                //Mag babawas yung quantity ng specific product sa db
                $new_qty = $curr_qty-$cart_qty;
                $updt_qty = "UPDATE `products` SET prod_qty = '$new_qty' WHERE prod_id = '$prod_id'";
                $updtq_rn = mysqli_query($conn, $updt_qty);
            }
            $_SESSION['message'] = "Order Place Successfully";
            header('Location: ../orders/myorder.php');
            die();

        }


    }

}else{
    header('Location: ../index.php');
}
