<?php
include_once "inc/config.php";
include "inc/header.php";
$stmt = $pdo->prepare("SELECT * FROM review where airID=".$_GET['post']);
$stmt->execute();

// set the resulting array to asscoiative
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Reviews</title>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css'>
  <link rel="stylesheet" href="CSS/reviewsCSS.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script
            src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js">
        </script>
     <script>
            $(document).ready(function () {
                $(".likes").click(function () {
                    var rID=$(this).attr("value");
                    $.get("like.php",
                           {review_id:rID},
                           function(){
                              
                              $('#'+rID+ '.likes').css("background-color", "#4475c0");
                              $('#'+rID+ '.dislikes').css("background-color", "gray");
                                                    
                               
                              
                              s = $("#l-counter."+rID).attr("value") ;
                              s++;
                           
                              $("#d-counter."+rID).html($("#d-counter."+rID).attr("value"));
                              $("#l-counter."+rID).html(s);
                              $('#'+rID+ '.likes').css('pointer-events', 'none');
                              $('#'+rID+ '.dislikes').css('pointer-events', 'auto');
                              
                           }
                           );
                });
            });
        </script>
        <script>
            $(document).ready(function () {
                $(".dislikes").click(function () {
                    var rID=$(this).attr("value");
                    $.get("dislike.php",
                           {review_id:rID},
                           function(){
                               
                              $('#'+rID+ '.likes').css("background-color", "gray");
                              $('#'+rID+ '.dislikes').css("background-color", "#4475c0");
                               s = $("#d-counter."+rID).attr("value") ;
                              s++;
                             
                              $("#d-counter."+rID).html(s);
                              $("#l-counter."+rID).html($("#l-counter."+rID).attr("value"));
                              $('#'+rID+ '.likes').css('pointer-events', 'auto');
                              $('#'+rID+ '.dislikes').css('pointer-events', 'none');
                            }
                           );
                });
            });
        </script>

  <style>
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
  </style>
</head>

<body>
    <header>
        <img src="img/TLogo.jpg" alt="logo" id="logo">

        <ul class="breadcrumb">
            <?php if (isset($_SESSION['user_id'])) { ?>
                <li><a href="adminHP.php">Home</a></li><?php } else {
            echo "<li><a href='index.php'>Home</a></li>";
        } ?>
            <li>Reviews</li>
        </ul>
    </header>


    <main class="main">
        <section class="container">
            <div class="title">
                <?php
                $idp = "fixed";
                if (isset($_GET['post'])) {
                    $idp = $_GET['post'];
                    $stmt2 = $pdo->prepare("SELECT name FROM airline WHERE airlineID=" . $idp);
                    $stmt2->execute();
                    foreach ($stmt2->fetchAll() as $row) {
                        $name = $row['name'];
                        ?>
                        <h2><?php echo $name; ?> Reviews</h2><?php } ?> <?php } else { ?><h2><?php echo $idp; ?> Reviews</h2><?php } ?>

                <div class="underline"></div>
            </div>

            <?php if (isset($_GET['post'])) {
                $p = $_GET['post']; ?>
                <a href="post.php?post1=<?php echo $p; ?>"class="Post-button " style="padding-top:2.5%">+Add Review</a>
            <?php } ?> 
            <br>
<?php
foreach ($stmt->fetchAll() as $row) {
  ?>
            
                <article class="review">
                    <div class="img-container">
                        <img src="<?= $row["reviewerImg"] ?>" alt="" id="person-img" />
                    </div>
                    <h4 id="author"><?= $row["reviewerName"] ?></h4>
                    <p id="email"><?= $row["email"] ?></p>
                    <p id="info"> <?= $row["review"] ?></p>
                    <div class="wrapper">
                        <div class="likes-counter">
                            <div><a id="<?php echo $row["reviewID"]; ?>" class="likes" value="<?php echo $row["reviewID"]; ?>" href="#" class="cnt-btn"><img src="img/like icon.png"></a></div>
                            <div id="l-counter" class="<?php echo $row["reviewID"]; ?>" value="<?= $row["agree"] ?>"><?= $row["agree"] ?></div>
                        </div>
                        <div class="dislikes-counter">
                            <div><a id="<?php echo $row["reviewID"]; ?>" class="dislikes"  value="<?php echo $row["reviewID"]; ?>" href="#" class="cnt-btn" ;><img src="img/dislike icon.png"></a></div>
                            <div id="d-counter" class="<?php echo $row["reviewID"]; ?>"  value="<?= $row["disagree"] ?>"><?= $row["disagree"] ?></div>
                        </div>
                    </div>
                    <br><br>
                </article>
                <br /><br />
    <?php
}
?>

        </section>
    </main>
    <!-- <script src="JAVA.S/reviewsJS.js"></script> -->
    <footer>
        <p>&#169;2022 Traveller All rights reserved.</p>
    </footer>
</body>

</html>
