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

 


function register_employee($username, $email, $password)
{ 

    if (is_user_exists($username)) {
         echo "<script>alert('Email or username already exists.')</script>";
        return false;
    }

    global $pdo;

    $stmt = $pdo->prepare("INSERT INTO `admin` (username, email, password) VALUES (?, ?, ?);");

    $stmt->bindValue(1, $username);
    $stmt->bindValue(2, $email);
    $stmt->bindValue(3, encrypt_password($password));
    $result = $stmt->execute();
    
    if ($result) {
        echo "<script>alert('You have signed up successfully.')</script>";
        return true;
    } else {
        echo "<script>alert('Error while trying singed up.')</script>";
        return false;
    }
}



function is_user_exists($username)
{
    global $pdo;

    $stmt = $pdo->prepare("SELECT * FROM `admin` WHERE username=?;");

    $stmt->bindValue(1, $username);

    $stmt->execute();
    $user = $stmt->fetch();

    if ($user) {
        return true;
    } else {
        return false;
    }
}

function encrypt_password($password)
{
    return password_hash($password, PASSWORD_BCRYPT);
}

?>
<?php




if ($current_user) {
	exit(header("Location: " . $current_user['homepage']));
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') { 

	if (isset($_POST['username']) && isset($_POST['email'])  && isset($_POST['password']) ) {
             

		$username =  $_POST['username'];
		$email =  $_POST['email'];
		$password  =  $_POST['password'];

		$result = register_employee($username, $email, $password);


		if ($result) {
			login($username, $password);
		}
	} else {
             echo "<script>alert('Please provide all required data.')</script>";
		
	}
}

?>
<html>
<title>login</title>
<link rel="stylesheet" href= "CSS/login.css">
<head>

</head>


<body>
   
     
<div class="container">
	<div class="screen">
		<div class="screen__content">
             
			<form class="login" id="signup" action="signup.php" method="post" name="form1">
				<div class="login__field">
					<i class="login__icon fas fa-user"></i>
					<input type="text" class="login__input" placeholder="username" name="username">
         <input type="text" class="login__input" placeholder="email" id="email" name="email"> 
				</div>
				<div class="login__field">
					<i class="login__icon fas fa-lock"></i>
					<input type="password" class="login__input" placeholder="Password"  name="password" required >
				</div>
                            <button  class="button login__submit" onclick="checkEmail(); return false;" > sign up</button> <br>
				<span><a href="login.php" style="margin-left: 40%; color: #eee;">log in?</a></span>
				
<!-- 					<span c -->
					<i class="button__icon fas fa-chevron-right"></i>
                        		
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


        
        <script src="JAVA.S/signupjs.js"></script>
</body>


</html>
