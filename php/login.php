<?php
include("config.php");
session_start();

if($_SERVER["REQUEST_METHOD"] == "POST") {

    $myusername = mysqli_real_escape_string($con,$_POST['userName']);
    //$mypassword = mysqli_real_escape_string($con,$_POST['userPassword']); 
    $mypassword = md5($_POST['userPassword']);

    $sql = "SELECT id FROM users WHERE username = '$myusername' and password = '$mypassword'";
    $result = mysqli_query($con,$sql);
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
    
    // If result matched $myusername and $mypassword, table row must be 1 row
    $count = mysqli_num_rows($result);
    if($count == 1) {
        $_SESSION['login_user'] = $myusername;
        header("location: ../index.php");
     }else {
        die('Your Login Name or Password is invalid');
     }
}

?>