<?php
    session_start();
?> 
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

 <!-- Main Navigation -->
 <?php include 'subpages/nav.php';?>
 
 <div class="row">
   <div class="col-12 col-md-4"></div>

    <div class="col-12 col-md-4">
<?php
    if(!empty($_GET['message'])) {
     $message = $_GET['message']; ?>
     <h6 style="text-align: center; margin-top:3%;"><div class="alert alert-danger"><?php echo $message ?> </div></h6>
<?php } ?>

<div class="jumbotron col-12 col-md-8" style="margin-top: 10%;">
  <div class="container">  
        <div>
          <form class="form" action="php/register.php" method="post" autocomplete="off">
            <h4 style="text-align:center;"><img src="img/logo.png" alt="" style="width:22%; height:22%;"></h4>
            <input type="text" name="userName" class="form-control input-sm chat-input" placeholder="username" />
            </br>
            <input type="password" name="userPassword" class="form-control input-sm chat-input" placeholder="password" />
            </br>
            <input type="email" name="userEmail" class="form-control input-sm chat-input" placeholder="email" />
            </br>
            <span class="group-btn" > 
                <input type="submit" id="sign_btn" value="Signup" class="btn btn-primary btn-md" style="width:100%;">
            </span>
            <span>
                <h6 style="text-align:center; padding-top:2%;">Have an Account? <a href="login.php"> Login </a></h3>
            </span>
          </form>
        </div>
   </div>
</div>

    </div>

    <div class="col-12 col-md-4"></div>
</div>

<script>
 $(document).ready(function(){
   $("#sign_btn").click(function(){
       $(this).attr("value","Signup...");
   });
});
</script>
</body>
</html>