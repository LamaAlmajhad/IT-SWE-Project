
<?php

include "inc/header.php";
include_once('inc/config.php');


?>
<?php
function login($username, $password)
{
    global $pdo;

    
    $stmt = $pdo->prepare("SELECT * FROM `admin` WHERE username=?;");

    $stmt->bindValue(1, $username);
    $stmt->execute();
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['adminID'];
        $_SESSION['user_name'] = $user['username'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['user_homepage'] = 'adminHP.php';
        exit(header("Location: " . $_SESSION['user_homepage']));
    } else {
        echo "<script>alert('Username or password not matched.')</script>";
        
        return false;
    }
}
 ?>
<?php
if ($current_user) {
  exit(header("Location: " . $current_user['homepage']));
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  if (isset($_POST['login']) && isset($_POST['password'])) {
    $username =  $_POST['login'];
    $password =  $_POST['password'];
    login($username, $password);
  } else {
       echo "<script>alert('Please provide all required data')</script>";
    
  }
}
?>

<html>
<title> login</title>
<link rel="stylesheet" href= "CSS/login.css">
<head>

</head>


<body>
<div class="container">
	<div class="screen">
		<div class="screen__content">
			<form class="login" id="login"  method="post">
				<div class="login__field">
					<i class="login__icon fas fa-user"></i>
					<input type="text" class="login__input" placeholder="username"  name="login" required >
				</div>
				<div class="login__field">
					<i class="login__icon fas fa-lock"></i>
					<input type="password" class="login__input" placeholder="Password" name="password" required >
				</div>
				<button class="button login__submit" type="submit"  id="loginButton"> log in</button>
				
					<span class="button__text"></span>
					<i class="button__icon fas fa-chevron-right"></i>
				</button>				
			</form>
			<div class="social-login">
				<h3></h3>
				<div class="social-icons">
					<a href="#" class="social-login__icon fab fa-instagram"></a>
					<a href="#" class="social-login__icon fab fa-facebook"></a>
					<a href="#" class="social-login__icon fab fa-twitter"></a>
				</div>
			</div>
		</div>
		<div class="screen__background">
			<span class="screen__background__shape screen__background__shape4"></span>
			<span class="screen__background__shape screen__background__shape3"></span>		
			<span class="screen__background__shape screen__background__shape2"></span>
			<span class="screen__background__shape screen__background__shape1"></span>
		</div>		
	</div>
</div>

  <script src="JAVA.S/login.js"></script>
</body>

</html>