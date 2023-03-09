<?php
$servername = "localhost";
$username = "root";
$password = "";
$db = "silverback";
$conn = mysqli_connect($servername, $username, $password, $db);
if (mysqli_connect_error())
{
    die("Connection failed: ".mysqli_connect_error());
}
