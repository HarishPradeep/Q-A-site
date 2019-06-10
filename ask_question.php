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

    <!-- Rich Text Editor --> 
    <script src="http://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
    <script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script>
						
    <!-- Tags -->		
    <link href="subpages/tagsinput.css" rel="stylesheet" type="text/css">
    <script src="subpages/tagsinput.js"></script>




    <title>Ask Question</title>
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
        <ul class="nav flex-column nav-pills nav-justified" style="margin:5%;">
           <li class="nav-item">
               <a class="nav-link" href="index.php">Home</a>
           </li>
           <li class="nav-item">
           <a class="nav-link disabled" href="#">Over Talk</a>
             <li class="nav-item">
             <a class="nav-link" href="#">Tags</a>
             </li>
             <li class="nav-item">
             <a class="nav-link" href="">Users</a>
             </li>
           </li>
        </ul>
</div>


<!-- Center -->
<div class="col-12 col-md-6" style="margin-top:5%;">

<!-- Success Message Flash --> 
<?php 
if(!empty($_GET['message'])) {
     $message = $_GET['message']; ?>
     <h6 style="text-align: center; margin-top:3%;"><div class="alert alert-success"><?php echo $message ?> </div></h6>
<?php } ?>
  
  <!-- If user not login --> 
  <?php if(!isset($_SESSION['login_user'])){ 
    header("Location: index.php");
   } else { ?> <!-- If user login --> 
  <form action="php/insert_question.php" method="post" enctype="multipart/form-data" id="question_form">
  <span><h6>Title
  <input type="text" name="qus_title" id="" placeholder="What's your question ? " style="width:80%; margin-left:3%;" minlength="35" maxlength="80" ></h6></span>
  
  <textarea name="question" id="question" cols="30" rows="10" style="width:100%;"></textarea>

  <h6>Tags</h6>
  <input type="text" id="tags" name="tags" data-role="tagsinput"> <br><br><br>

  <input type="submit" id="btn" value="Post Your Question" class="btn btn-primary btn-md">
  </form>
</div> <?php } ?>



<!-- Right Navigation Vertical --> 
<div class="col-12 col-md-3" style="margin-top:5%;">
<?php include 'subpages/right-navi.php';?>
</div>


</div>

<?php include 'subpages/footer.php' ?>
</body>
</html>