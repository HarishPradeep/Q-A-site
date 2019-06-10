<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Bootstrap 4 -->
    <link href="plugins/css/bootstrap.min.css" rel="stylesheet" media="all">
    <script src="plugins/js/bootstrap.min.js" ></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>

    <!-- Jquery --> 
    <script src="plugins/jquery-3.4.1.min.js"></script>
    
    <!--Pulling Awesome Font --> 
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

    <!-- Link Pages -->
    <link rel="stylesheet" href="subpages/style.css">
    <script src="subpages/javascript.js"></script>

    <title>Over Talk - Welcome </title>
</head>
<body>
<?php
   session_start();
?> 

<!-- Main Navigation -->
<?php include 'subpages/nav.php';?>

<!-- Main Interface -->   
<div class="row">

<!-- Left Navigation Vertical-->
<div class="col-12 col-md-3" style="margin-top:5%;">
  <div class="vl" style="border-right: 1px solid; height:100%; color:#808080;">
        <ul class="nav flex-column nav-pills nav-justified" style="margin:5%;">
           <li class="nav-item">
               <a class="nav-link" href="index.php">Home</a>
           </li>
           <li class="nav-item">
           <a class="nav-link active disabled" href="#">Over Talk</a>
             <li class="nav-item">
             <a class="nav-link" href="#">Tags</a>
             </li>
             <li class="nav-item">
             <a class="nav-link" href="">Users</a>
             </li>
           </li>
        </ul>

  </div>
</div>

<!-- Center -->
<div class="col-6 col-md-6" style="margin-top:2%;"> 

<?php 
     include("php/config.php");
     $qus_id = $_GET['id'];
     $tag = "";
     $sql = "SELECT * FROM question WHERE qus_id='$qus_id'";
     $result = mysqli_query($con,$sql);
     if(mysqli_num_rows($result) > 0 ){
      while ($row = mysqli_fetch_assoc($result)) {
        $get_ans = $row['get_ans'];
        ?>
         <h2 style="font-family: Roboto:300,400,500,700,900; font-size: 30px; font-weight: normal; margin: 3%;"><?php echo $row["title"];?></h2>
         <hr> <br><br>
         <!-- Row-->
         <div class="row">
          <!-- Voting - Question -->
            <div class="col-1">

<!-- ################################################## Vote Bar ################################################ -->
<div class = "box">
<?php 

        if(isset($_SESSION['login_user'])){
                $user_name = $_SESSION['login_user'];
                $query_mail = "SELECT email FROM users WHERE username = '$user_name'";
                $result_for_mail = mysqli_query($con,$query_mail);
                if(mysqli_num_rows($result_for_mail) > 0 ){
                    $row_for_mail = mysqli_fetch_assoc($result_for_mail);
                    $mail = $row_for_mail["email"];
                }
               $query_for_check = "SELECT like_by,likes FROM likes WHERE like_by = '$mail' AND qus_id = '$qus_id'"; 
               $result_for_id = mysqli_query($con,$query_for_check);
               if(mysqli_num_rows($result_for_id) > 0 ){  
                  $row_for_count = mysqli_fetch_assoc($result_for_id);
                  $count_likes =  $row_for_count["likes"]; 
                   $liker = $row_for_count["like_by"];

                  if($liker!=null && $count_likes==1){ ?>

<div class = "up"  title="This Question is Useful" style="pointer-events:none; color:#e75a48;">&#9650;</div>
<div class="count_vote">   
 <?php 
                  $sqll = "SELECT SUM(likes) as 'sum' FROM likes WHERE qus_id = '$qus_id'";
                  $resultt = mysqli_query($con,$sqll);
                  if(mysqli_num_rows($resultt) > 0 ){ 
                    $rows = mysqli_fetch_assoc($resultt);
                     $likes = $rows['sum'];
                     if($likes==null){
                        echo 0;
                     }
                        echo $likes;
                  } 
 ?>
</div>
<div class = "down"  title="This Question is does not show any research effort" style="pointer-events:none;">&#9660;</div>
                 <?php } else if($liker!=null && $count_likes==-1){ ?>

<div class = "up"  title="This Question is Useful" style="pointer-events:none;">&#9650;</div>
<div class="count_vote">   
 <?php 
                  $sqll = "SELECT SUM(likes) as 'sum' FROM likes WHERE qus_id = '$qus_id'";
                  $resultt = mysqli_query($con,$sqll);
                  if(mysqli_num_rows($resultt) > 0 ){ 
                    $rows = mysqli_fetch_assoc($resultt);
                     $likes = $rows['sum'];
                     if($likes==null){
                        echo 0;
                     }
                        echo $likes;
                  } 
 ?>
</div>
<div class = "down"  title="This Question is does not show any research effort" style="pointer-events:none; color:#e75a48;">&#9660;</div>
                 <?php } 
                } 
              
                             
                else { ?>

  <!-- User not liked yet -->            
<div class = "up"  title="This Question is Useful" >&#9650;</div>
<div class="count_vote">   
 <?php 
                  $sqll = "SELECT SUM(likes) as 'sum' FROM likes WHERE qus_id = '$qus_id'";
                  $resultt = mysqli_query($con,$sqll);
                  if(mysqli_num_rows($resultt) > 0 ){ 
                    $rows = mysqli_fetch_assoc($resultt);
                     $likes = $rows['sum'];
                     if($likes==null){
                        echo 0;
                     }
                        echo $likes;
                  } 
 ?>
</div>
<div class = "down"  title="This Question is does not show any research effort">&#9660;</div>
    <?php } } 
                         /* End isset($_SESSION['login_user']) */ ?>
</div>  <!-- ############################### Voting Bar End ####################################### -->


<style>
 .box {
    background: white;
    padding: 3%;
    border-radius: 5px;
    font-size: 2em;
    text-align: center;
    line-height:1.5em;
  }

  .count_vote{
    color:#A9A9A9;
  }
  
  .up {
    color:#A9A9A9;
  }
  
  .up:hover {
    font-size:1.1em;
    text-shadow: 0px 2px 2px #C0C0C0;
    cursor:pointer; 
  }
  
  /*  color:#e75a48; */
  .down {
    color:#A9A9A9; 
  }
  
  .down:hover {
    font-size:1.1em;
    text-shadow: 0px 2px 2px #C0C0C0;
    cursor:pointer; 
  }
</style>
            </div> <!-- End Voting -->

            <!-- Question -->
            <div class="col-11" >
               <?php echo $row["content"]; ?>
            </div>
         </div> <!-- End row -->
        
         <br><br>


  <!-- ########################### TAGS ########################################## --> 
<?php 
           for ($x = 0; $x <strlen($row["tags"]) ; $x++) {
            if($x==strlen($row["tags"])-1){ 
              $tag.= $row["tags"][$x]; ?>
              <a href=""><span  class="badge badge-secondary"><?php echo $tag; ?></span> </a><?php 
              $tag = ""; 
              continue;  
          }
         if($row["tags"][$x]==",")  
         { ?>
           <a href=""> <span  class="badge badge-secondary"><?php echo $tag; ?></span> </a><?php 
               $tag = "";   
               continue;
          }
         $tag.=$row["tags"][$x];
          
       }  
?> <br>
<!-- ########################### END TAGS ########################################## --> 

<div class="user-info pull-right">
    <div class="user-action-time" style="color:#808080; font-size:14px;">
        asked <span title="2015-06-03 20:13:03Z" class="relativetime"><?php echo $row["created"]; ?></span>
    </div>
    <div class="user-gravatar32">
        <a href="/users/4731706/rud0lph"><div class="gravatar-wrapper-32">
        <?php 
                 $user = $row["user"];
                 include("php/config.php");
                 $query = "SELECT * FROM users WHERE username = '$user'";
                 $result = mysqli_query($con,$query);
                 if(mysqli_num_rows($result) > 0 ){ 
                 $rows = mysqli_fetch_assoc($result);
                 $img = $rows["profile_img"]; 
                 if($img==null){ ?>
                 <div class="img-container">
                     <img src="img/miniUser.png">
                </div>
        <?php } else{ ?>
                <div class="img-container">
                     <img src="php/img/<?php echo $rows["profile_img"]; ?>">
                </div>
         <?php } } ?>
        </div></a>
    </div>
    <div class="user-details">
        <a href=" " class="asked_by" id="<?php echo $row["user"]; ?>"><?php 
        /* User Not Login */
         if(!isset($_SESSION['login_user'])) { 
               echo $row["user"];
          }
           /* User Login - Edit / Delete */ 
        else if($row["user"]==$_SESSION['login_user']){
            $logged_user = $row["user"];
            echo "me"; ?><br><br>
           <?php
            /* Delete Question */
            echo "<a href='php/delete_question.php?user=".urlencode($logged_user)."&qusid=".urlencode($qus_id)."' title='Delete Post'>delete</a>" ?>
        <?php } 
          /* User Login - Others Profile */
        else {
        echo $row["user"]; } ?></a><span class="d-none" itemprop="name"></span>
    </div>
</div> <br><br><br><br><hr>
 
 <!-- ############################ Display Answers ############################ --> 
 <?php 
      include("php/config.php");
      $sql = "SELECT * FROM answers WHERE qus_id='$qus_id'";
      $result = mysqli_query($con,$sql);
      if(mysqli_num_rows($result) > 0 ){
        while ($row = mysqli_fetch_assoc($result)) {
          /* User Not Login*/
          if(!isset($_SESSION['login_user'])){ 
              /* If answer Verified */
             if($row['ans_verified']==1){ ?>
              <p style="Roboto:300,400,500,700,900; font-size: 15px; font-weight: normal"><i  class="fa fa-check-circle" style="color:green; margin-right:2%;" value="<?php echo $row["ans_id"]; ?>" name="<?php echo $qus_id; ?>" title="verified answer"></i><?php echo $row["answer"]; ?> - <a href=""> <?php echo $row["ans_by"];?></a><span style="color:#808080; font-size:14px;"><?php echo "  ".$row["added_date"]; ?></span></p><hr>
              <?php } /* If answer not Verified */
              else if($row['ans_verified']==0){ ?>
              <p style="Roboto:300,400,500,700,900; font-size: 15px; font-weight: normal"><?php echo $row["answer"]; ?> - <a href=""> <?php echo $row["ans_by"];?></a><span style="color:#808080; font-size:14px;"><?php echo "  ".$row["added_date"]; ?></span></p><hr>
              <?php } ?>
              <?php  } 
        
        else { /* User Login */
          if($user ==$_SESSION['login_user']){
                /* If answer Verified */
              if($get_ans==1){
                if($row['ans_verified']==1){ ?>
                  <p style="Roboto:300,400,500,700,900; font-size: 15px; font-weight: normal"><i  class="fa fa-check-circle" style="color:green; margin-right:2%;" value="<?php echo $row["ans_id"]; ?>" name="<?php echo $qus_id; ?>" title="verified answer"></i><?php echo $row["answer"]; ?> - <a href=""> <?php echo $row["ans_by"];?></a><span style="color:#808080; font-size:14px;"><?php echo "  ".$row["added_date"]; ?></span></p><hr>
                  <?php }  else if($row['ans_verified']==0) { ?>
                  <p style="Roboto:300,400,500,700,900; font-size: 15px; font-weight: normal"><?php echo $row["answer"]; ?> - <a href=""> <?php echo $row["ans_by"];?></a><span style="color:#808080; font-size:14px;"><?php echo "  ".$row["added_date"]; ?></span></p><hr>
                  <?php }
              } else{ ?>
                <p style="Roboto:300,400,500,700,900; font-size: 15px; font-weight: normal"><i  class="fa fa-check-circle verified" style="color:grey; margin-right:2%;" value="<?php echo $row["ans_id"]; ?>" name="<?php echo $qus_id; ?>"></i><?php echo $row["answer"]; ?> - <a href=""> <?php echo $row["ans_by"];?></a><span style="color:#808080; font-size:14px;"><?php echo "  ".$row["added_date"]; ?></span></p><hr>
             <?php }
          } 
         else if($user!=$_SESSION['login_user']){ /* Other User */
               /* If answer Verified */
              if($row['ans_verified']==1){ ?>
              <p style="Roboto:300,400,500,700,900; font-size: 15px; font-weight: normal"><i  class="fa fa-check-circle" style="color:green; margin-right:2%;" value="<?php echo $row["ans_id"]; ?>" name="<?php echo $qus_id; ?>" title="verified answer"></i><?php echo $row["answer"]; ?> - <a href=""> <?php echo $row["ans_by"];?></a><span style="color:#808080; font-size:14px;"><?php echo "  ".$row["added_date"]; ?></span></p><hr>
              <?php } else if($row['ans_verified']==0){ ?>
              <p style="Roboto:300,400,500,700,900; font-size: 15px; font-weight: normal"><?php echo $row["answer"]; ?> - <a href=""> <?php echo $row["ans_by"];?></a><span style="color:#808080; font-size:14px;"><?php echo "  ".$row["added_date"]; ?></span></p><hr>
         <?php } } } ?>
             
       <?php } } ?>
 <!-- ############################ End Display Answers ############################ --> 

<!-- ############################# Comment Box ######################### -->
<?php 
  include("php/config.php");
  if(!isset($_SESSION['login_user'])){ ?>
  <hr>
   <p style="font-family: Roboto:300,400,500,700,900; font-size: 20px; font-weight: normal; margin: 3%;">You must <a href="login.php">log in</a> to answer this question.</p>
   <?php } else {?>
   <div class="row">
   <div class="col-9">
      <form action="php/answer_by.php" method="post" >
         <input type="text" id="qus_id" value="<?php echo $qus_id; ?>" hidden>
         <input type="text" id="ans_by" value="<?php echo $_SESSION['login_user']; ?>" hidden>
         <textarea id="ans" cols="40" rows="3" style="width:100%;" placeholder="Use reply method for give more clarifications by your answers" maxlength="150"></textarea>
    </div>
    <div class="col-3"><input type="button" id="add_answer" class="btn btn-primary btn-md" value="Post Answer"></div></form>
    <?php } ?>
    </div>
    <?php } } ?>
</div>
<!-- ############################# Comment Box - End ######################### -->


<!-- Send Answers to DB --> 
<script>
$(document).ready(function(){
    $('#add_answer').click(function(){
        const qus_id = $('#qus_id').val();
        const ans_by = $('#ans_by').val();
        const ans = $('#ans').val();

        $.ajax({
            method:'POST',
            url:'php/answer_by.php',
            cache:false,
            data:{
              qus_id: qus_id,
              ans_by:ans_by,
              ans:ans
            }, 
            success:function(){
               alert("Answer is added ");
            }, error:function(){
                alert("Something went wrong ");
            }
        });
    });
});
</script>

<!-- ############ Right Navigation Vertical ######################## --> 
<div class="col-12 col-md-3" style="margin-top:5%;">
<?php if(!isset($_SESSION['login_user'])){ 

} else {?>
      <ul class="nav flex-column">
        <li class="nav-item">
         <a class="nav-link active" href="#">Active</a>
        </li>
        <li class="nav-item">
         <a class="nav-link" href="#">Link</a>
        </li>
        <li class="nav-item">
           <a class="nav-link disabled" href="#">Disabled</a>
        </li>
     </ul>
<?php } ?>
</div>
<!-- ############ End Right Navigation Vertical ######################## --> 

</div>
 
<?php include 'subpages/footer.php' ?>

</body>
</html>


<!-- Voting for Likes -->
<script>
$(document).ready(function(){
  
  const log_user =  $("#navbarDropdown").html();
  const asked_user = $(".asked_by").attr("id");
  
  if(log_user == asked_user){
        $(".up").hide();
        $(".down").hide();
  }
  const qus_id = $('#qus_id').val();
$(".up").click(function(){
  $(".down").css("pointer-events","none");
    $.ajax({
            method:'POST',
            url:'php/add_like.php',
            cache:false,
            data:{
              qus_id: qus_id,
              like_by:log_user,
              like:1
            }, 
            success:function(data){
               alert(data);
               $(".up").css("color","#e75a48");
               const val = $(".count_vote").html();
               const new_val  = parseInt(val) + 1;
               $(".count_vote").html(new_val);
               $(".up").css("pointer-events","none");
            }, error:function(){
                  alert("Error : " + data );
          }
  });
});
$(".down").click(function(){
  $(".up").css("pointer-events","none");
    $.ajax({
            method:'POST',
            url:'php/add_like.php',
            cache:false,
            data:{
              qus_id: qus_id,
              like_by:log_user,
              like:-1
            }, 
            success:function(data){
               alert(data);
               $(".down").css("color","#e75a48");
               const val = $(".count_vote").html();
               const new_val  = parseInt(val) - 1;
               $(".count_vote").html(new_val);
               $(".down").css("pointer-events","none");
            }, error:function(){
                  alert("Error : " + data );
          }
  });
});

});
</script>

<!-- Answer Verified -->
<script>
$(document).ready(function(){
   $('.verified').click(function(){
    var ans_id = $(this).attr("value");
    var qus_id = $(this).attr("name");
    $.ajax({
            method:'POST',
            url:'php/ans_verified.php',
            cache:false,
            data:{
              qus_id: qus_id,
              ans_id: ans_id
            }, 
            success:function(){
                alert("Answer is verified");
                $(this).css("color","green");
            }, error:function(){
              alert("Failed");
            }
   });
});
});
</script>


<!-- Style -->
<style>
.img-container{
  width:40px;
  min-height: 10px;
  max-height: auto;
  float: left;
  margin: 3px;
  padding: 3px;
 
 }

 .img-container img{
  max-width: 100%;
  height:auto;
}
