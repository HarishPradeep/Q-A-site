<?php
include("config.php");
if(isset($_POST['qus_id']) && isset($_POST['ans_id'])){
    
    $qusid = $_POST['qus_id'];
    $ansid = $_POST['ans_id'];
    
    $sql = "UPDATE answers SET ans_verified=1 WHERE ans_id='$ansid' AND qus_id='$qusid'";
    $result = mysqli_query($con,$sql);

    $sql = "UPDATE question SET get_ans=1 WHERE qus_id='$qusid'";
    $result = mysqli_query($con,$sql);
    
   

}
?>