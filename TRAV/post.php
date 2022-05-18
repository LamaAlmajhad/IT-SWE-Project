<?php
include_once "inc/config.php";
include "inc/header.php";

// reviewID	reviewerName	email	review	reviewerImg

if(isset($_POST["insert_data"])) {
  $reviewerName = strip_tags($_POST["name"]);
  $email = strip_tags($_POST["email"]);
  $review = strip_tags($_POST["review"]);
  $reviewerImg = null;
  $target_dir = "pictures/";
  $file = $_FILES;
  if(!empty($file)) {
    try{
    $target_file = $target_dir . basename($file["picture"]["name"]);
    //$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    
    //$extensions = explode('.', $file["picture"]["name"]);
    //$extension = end($extensions);
    

    // Check file size
    if($file["picture"]["size"] > 50000000) {
      exit("Image size is too large.");
    }else{
      move_uploaded_file($file["picture"]["tmp_name"], $target_file);
      $reviewerImg = $target_file;
    }
  }catch(Exception $e) {
    exit($e->getMessage());
  }
    
  }
$p = $_GET['post1'];
  try{
    if($reviewerImg !== null) {
      $sql = "INSERT INTO review (reviewerName, email, review, reviewerImg, airID) VALUES ('$reviewerName', '$email', '$review', '$reviewerImg', '$p')";
      $pdo->exec($sql);
    }else{
      $sql = "INSERT INTO review (reviewerName, email, review, airID) VALUES ('$reviewerName', '$email', '$review', '$p')";
      $pdo->exec($sql);
    }
  }catch(PDOException $e) {
    exit($sql. "<br>" . $e->getMessage());
  }
  ?>
  <!--<script>
    alert("Posted successfully.");
    window.location.href='reviews.php';
  </script>-->
  <?php

  
  echo "<script>alert('Posted successfully.')</script>";
 
   header("Location:reviews.php?post=".$_GET['post1']);
}

?>
<!DOCTYPE html>

<html lang="en" >
<head>
  <meta charset="UTF-8">
        <title>Add review</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css'><link rel="stylesheet" href="CSS/reviewsCSS.css">
   
          <script>
  function checkText() {

    text = document.getElementById("feedback").value;

    if (text == "") {
    alert("enter a review please"); 

    }
    else {

     var answer = window.confirm("Are you sure you want to add this review?");
            if (answer) {
 alert("Your review have been added successfully!");
window.location.href='reviews.php';
    }else{
        
       document.getElementById("submit-button").disabled = true;
         window.location.reload();
        
    }

}
  }
  
  </script>
         
         <style>
         
         
   html,body {
      width: 100%;
      height: 100%;
      background-color: #121341;
    }

    #logo {
      width: 10%;
      height: 10%;
    }

    header,footer {
      width: 100%;
      position: relative;
    }

    footer {
      font-weight: bold;
      text-align: center;
      line-height: 3em;
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
      color: #0275d8;
      text-decoration: none;
    }

    ul.breadcrumb li a:hover {
      color: #01447e;
      text-decoration: underline;
    }






.form {
  border-radius: 20px;
  box-sizing: border-box;
  padding: 20px;
}



.input-container {
  height: 50px;
  position: relative;
  width: 100%;
}

.ic1 {
  margin-top: 20px;
}

.ic2 {
  margin-top: 10px;
}


.input {
  background-color: #303245;
  border-radius: 12px;
  border: 0;
  box-sizing: border-box;
  color: #eee;
  font-size: 18px;
  height: 100%;
  outline: 0;
  padding: 4px 20px 0;
  width: 100%;
}


.cut {

  border-radius: 10px;
  height: 20px;
  left: 20px;
  position: absolute;
  top: -20px;
  transform: translateY(0);
  transition: transform 200ms;
  width: 76px;
}

.cut-short {
  width: 50px;
}

.input:focus ~ .cut,
.input:not(:placeholder-shown) ~ .cut {
  transform: translateY(8px);
}

.placeholder {
  color: #65657b;
  font-family: sans-serif;
  left: 20px;
  line-height: 14px;
  pointer-events: none;
  position: absolute;
  transform-origin: 0 50%;
  transition: transform 200ms, color 200ms;
  top: 20px;
}

.input:focus ~ .placeholder,
.input:not(:placeholder-shown) ~ .placeholder {
  transform: translateY(-30px) translateX(10px) scale(0.75);
}

.input:not(:placeholder-shown) ~ .placeholder {
  color: #808097;
}

.input:focus ~ .placeholder {
  color: #dc2f55;
}

#feedback{
  height: 150px;
   width: 310px;
}

#submit-button{

  border-radius: 12px;
  padding: 4px 20px 0;
  width: 100%;
}



         </style>
    </head>
<header>
<img src="img/TLogo.jpg"  alt="logo" id="logo">
 
  <ul class="breadcrumb">
   <?php  if(isset($_SESSION['user_id'])) {?>
        <li><a href="adminHP.php">Home</a></li><?php }else{ echo "<li><a href='index.php'>Home</a></li>";} ?>
   <li><a href="reviews.php?post=<?php echo $_GET['post1'];?>">Reviews</a></li>
  <li>Post</li>
</ul>
</header>
   
    <body>
<main class="main">
  <section class="container">
    <div class="title">
       <?php if(isset($_GET['post1']))  {
  
 
        $stmt2 = $pdo->prepare("SELECT name FROM airline WHERE airlineID=".$_GET['post1']);
        $stmt2->execute();
        foreach($stmt2->fetchAll() as $row) {
            $name = $row['name'] ;
        
        ?>
<h2><?php echo $name; ?> Reviews</h2><?php } ?> <?php } ?>
      <div class="underline"></div>
      
 </div>

<br>
    <article class="review">
    <form action="" method="POST" enctype="multipart/form-data" name="form1" id="form1">
    <div class="picture-container">
        <div class="picture">
 <img src="" alt="" id="person-img" class="picture-src"  title="">
            <input type="file" accept="image/*" id="wizard-picture" name="picture" class="">
        </div>
         <h6 class="ch-Picture">Choose Profile Picture</h6>

</div>
<div class="container">
  <div class="form">
      <div class="input-container ic1">
        <input id="firstname" class="input" type="text" name="name" placeholder=" " />
        <div class="cut"></div>
        <label for="firstname" class="placeholder">Name</label>
      </div>
      <div class="input-container ic2">
        <input id="email" name="email" class="input" type="text" placeholder=" " />
        <div class="cut"></div>
          <label for="email" class="placeholder">Email</label>
       
      </div>
      <div class="input-container ic2">
        <input id="feedback" class="input" type="textarea" placeholder="" name="review" required />
        <div class="cut cut-short"></div>
        <label for="feedback" class="placeholder">Write a review</label>
      </div>
      <br> <br><br> <br><br> <br><br> 
    <input type="submit"  class="Post-button" value="Post" name="insert_data" role="button" id="submit-button" onClick="checkText()">
  </form>
    </article>
  </section>


</main>

  <footer>
    <p>&#169;2022 Traveller All rights reserved.</p>
  </footer>
    </body>
</html>
