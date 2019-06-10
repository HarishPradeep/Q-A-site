<?php
include("config.php");

if (isset($_POST['update_btn'])) { 
    $dis_name = $_POST['dis_name'];
    $location = $_POST['location'];
    $aboutme = $_POST['aboutme'];
    $facebook = $_POST['FacebookUrl'];
    $twitter = $_POST['TwitterUrl'];
    $login_id = $_POST['login_id'];
    $image = $_FILES['profile_img']['name'];
    // image file directory
    $target = "img/".basename($image);
    
    $sql = "UPDATE users SET username='$dis_name', country='$location', about_me='$aboutme', facebook='$facebook', twitter='$twitter',profile_img='$image' WHERE username='$login_id'";
    $result = mysqli_query($con,$sql);
    if (move_uploaded_file($_FILES['profile_img']['tmp_name'], $target)) {
       header("Location: ../users.php?message=Profile Updated");
    } else {
        die("Failed");
    }
  
}



?>