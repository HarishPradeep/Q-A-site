<?php
include("config.php");

if(isset($_POST['qus_id']) && isset($_POST['like_by']) && isset($_POST['like'])) {
    $qus_id = $_POST['qus_id'];
    $like_by = $_POST['like_by'];
    $like = $_POST['like'];
    
    $sql = "SELECT email FROM users WHERE username = '$like_by'";
    $result = mysqli_query($con,$sql);
    if(mysqli_num_rows($result) > 0 ){
        $row = mysqli_fetch_assoc($result);
        $mail = $row["email"];
    }

    $sql = "SELECT like_by FROM likes WHERE like_by = '$mail' AND qus_id = '$qus_id'";
    $result = mysqli_query($con,$sql);
    if(mysqli_num_rows($result) == 1 ){ 
        echo "You are already Liked";
    } else{
        $insert_query = "INSERT INTO likes (qus_id,like_by,likes) VALUES ('".$qus_id."','".$mail."','".$like."')";
        mysqli_query($con, $insert_query) or die("database error: ". mysqli_error($con));
        echo "Thanks for your vote"; 
    }

}

?>