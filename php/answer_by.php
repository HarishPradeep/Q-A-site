<?php
include("config.php");
if (empty($_POST['ans'])) {
   die ('Please complete the  form');
}

if(isset($_POST['ans']) && isset($_POST['ans_by']) && isset($_POST['qus_id'])) {
    $answer = $_POST['ans'];
    $answer_by = $_POST['ans_by'];
    $qus_id = $_POST['qus_id'];
    $sql = "SELECT email FROM users WHERE username = '$answer_by'";
    $result = mysqli_query($con,$sql);
    if(mysqli_num_rows($result) > 0 ){ 
        $row = mysqli_fetch_assoc($result);
        $email = $row["email"]; 
    }
    $adddate = date("Y-m-d H:i:s");
    $ans_id= uniqid();
    $insert_query = "INSERT INTO answers (ans_id,qus_id,answer,ans_by,email,added_date) VALUES ('".$ans_id."','".$qus_id."','".$answer."','".$answer_by."', '". $email."','".$adddate."')";
    mysqli_query($con, $insert_query) or die("database error: ". mysqli_error($con));
}

?>