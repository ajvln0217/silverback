<?php

if(!isset($_SESSION['auth'])){
    redirect("../users/login.php","Log-in and select an item in order to view your cart");
}else{
}
