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

  <!-- Main Interface -->   
<div class="row">

  <!-- Left Navigation Vertical-->
  <?php include 'subpages/left-navi.php';?>


  <!-- Center -->
<div class="col-6 col-md-6" style="margin-top:5%;">
  <?php if(isset($_SESSION['login_user']) && !empty($_SESSION['login_user'])) { ?>
         <a href="ask_question.php" class="btn btn-primary btn-md pull-right" style="margin-top:-2%;" >Ask Question</a>
  <?php } ?>
<nav>
  <div class="nav nav-tabs" id="nav-tab" role="tablist">
    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Recent</a>
    <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Popular</a>
    <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Hot</a>
  </div>
</nav>
 
<div class="tab-content" id="nav-tabContent">

<div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
<div class="jumbotron" style="margin-top:4%; background-color:#fffbec; box-shadow: inset 0 1px 0 rgba(255,255,255,0.25);">
<?php 
       include("php/config.php");
        $sql = "SELECT * FROM question ORDER BY created DESC LIMIT 5";
        $result = mysqli_query($con,$sql);
        if(mysqli_num_rows($result) > 0 ){
        $tag = "";
        while ($row = mysqli_fetch_assoc($result)) { 
          $qus_id = $row["qus_id"];
          $get_ans = $row['get_ans'];
         ?>
        <!-- row -->
        <div class="row" id="qus_display">
          <!-- Timeline - answers / votes -->
          <div class="col-2" style="color:#808080; font-size:14px;">

 <?php 
                  $sqll = "SELECT SUM(likes) as 'sum' FROM likes WHERE qus_id = '$qus_id'";
                  $resultt = mysqli_query($con,$sqll);
                  if(mysqli_num_rows($resultt) > 0 ){ 
                    $rows = mysqli_fetch_assoc($resultt);
                     $likes = $rows['sum']; ?>        

            <div class="votes" style="display: inline">
                    <div class="mini-counts"><span title="<?php echo $likes.""; ?> votes">
                     <?php if($likes==null){
                        echo 0;
                     }
                        echo $likes;
                  } 
?>
                    </span></div>
                    <div>votes</div>
            </div> 
                    
            <div class="votes"  style="display: inline">
              <div class="mini-counts"><span title="answers">
<?php 
                  $sqll = "SELECT COUNT(ans_id) as 'sum' FROM answers WHERE qus_id = '$qus_id'";
                  $resultt = mysqli_query($con,$sqll);
                  if(mysqli_num_rows($resultt) > 0 ){ 
                    $rows = mysqli_fetch_assoc($resultt);
                     $answers = $rows['sum'];
                     if($answers==null){
                        echo 0;
                  }
                       if($get_ans==1){ ?>
                        <td class="count-cell"><div style="background-color: #5fba7d !important; width:25px; color:white; border-radius:5px; text-align:center;" title="verified answer"><?php echo $answers;?></div></td>
                       <?php } else {
                        echo $answers;
                       }
                  } 
?>
              </span></div>
              <div>answers</div>
           </div>
        </div>
         
         <!-- Timeline - Questions -->
          <div class="col-8">
            <a href="questions.php?id=<?php echo $row["qus_id"];; ?>" style="text-decoration: none; font-family: Roboto:300,400,500,700,900; font-size:18px; font-weight: normal; color: #07C; line-height: 1.3; margin-bottom: 1.2em;"><?php echo $row["title"]; ?></a>
            <br>
            <?php
               for ($x = 0; $x <strlen($row["tags"]) ; $x++) {
                if($x==strlen($row["tags"])-1){ 
                  $tag.= $row["tags"][$x]; ?>
              <a href='php/tags.php?tags=<?php echo $tag; ?>'><span  class="badge badge-secondary" name="<?php echo $tag; ?>"><?php echo $tag; ?></span></a> <?php
                  $tag = ""; 
                  continue;  
              }
             if($row["tags"][$x]==",")  
             { ?>
              <a href='php/tags.php?tags=<?php echo $tag; ?>'><span  class="badge badge-secondary" name="<?php echo $tag; ?>"><?php echo $tag; ?></span></a>
              <?php 
                   $tag = "";   
                   continue;
              }
             $tag.=$row["tags"][$x];
              
           } 
           ?>
           
            <span class="pull-right" style="font-size:12px; color:#808080;">asked by <a href=""><?php echo $row["user"]; ?></a> </span>
          </div>

        </div>
        <!-- end row -->
         <hr>

        <?php } }  ?>
    </div>
  </div>
  <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">...</div>
  <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">...</div>
 </div>

</div>

<!-- Right Navigation Vertical --> 
<?php include 'subpages/right-navi.php';?>

</div>
 
<?php include 'subpages/footer.php' ?>
</body>
</html>

