<?php
session_start();
?>
<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Oumbox</title>
  
  	<link rel="shortcut icon" href="img/icons/fav.ico" />

    <!-- start: CSS -->
    
	<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Droid+Sans:400,700">
	<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Droid+Serif">
	<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Boogaloo">
	<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Economica:700,400italic">

   
	<link rel="stylesheet" type="text/css" href="css/demo.css" />
    <link rel="stylesheet" type="text/css" href="css/set1.css" />
	<link rel="stylesheet" type="text/css" href="css/component.css" />
	<link rel="stylesheet" type="text/css" href="css/style_common.css">
	<link rel="stylesheet" type="text/css" href="css/style1.css">
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/bootstrap-responsive.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/header.css">
	<!-- end: CSS -->

	 <script src="js/movieModernizr.js"></script>
  
   <link rel="stylesheet" href="css/login.css">
</head>

<body>
  <?php include('header.php'); ?>
	<div class="myLogin">
	  	
	  	<h2>Inscrivez-vous ou identifiez-vous pour profiter des services personnalisés et de tous les bons plans Oumbox !</h2>
	  	<h3>
	  		<?php 
	  			if(isset($_SESSION['result']) && !$_SESSION['result']['success']){
	  				echo $_SESSION['result']['response'];
	  				session_unset($_SESSION['result']['response']);
	  			}

	  		 ?>
	  	</h3>
	  		<form method="POST" action="user/login.php">
	  			  <div class="loginpanel">
	  			  <div class="txt">
	  			    <input id="user" name="email" type="text" placeholder="Username" />
	  			    <label for="user" class="entypo-user"></label>
	  			  </div>
	  			  <div class="txt">
	  			    <input id="pwd" name="password" type="password" placeholder="Password" />
	  			    <label for="pwd" class="entypo-lock"></label>
	  			  </div>
	  			  <div class="buttons">
	  			    <input type="submit" value="Je me connecte" />
	  			    <span>
	  			      <a href="register.php" class="entypo-user-add register">Je m'inscris</a>
	  			    </span>
	  			  </div>
	  			  
	  			  <div class="hr">
	  			    <div></div>
	  			    <div>OU</div>
	  			    <div></div>
	  			  </div>
	  			  
	  			  <div class="social">
	  			    <a href="javascript:void(0)" class="facebookLogin"></a>
	  			    <a href="javascript:void(0)" class="twitterLogin"></a>
	  			    <a href="javascript:void(0)" class="googleplusLogin"></a>
	  			  </div>
	  			</div>
	  		</form>
		  
	</div>

  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
  <script type="text/javascript" src="js/header.js"></script>

<?php include('footer.php'); ?>
</body>
</html>
