
<?php
include("config.php");
if(isset($_GET["user"]) && isset($_GET["qusid"])){
      $user = $_GET["user"];
      $qusid = $_GET["qusid"];

      $sql = "DELETE FROM question WHERE qus_id='$qusid' AND user='$user'";
      $result = mysqli_query($con,$sql);
      header("Location: ../index.php?message=Deleted");

}

?>