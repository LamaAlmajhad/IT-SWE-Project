<?php
include_once "inc/config.php";
include "inc/header.php";

if(isset($_POST["insert_data"])) {
  $name = strip_tags($_POST["airline_name"]);
  $description = strip_tags($_POST["description"]);
  // Airline image
  $airlineImg = null;
  $target_dir = "airline_pictures/";
  $file = $_FILES;
  if(!empty($file)) {
    try{
    $target_file = $target_dir . basename($file["picture"]["name"]);

    // Check file size
    if($file["picture"]["size"] > 50000000) {
      exit("Image size is too large.");
    }else{
      move_uploaded_file($file["picture"]["tmp_name"], $target_file);
      $airlineImg = $target_file;
    }
  }catch(Exception $e) {
    exit($e->getMessage());
  }
    
  }

  try{
    if($airlineImg !== null) {
      $sql = "INSERT INTO airline (name, description, img) VALUES ('$name', '$description', '$airlineImg')";
      $pdo->exec($sql);
    }else{
      $sql = "INSERT INTO airline (name, description) VALUES ('$name', '$description')";
      $pdo->exec($sql);
    }
  }catch(PDOException $e) {
    exit($sql. "<br>" . $e->getMessage());
  }
  ?>
  <script>
    window.location.href='adminHP.php';
  </script>
  <?php
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>AddAirlines</title>

  
<script>
  function checkText() {

    text = document.getElementById("airlinename").value;

    if (text == "") {
      alert("Enter the airline name please");
document.getElementById("submit-button").disabled = true;
         window.location.reload();
    }
    else {

      var answer = window.confirm("Are you sure you want to add this airline?");
            if (answer) {
      
                alert(document.getElementById("airlinename").value + " have been added successfully!");
        window.location.href = 'adminHP.php';
  
    }else{
        
        document.getElementById("submit-button").disabled = true;
         window.location.reload();
        
    }

}
  }
  
  </script>

</head>

<body>
  <header>
    <img src="img/TLogo.jpg" alt="logo" id="logo">
    <ul class="breadcrumb">
      <li><a href="adminHP.php">Home</a></li>
      <li> Add </li>
    </ul>

  </header>


  <main>

    <div class="container">
      <div class="screen__background">

        <span class="screen__background__shape screen__background__shape4"></span>
        <span class="screen__background__shape screen__background__shape3"></span>
        <span class="screen__background__shape screen__background__shape2"></span>
        <span class="screen__background__shape screen__background__shape1"></span>
      </div>

      <div class="form">

        <div class="sign-up" id="sign-up-info">
        <form id="sign-up-form" method="POST" action="" enctype="multipart/form-data">
          <div class="picture-container">
            <div class="picture">
              <img src="" alt="" id="person-img" class="picture-src" title="">
              <input name="picture" type="file" accept="image/*" id="wizard-picture" class="">
            </div>
            <h6 class="ch-Picture">Choose The logo</h6>

          </div>
            <input type="text" id="airlinename" placeholder="Airline Name*" name="airline_name" />
            <input type="text" placeholder="Description" name="description" />
            <input type="submit" class="control-button up" value="ADD" name="insert_data" role="button"
               id="submit-button" onclick="checkText()">

          </form>
        </div>
      </div>
    </div>
  </main>

  <footer style="top: 10%">
    <p>&#169;2022 Traveller All rights reserved.</p>
  </footer>


</body>

</html>



<style>
  /*try */
  .container {
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 100vh;
  }

  .screen {
    background: linear-gradient(45deg, #121341 0%, #4475c0 100%);
    position: relative;
    height: 600px;
    width: 360px;
    box-shadow: 0px 0px 24px #5C5696;
  }

  .screen__content {
    z-index: 1;
    position: relative;
    height: 100%;
  }

  .screen__background {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    z-index: 0;
    -webkit-clip-path: inset(0 0 0 0);
    clip-path: inset(0 0 0 0);
  }

  .screen__background__shape {
    transform: rotate(45deg);
    position: absolute;
  }

  .screen__background__shape1 {
    height: 540px;
    width: 540px;
    background: #121341;
    top: -40px;
    right: 160px;
    border-radius: 0 72px 0 0;
  }

  .screen__background__shape2 {
    height: 220px;
    width: 220px;
    background: #7209b7;
    top: -172px;
    right: 0;
    border-radius: 32px;
  }

  .screen__background__shape3 {
    height: 540px;
    width: 190px;
    background: linear-gradient(270deg, #5D54A4, #6A679E);
    top: -24px;
    right: 0;
    border-radius: 32px;
  }

  .screen__background__shape4 {
    height: 400px;
    width: 200px;
    background: #b5179e;
    top: 420px;
    right: 50px;
    border-radius: 60px;
  }

  /*try */

  /*      colors
       #121341   navy  (background)
       #7209b7   purple
       #b5179e   fushi
       #4475c0   blue
     */

  html,
  body {
    width: 100%;
    height: 100%;
    background-color: #121341;
  }

  #logo {
    width: 10%;
    height: 10%;
  }

  header,
  footer {
    width: 100%;
    position: relative;
    background-color: #121341;
  }

  footer {
    font-weight: bold;
    text-align: center;
  }

  footer p {
    color: white;
  }


  ul.breadcrumb {
    padding: 10px 16px;
    list-style: none;
    background-color: #eee;
  }

  ul.breadcrumb li {
    display: inline;
  }

  ul.breadcrumb li+li:before {
    padding: 20px;
    color: black;
    content: "/";
  }

  ul.breadcrumb li a {
    color: #4475c0;
    text-decoration: none;
  }

  ul.breadcrumb li a:hover {
    color: #01447e;
    text-decoration: underline;
  }





  /*here is the style for the form */
  :root {
    --form-height: 550px;
    --form-width: 900px;
    /*  Sea Green */
    --left-color: #121341;
    /*  Light Blue  */
    --right-color: #4475c0;
  }



  .container {
    width: var(--form-width);
    height: var(--form-height);
    position: relative;
    margin: auto;
    box-shadow: 2px 10px 40px rgba(22, 20, 19, 0.4);
    border-radius: 10px;
    margin-top: 50px;
    background-image: linear-gradient(to right, #20407d, #243b55);
  }

  /* 
----------------------
      Overlay
----------------------
*/


  .open-sign-up {
    animation: slideleft 1s linear forwards;
  }

  .open-sign-in {
    animation: slideright 1s linear forwards;
  }

  .overlay .sign-in,
  .overlay .sign-up {
    /*  Width is 385px - padding  */
    --padding: 50px;
    width: calc(385px - var(--padding) * 2);
    height: 100%;
    display: flex;
    justify-content: center;
    flex-direction: column;
    align-items: center;
    padding: 0px var(--padding);
    text-align: center;
  }


  .overlay-text-left-animation {
    animation: text-slide-in-left 1s linear;
  }

  .overlay-text-left-animation-out {
    animation: text-slide-out-left 1s linear;
  }


  .overlay-text-right-animation {
    animation: text-slide-in-right 1s linear;
  }

  .overlay-text-right-animation-out {
    animation: text-slide-out-right 1s linear;
  }


  /* 
------------------------
      Buttons
------------------------
*/
  .switch-button,
  .control-button {
    background-image: linear-gradient(92.88deg, #5643CC 9.16%, #7209b7 43.89%, #5643CC 64.72%);
    border-radius: 8px;
    border-style: none;
    box-sizing: border-box;
    color: #FFFFFF;
    cursor: pointer;
    flex-shrink: 0;
    font-family: "Inter UI", "SF Pro Display", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen, Ubuntu, Cantarell, "Open Sans", "Helvetica Neue", sans-serif;
    font-size: 16px;
    font-weight: 500;
    height: 3rem;
    padding: 0 1.6rem;
    text-align: center;
    text-shadow: rgba(0, 0, 0, 0.25) 0 3px 8px;
    transition: all .5s;
    user-select: none;
    -webkit-user-select: none;
    touch-action: manipulation;
  }

  .control-button:hover {
    box-shadow: rgba(80, 63, 205, 0.5) 0 1px 30px;
    transition-duration: .1s;
  }


  .switch-button {
    border: 2px solid;
  }

  .control-button {
    border: none;
    margin-top: 15px;
  }

  .switch-button:focus,
  .control-button:focus {
    outline: none;
  }

  .control-button.up {
    background-color: #D1D1D4;
    ;
  }

  .control-button.in {
    background-color: var(--right-color);
  }

  /* 
--------------------------
      Forms
--------------------------
*/
  .form {
    width: 100%;
    height: 100%;
    position: absolute;
    border-radius: 10px;
  }

  .form .sign-in,
  .form .sign-up {
    --padding: 50px;
    position: absolute;
    /*  Width is 100% - 385px - padding  */
    width: calc(var(--form-width) - 385px - var(--padding) * 2);
    height: 100%;
    display: flex;
    justify-content: center;
    flex-direction: column;
    align-items: center;
    padding: 0px var(--padding);
    text-align: center;
    margin-right: 19%;
  }


  /* Sign in is initially not displayed */
  .form .sign-in {
    display: none;
  }

  .form .sign-in {
    left: 0;
  }

  .form .sign-up {
    right: 0;
  }

  .form-right-slide-in {
    animation: form-slide-in-right 1s;
  }

  .form-right-slide-out {
    animation: form-slide-out-right 1s;
  }

  .form-left-slide-in {
    animation: form-slide-in-left 1s;
  }

  .form-left-slide-out {
    animation: form-slide-out-left 1s;
  }

  .form .sign-in h1 {
    color: var(--right-color);
    margin: 0;
  }

  .form .sign-up h1 {
    color: var(--left-color);
    margin: 0;
  }

  .social-media-buttons {
    display: flex;
    justify-content: center;
    width: 100%;
    margin: 15px;
  }

  .social-media-buttons .icon {
    width: 40px;
    height: 40px;
    border: 1px solid #dadada;
    border-radius: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    margin: 10px 7px;
  }

  .small {
    font-size: 13px;
    color: grey;
    font-weight: 200;
    margin: 5px;
  }

  .social-media-buttons .icon svg {
    width: 25px;
    height: 25px;
  }

  #sign-in-form input,
  #sign-up-form input {
    margin: 12px;
    font-size: 14px;
    padding: 15px;
    width: 260px;
    font-weight: 300;
    border: none;
    background-color: #e4e4e494;
    font-family: 'Helvetica Neue', sans-serif;
    letter-spacing: 1.5px;
    padding-left: 20px;
  }

  #sign-in-form input::placeholder {
    letter-spacing: 1px;
  }

  .forgot-password {
    font-size: 12px;
    display: inline-block;
    border-bottom: 2px solid #efebeb;
    padding-bottom: 3px;
  }

  .forgot-password:hover {
    cursor: pointer;
  }

  /* 
---------------------------
    Animation
---------------------------
*/
  @keyframes slideright {
    0% {
      clip: rect(0, 385px, var(--form-height), 0);
    }

    30% {
      clip: rect(0, 480px, var(--form-height), 0);
    }

    /*  we want the width to be slightly larger here  */
    50% {
      clip: rect(0px, calc(var(--form-width) / 2 + 480px / 2), var(--form-height), calc(var(--form-width) / 2 - 480px / 2));
    }

    80% {
      clip: rect(0px, var(--form-width), var(--form-height), calc(var(--form-width) - 480px));
    }

    100% {
      clip: rect(0px, var(--form-width), var(--form-height), calc(var(--form-width) - 385px));
    }
  }

  @keyframes slideleft {
    100% {
      clip: rect(0, 385px, var(--form-height), 0);
    }

    70% {
      clip: rect(0, 480px, var(--form-height), 0);
    }

    /*  we want the width to be slightly larger here  */
    50% {
      clip: rect(0px, calc(var(--form-width) / 2 + 480px / 2), var(--form-height), calc(var(--form-width) / 2 - 480px / 2));
    }

    30% {
      clip: rect(0px, var(--form-width), var(--form-height), calc(var(--form-width) - 480px));
    }

    0% {
      clip: rect(0px, var(--form-width), var(--form-height), calc(var(--form-width) - 385px));
    }
  }

  @keyframes text-slide-in-left {
    0% {
      padding-left: 20px;
    }

    100% {
      padding-left: 50px;
    }
  }

  @keyframes text-slide-in-right {
    0% {
      padding-right: 20px;
    }

    100% {
      padding-right: 50px;
    }
  }

  @keyframes text-slide-out-left {
    0% {
      padding-left: 50px;
    }

    100% {
      padding-left: 20px;
    }
  }

  @keyframes text-slide-out-right {
    0% {
      padding-right: 50px;
    }

    100% {
      padding-right: 20px;
    }
  }

  @keyframes form-slide-in-right {
    0% {
      padding-right: 100px;
    }

    100% {
      padding-right: 50px;
    }
  }

  @keyframes form-slide-in-left {
    0% {
      padding-left: 100px;
    }

    100% {
      padding-left: 50px;
    }
  }

  @keyframes form-slide-out-right {
    0% {
      padding-right: 50px;
    }

    100% {
      padding-right: 80px;
    }
  }

  @keyframes form-slide-out-left {
    0% {
      padding-left: 50px;
    }

    100% {
      padding-left: 80px;
    }
  }



  /*Profile Pic Start*/
  .picture-container {
    position: relative;
    cursor: pointer;
    text-align: center;
  }

  .picture {
    width: 150px;
    height: 150px;
    background-color: #999999;
    border: 4px solid #CCCCCC;
    color: #FFFFFF;
    border-radius: 70%;
    margin: 0px auto;
    overflow: hidden;
    transition: all 0.2s;
    -webkit-transition: all 0.2s;
  }

  .picture:hover {
    border-color: #2ca8ff;
  }

  .content.ct-wizard-green .picture:hover {
    border-color: #05ae0e;
  }

  .content.ct-wizard-blue .picture:hover {
    border-color: #3472f7;
  }

  .content.ct-wizard-orange .picture:hover {
    border-color: #ff9500;
  }

  .content.ct-wizard-red .picture:hover {
    border-color: #ff3b30;
  }

  .picture input[type="file"] {
    cursor: pointer;
    display: block;
    height: 100%;
    left: 0;
    opacity: 0 !important;
    position: absolute;
    top: 0;
    width: 100%;
  }

  .picture-src {
    width: 100%;

  }


  .ch-Picture {
    color: #b5179e;
    font-size: 12px;
    font-weight: 600;
  }

  /*Profile Pic End*/
</style>





