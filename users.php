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
     
   
    <title>User - OverTalk</title>
</head>
<body>

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
<div class="col-12 col-md-6" style="margin-top:5%;">

<?php
if(!empty($_GET['message'])) {
     $message = $_GET['message']; ?>
     <h6 style="text-align: center; margin-top:3%;"><div class="alert alert-success"><?php echo $message ?> </div></h6>
<?php } ?>

<nav>
  <div class="nav nav-tabs" id="nav-tab" role="tablist" >
    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true" style="color: black;">Profile</a>
    <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Edit profile and settings</a>
  </div>
</nav>
  <div class="tab-content" id="nav-tabContent">
  <!-- Profile -->
<div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">   
    <div class="jumbotron" style="background-color:#fffbec; ">      
        <div class="row" style="margin-top:1%;">
             <!-- Image -->       
            <div class="col-5">
            <?php 
                 include("php/config.php");
                 $user = $_SESSION['login_user'];
                 $sql = "SELECT * FROM users WHERE username = '$user'";
                 $result = mysqli_query($con,$sql);
                 if(mysqli_num_rows($result) > 0 ){ 
                 $row = mysqli_fetch_assoc($result);
                 $img = $row["profile_img"]; 
                 if($img==null){ ?>
                 <img src="img/mainUser.png" alt="" style="width:70%; height:100%;"> 
                <?php } else{ ?>
                  <div class="img-container">
                    <img src="php/img/<?php echo $row["profile_img"]; ?>">
                  </div>
                 <?php } ?>
            </div>
            <!-- Information --> 
            <div class="col-7">
                <h4><?php echo $_SESSION['login_user']; ?></h4>
                <div class="row">
                <!-- Answers Count -->
<div class="col-2"><div class="grid--cell fs-body3 fc-dark fw-bold" style="font-family:tahoma; font-weight: bold;">
                      <?php include("php/config.php"); 
                       $query = "SELECT COUNT(ans_id) as 'sum' FROM answers WHERE ans_by = '$user'";
                       $resultt = mysqli_query($con,$query);
                       if(mysqli_num_rows($resultt) > 0 ){ 
                              $rows = mysqli_fetch_assoc($resultt);
                              $answers = $rows['sum'];
                       if($answers==null){
                               echo 0;
                        }
                        echo $answers;
                        } ?>
</div><div class="grid--cell">answers</div></div>
               
               <!-- Question Count -->
<div class="col-2"><div class="grid--cell fs-body3 fc-dark fw-bold"  style="font-family:tahoma; font-weight: bold;">
                     <?php include("php/config.php"); 
                       $query = "SELECT COUNT(qus_id) as 'sum' FROM question WHERE user = '$user'";
                       $resultt = mysqli_query($con,$query);
                       if(mysqli_num_rows($resultt) > 0 ){ 
                              $rows = mysqli_fetch_assoc($resultt);
                              $answers = $rows['sum'];
                       if($answers==null){
                               echo 0;
                        }
                        echo $answers;
                        } ?>
</div><div class="grid--cell">question</div></div>
                </div> <br>
                <?php if($row["about_me"]!=null){ ?>
                     <p style="color:#2F4F4F; font-family:Roboto"><i class="fa fa-pencil"></i> <?php echo $row["about_me"];?> </p>
                  <?php } 
                  if($row["country"]!=null){ ?>
                     <p style="color:#2F4F4F;"><i class="fa fa-map-marker"></i> <?php echo $row["country"];?> </p>
                  <?php } 
                  if($row["facebook"]!=null){ ?>
                    <p style="color:#2F4F4F;"><i class="fa fa-facebook"></i> <?php echo $row["facebook"];?> </p>
                  <?php }
                   if($row["twitter"]!=null){ ?>
                    <p style="color:#2F4F4F;"><i class="fa fa-twitter"></i> <?php echo $row["twitter"];?> </p>
                  <?php }
                  if($row["facebook"]==null && $row["twitter"]==null && $row["country"]==null && $row["about_me"]==null){ ?>
                    <p style="color:#2F4F4F;">(Your about me is currently blank)</p>
                 <?php }
                } ?>
                 <hr>
            </div>
        </div>
      </div>
</div>
  <!-- Edit Profile -->
  <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
       <h2 style="font-family: Roboto:300,400,500,700,900; font-size: 30px; font-weight: normal; margin: 3%;">Edit your profile</h2>
       <hr>
       <h3 style="font-family: Roboto:300,400,500,700,900; font-size: 20px; font-weight: normal; margin: 3%;">Public information</h2>
       
       <!-- Form -->
       <form action="php/update_profile.php" method="post" class="form" enctype="multipart/form-data">
       <!-- #################################################################### -->
          <div class="row">
              <!-- Profile Image -->
              <div class="col-4">
                   <div class="form-group">
                        <div class="img-container">
                            <img src="php/img/<?php echo $row["profile_img"]; ?>">
                        </div>
                        <div class="upload-btn-wrapper">
                        <button class="btnn">Upload a file</button>
                        <input type="file" id="profile_img" name="profile_img" />
                       </div>
<style>
.upload-btn-wrapper {
  position: relative;
  overflow: hidden;
  display: inline-block;
 }

 .btnn {
  border: 2px solid gray;
  color: gray;
  background-color: white;
  padding: 8px 20px;
  border-radius: 8px;
  font-size: 20px;
  font-weight: bold;
 }

 .upload-btn-wrapper input[type=file] {
  font-size: 100px;
  position: absolute;
  left: 0;
  top: 0;
  opacity: 0;
}
</style>
                   </div>
                   <script>
                    $(document).ready(function(){
                        $('#profile_img').filestyle({
                              buttonName: 'btn-success',
                              buttonText:'File selection'
                        });
                    });
                   </script>
                  <input type="text" name="login_id" value="<?php echo $_SESSION['login_user'];?>" hidden>
              </div>
              <!-- Information -->
              <div class="col-8">
                  <div class="form-group">
                    <label>Display Name </label>
                    <input name="dis_name" type="text" class="form-control" value="<?php echo $_SESSION['login_user']; ?>">
                  </div>
                  <div class="form-group">
                    <label>Location </label><br>
                     <input type="text" class="form-control" name="location">
                  </div>
              </div> <!-- End Information -->
          </div> <!-- End row-->
        <!-- #################################################################### --> 
        <div class="form-group">
            <label style=" line-height: 1.3; font-size: 18px; margin: 0 0 1em; font-weight: 400;">About Me </label>
            <textarea name="aboutme"  cols="50" rows="5" style="width:100%;" class="form-control" maxlength="120"></textarea>
         </div>
         <!-- #################### WEB PRESENCE ########################## --> 
         <label style=" line-height: 1.3; font-size: 18px; margin: 0 0 1em; font-weight: 400;">Web Presence </label> 
         <div class="row">
           <div class="col-6"><!-- Facebook -->
           <i class="fa fa-facebook"></i>
           <input name="FacebookUrl" id="FacebookUrl" type="text" class="form-control" placeholder="Facebook">
           </div> <!-- END Facebook -->
           <div class="col-6"> <!--  Twitter -->
           <svg aria-hidden="true" class="svg-icon iconTwitter" width="18" height="18" viewBox="0 0 18 18"><path d="M17 4.04c-.59.26-1.22.44-1.88.52a3.3 3.3 0 0 0 1.44-1.82c-.64.37-1.34.64-2.09.79a3.28 3.28 0 0 0-5.6 2.99A9.3 9.3 0 0 1 2.12 3.1a3.28 3.28 0 0 0 1.02 4.38 3.28 3.28 0 0 1-1.49-.4v.03a3.29 3.29 0 0 0 2.64 3.22 3.34 3.34 0 0 1-1.48.06 3.29 3.29 0 0 0 3.07 2.28 6.58 6.58 0 0 1-4.85 1.36 9.33 9.33 0 0 0 5.04 1.47c6.04 0 9.34-5 9.34-9.33v-.42a6.63 6.63 0 0 0 1.63-1.7L17 4.04z" fill="#2AA3EF"></path></svg>
           <input name="TwitterUrl" id="TwitterUrl" type="text" class="form-control" placeholder="Twitter">
           </div> <!-- END Twitter -->
         </div>
         <hr>
         <!-- #################### END  WEB PRESENCE ########################## --> 
         <div class="form-group"> 
           <input type="submit" name="update_btn" class="btn btn-primary" value="Save Profile">
         </div>
        </form> <!-- End form --> 

      
   </div> <!-- End Edit --> 
  </div> <!-- Tab End --> 

</div> <!-- End Center --> 

<!-- Right Navigation Vertical-->
<div class="col-12 col-md-3" style="margin-top:5%;"></div>

</div><!-- End Main Row -->


<!-- Style -->
<style>
.img-container{
  width:140px;
  min-height: 140px;
  max-height: auto;
  float: left;
  margin: 3px;
  padding: 3px;
 
 }

 .img-container img{
  max-width: 100%;
  height:auto;
}
</style>
</body>
</html>