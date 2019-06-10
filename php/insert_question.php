<?php
session_start();
date_default_timezone_set("Asia/Colombo");

include ("config.php");

if (!isset($_POST['qus_title'], $_POST['question'], $_POST['tags'])) { 
    die("Please complete the question form!");
}
if (empty($_POST['qus_title']) || empty($_POST['question']) || empty($_POST['tags'])) {
    die("Please complete the question form!");
}

if(strlen($_POST['question'])<25){
    die(" Error : Question should have atleast 25 characters above");
}

if(isset($_POST['qus_title']) && isset($_POST['question']) && isset($_POST['tags'])) {
    $title = $_POST['qus_title'];
    $question = $_POST['question'];
    $tags = $_POST['tags'];
    $date = date("Y-m-d H:i:s");
    $user = $_SESSION['login_user'];
    $sql = "SELECT email FROM users WHERE username = '$user'";
    $result = mysqli_query($con,$sql);
    if(mysqli_num_rows($result) > 0 ){
        $row = mysqli_fetch_assoc($result);
        $email = $row["email"]; 
    }
    

    $qus_id= uniqid();
    $insert_query = "INSERT INTO question (qus_id,user,email,title,content,tags,created) VALUES ('".$qus_id++."','".$user."','".$email."','".$title."', '". $question."', '".$tags."','".$date."')";
    mysqli_query($con, $insert_query) or die("database error: ". mysqli_error($con));
    header("Location: ../ask_question.php?message=Your Question Has Posted Successfully ");

} 
else {
echo "Please Enter you name and skills!";
}




?>