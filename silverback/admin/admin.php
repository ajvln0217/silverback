<?php
include('./functions/functions.php');
if(isset($_SESSION['auth'])){
    if($_SESSION['role'] != 1){

    redirect('../index.php',"You Don't have any Authorization to Access this Module!");
    }

}else{
    redirect('../users/login.php',"Log-in to continue");
}
