<?php
session_start();
include('../connection/connect.php');
include('../functions/userfunctions.php');


if (isset($_POST['sign_up'])) {

    //para sa users_account
    $name = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['user_password']);
    $cpassword = mysqli_real_escape_string($conn, $_POST['cpassword']);
    $email = mysqli_real_escape_string($conn, $_POST['user_email']);

    //para sa users_info
    $fname = mysqli_real_escape_string($conn, $_POST['fname']); 
    $lname = mysqli_real_escape_string($conn, $_POST['lname']); 
    $contactnum = mysqli_real_escape_string($conn, $_POST['contactnum']);  
    $birthday = mysqli_real_escape_string($conn, $_POST['birthday']); 
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $city = mysqli_real_escape_string($conn, $_POST['city']);
    $region = mysqli_real_escape_string($conn, $_POST['region']);
    $zip = mysqli_real_escape_string($conn, $_POST['zip']);
    $token = md5(rand());

    $image = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];


    $email_validation = "SELECT user_email FROM `users` WHERE user_email='$email'";
    $e_run = mysqli_query($conn, $email_validation);

    if (mysqli_num_rows($e_run) > 0) {
        $_SESSION['message'] = "That email is already registered!";
        header('Location: ../users/register.php');
    } else {

        if (!empty($name) && !empty($password)) {

            $insert_query = "INSERT INTO `users` (username,user_email,user_password,fname,lname,contactnum,birthday,address,city,region,zip,image,token) VALUES ('$name','$email','$password','$fname','$lname','$contactnum','$birthday','$address','$city','$region','$zip','$image','$token')";
            $stmt = $conn->prepare($insert_query);
            $stmt->execute();

            if ($stmt) {
                $_SESSION['message'] = "Registered Successfully";
                header('Location: ../users/login.php');
            } else {
                $_SESSION['message'] = "Something went wrong";
                header('Location: ../users/register.php');
            }
        } else {
            $_SESSION['message'] = "Please Fill all the information!";
            header('Location: ../users/register.php');
        }
    }
} else if (isset($_POST['log_in'])) {
    $email = mysqli_real_escape_string($conn, $_POST['user_email']);
    $password = mysqli_real_escape_string($conn, $_POST['user_password']);

    $login_q = "SELECT * FROM `users` WHERE user_email='$email' AND user_password='$password'";
    $login_run = mysqli_query($conn, $login_q);

    if (mysqli_num_rows($login_run) > 0) {

        $_SESSION['auth'] = true;
        $userdata = mysqli_fetch_array($login_run);

        $userid = $userdata['user_id'];
        $username = $userdata['username'];
        $useremail = $userdata['user_email'];
        $role = $userdata['role'];

        $_SESSION['auth_user'] = [
            'user_id' => $userid,
            'username' => $username,
            'user_email' => $useremail
        ];

        $_SESSION['role'] = $role;

        if ($role > 0) {
            $update = "UPDATE users SET lastactivity =now() WHERE user_id =".$_SESSION['auth_user']['user_id'];
            $q = mysqli_query($conn,$update);
            redirect("../admin/home.php", "Welcome to your Dashboard");
        } else {
            redirect("../category/category.php", "Logged In Successfully");
        }
    } else {
        redirect("../users/login.php", "Wrong Username/email or Password");
    }
}
