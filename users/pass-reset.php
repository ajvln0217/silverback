<?php
session_start();
include('../connection/connect.php');
include('../functions/userfunctions.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require './vendor/autoload.php';

if (isset($_POST['submits'])) {
    $email = mysqli_real_escape_string($conn, $_POST['user_email']);
    $token = md5(rand());

    $email_q = "SELECT user_email, fname, lname FROM users WHERE user_email = '$email' LIMIT 1";
    $q_run = mysqli_query($conn, $email_q);

    if (mysqli_num_rows($q_run) > 0) {
        $arr = mysqli_fetch_array($q_run);
        $fname = $arr['fname'];
        $lname = $arr['lname'];
        $email = $arr['user_email'];

        $update_q = "UPDATE users SET token='$token' WHERE user_email = '$email' LIMIT 1";
        $up_q = mysqli_query($conn, $update_q);

        if ($up_q) {
            $_SESSION['message'] = "We E-mailed you a link for the password reset!";
            header("Location: ./forgot-pass.php");
            exit(0);
        } else {
            $_SESSION['message'] = "Something Went Wrong!";
            header("Location: ./forgot-pass.php");
            exit(0);
        }
    } else {
        $_SESSION['message'] = "No Email Found on database!";
        header("Location: ./forgot-pass.php");
        exit(0);
    }
}

if (isset($_POST['update_pass'])) {
    $email = mysqli_real_escape_string($conn, $_POST['user_email']);
    $new_pass = mysqli_real_escape_string($conn, $_POST['new_password']);
    $cpass = mysqli_real_escape_string($conn, $_POST['new_cpassword']);

    $token = mysqli_real_escape_string($conn, $_POST['pass_token']);

    if (!empty($token)) {
        if (!empty($email) && !empty($new_pass) && !empty($cpass)) {

            $check = "SELECT token FROM users WHERE token = '$token' LIMIT 1";
            $chck_rn = mysqli_query($conn, $check);

            if (mysqli_num_rows($chck_rn) > 0) {

                    $update_pass = "UPDATE users SET user_password = $new_pass WHERE token = '$token' LIMIT 1";
                    $run = mysqli_query($conn, $update_pass);

                    if ($run) {

                        //Para di na magamit yung sinend na link sa email pag mag babago ng password.
                        $gen_token = md5(rand());
                        $generate_token = "UPDATE users SET token = '$gen_token' WHERE token = '$token' LIMIT 1";
                        $generate_run = mysqli_query($conn, $generate_token);

                        $_SESSION['message'] = "Password Updated Successfully";
                        header("Location: ./login.php");
                        exit(0);
                    } else {

                        $_SESSION['message'] = "Something Went Wrong";
                        header("Location: ./change-pass.php?token=$token&user_email=$email");
                        exit(0);
                    }
            } else {
                $_SESSION['message'] = "Token Expired or have already used";
                header("Location: ./change-pass.php?token=$token&user_email=$email");
                exit(0);
            }
        } else {
            $_SESSION['message'] = "All Fields are required";
            header("Location: ./change-pass.php?token=$token&user_email=$email");
            exit(0);
        }
    } else {
        $_SESSION['message'] = "No Token Available";
        header("Location: ./change-pass.php");
        exit(0);
    }
}
