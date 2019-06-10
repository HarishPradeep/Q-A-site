
<nav class="navbar navbar-icon-top navbar-expand-lg navbar-dark bg-dark">
  
  <a class="navbar-brand" href="#"><img src="img/logo.png" alt="" style="width:10%; height:10%;"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
     
    </ul>
    <ul class="navbar-nav ">
      <form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Search</button>
      </form>
      <?php if(isset($_SESSION['login_user']) && !empty($_SESSION['login_user'])) { ?>
<!-- If user login -->
<!-- ########################## Profile Image ################################ -->
<?php 
include("php/config.php");
$user = $_SESSION['login_user'];
$sql = "SELECT profile_img FROM users WHERE username = '$user'";
$result = mysqli_query($con,$sql);
if(mysqli_num_rows($result) > 0 ){ 
  $row = mysqli_fetch_assoc($result);
  $img = $row["profile_img"]; 
  if($img==null){ ?>
        <img src="img/miniUser.png" alt="" style="width: 6%; height: 6%; margin-left:2%; margin-top:1%;">
    <?php } else { ?> 
        <img src="php/img/<?php echo $img; ?>" alt="" style="display: block; max-width: 30px; max-height:30px; width: auto; height:auto; margin-left:10px; margin-top:5px;">
    <?php }
  } ?>
      <li class="nav-item dropdown"> 
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION['login_user']; ?></a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="users.php">Profile</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="php/logout.php">Logout</a>
        </div>
      </li>
      <?php } else { ?>

<!-- If user not log in -->  
      <li class="nav-item">
        <a class="nav-link" href="login.php">
         
          Login
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="signup.php">
         
          Signup
        </a>
      </li>
      <?php } ?>
      
    </ul>
  </div>
</nav>