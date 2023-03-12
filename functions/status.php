<?php
session_start();
include('../connection/connect.php');
include('./userfunctions.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/vendor/autoload.php';

function sendNotification($track_no)
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
  $mail->Subject = 'Silverback | Reset Password';

  $email_body = "
  <h2>Greetings,</h2>
  <p>The ordered item with the tracking number <b>$track_no</b> have already receive the item. Kindly proceed to the provided link in order to complete the transaction<br><br>
  <a href='http://localhost/silverback/admin/received.php?track_no=$track_no'>Click Here</a>
  ";

  $mail->Body = $email_body;
  $mail->send();
}

if (isset($_SESSION['auth'])) {
    if (isset($_POST['item_receive'])) {
        $receive = $_POST['item_receive'];
        $track_no = $_POST['track_no'];

        $q = "SELECT * FROM `orders` WHERE tracking_no = '$track_no'";
        $q_run = mysqli_query($conn, $q);
        $d = mysqli_fetch_array($q_run);
        $st = $d['order_status'];

        if ($q_run) {
            sendNotification($track_no);
            if ($st != '0') {
                $update_q = "UPDATE `orders` SET order_status1 = '$receive'  WHERE tracking_no = '$track_no'";
                $updateq_run = mysqli_query($conn, $update_q);
                redirect("../orders/myorder.php?track_no=$track_no", "Thank you, Come Again!");
            }
        }
    } elseif (isset($_POST['cancel_order'])) {
        $track_no = mysqli_real_escape_string($conn, $_POST['track_no']);
        $user_id = $_SESSION['auth_user']['user_id'];

        $query = "SELECT oi.*, oi.prod_id AS oi_prod, o.*, p.* FROM order_item AS oi INNER JOIN orders AS o ON oi.order_id = o.order_id AND o.user_id='$user_id' AND o.tracking_no = '$track_no' INNER JOIN products AS p ON oi.prod_id = p.prod_id ORDER BY oi.prod_id DESC";
        $query_run = mysqli_query($conn, $query);
        
        if ($query_run) {
            $retr_val = 0;
            foreach($query_run as $retrieve => $data){
            
            //Delete
            $delete_q = "DELETE oi.*, o.*  FROM order_item AS oi INNER JOIN orders AS o WHERE oi.order_id = o.order_id AND tracking_no = '$track_no'";
            $stmt = $conn->prepare($delete_q);
            $stmt->execute();

            //Ibabalik yung quantity value ng specific item
            $retr_val = $data['prod_qty'] += $data['oitem_qty'];
            $p_id = $data['oi_prod'];
            $update = "UPDATE `products` SET prod_qty = '$retr_val' WHERE prod_id = '$p_id'";
            $up_hashire = mysqli_query($conn, $update); 

            }
           

            echo 200;
        } else {
            echo 500;
        }
    }
    //redirect("../orders/myorder.php?track_no=$track_no","Order Cancelled!");
} else {
    header('Location: ../index.php');
}
