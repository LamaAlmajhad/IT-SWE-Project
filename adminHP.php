<?php
include_once "inc/config.php";
include "inc/header.php";
?>

<!DOCTYPE html>

<html>

<head>
    <title> Traveller </title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css"
        integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-1.12.4.min.js"
        integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous">
        </script>
    <script src="context-menu.js"></script>
    <link href="context-menu.css" rel="stylesheet">
    <script
            src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js">
        </script>
    <script>
            $(document).ready(function () {
                $(".delete").click(function () {
                    var aID=$(this).attr("value");
                    $.get("delete.php",
                           {airline_id:aID},
                           function(){
                              alert("Airline have been deleted successfully ");
                              window.location.reload();
                           }
                           );
                });
            });
        </script>
    <style>
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
            color: #4475c0;
            text-decoration: none;
        }

        ul.breadcrumb li a:hover {
            color: #01447e;
            text-decoration: underline;
        }


        .airlinelist {
            margin: 80px;
            display: flex;
            flex-direction: column;
            width: 85%;
            height: 100%;
           
            text-align: center;
            border: 1%;
            
            margin: 4%;
            padding: 1.5em;
            border-radius: 15px;
            background-image: url(".jpeg");
            color: white;
            font-size: 1.5em;
            background-image: linear-gradient(to right, #121341,  #4475c0);

        }

        .airlinelist h1 {
            margin-left: 18%;

        }

        .airline1,
        .airline2,
        .airline3,
        .airline4 {
            border: 4px;
            overflow: hidden;
            color: rgb(187, 187, 187);
            box-shadow: 0 0 16px -4px;
            margin: 1%;
            padding: 1.5em;

            background-color: #121341;

        }

        .airlinelist img {
            border: 4px;
            margin: 20px;
            height: 150px;
            width: 200px;
            float: left;
            border-radius: 10%;
        }

        .airlinelist p {
            text-align: left;
            font-size: 0.7em;
            color: white;
        }

        .airlinelist h3 {
            text-align: left;
            font-size: 1.3em;
            color: white;
            margin-top: 2.5%;

        }

        .searchBox {
            position: absolute;
            top: 50%;
            left: 83%;
            transform: translate(-50%, 50%);
            background: #7209b7;
            height: 40px;
            border-radius: 40px;
            padding: 10px;

        }

        .searchBox:hover>.searchInput {
            width: 140px;
            padding: 0 6px;
        }

        .searchBox:hover>.searchButton {
            background: white;
            color: #121341;
        }

        .searchButton {
            color: white;
            float: right;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #121341;
            display: flex;
            justify-content: center;
            align-items: center;
            transition: 0.4s;
        }

        .searchInput {
            border: none;
            background: none;
            outline: none;
            float: left;
            padding: 0;
            color: white;
            font-size: 16px;
            transition: 0.4s;
            line-height: 40px;
            width: 0px;
        }

        /*post button style*/
        .Post-button {
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

        .Post-button:hover {
            box-shadow: rgba(80, 63, 205, 0.5) 0 1px 30px;
            transition-duration: .1s;
        }

        @media (min-width: 768px) {
            .Post-button {
                padding: 0 2.6rem;
            }
        }

        #add {
            float: left;
            margin-left: 10%;
            margin-top: 4%;
            padding-top: 0.8%;
            text-align: center;
            background-color: #7209b7;
            width: 60px;
            height: 35px;
            border-radius: 10%;
        }

        #add a {
            color: #eee;
            text-decoration: none;
            text-align: center;
        }

        .title {
            display: flex;

        }

        .menu {
            float: right;
            display: flex;
            flex-direction: column;
            margin-top: 4.5%;
        }

        a {
      text-decoration: none;
    }
    h4{
      color: white;
      text-align: left;
        
        
    }
    </style>
</head>

<body>

    <header>
        <img src="img/TLogo.jpg" alt="logo" id="logo">
        <input type="submit" class="Post-button " style=" position: absolute;  top: 50%; right: 3%;" value="Logout"
            role="button" onClick=" redirectlogout(); return false;">
        <ul class="breadcrumb">
            <li><a href="#">Home</a></li>
        </ul>
    </header>


    <main>

        <div class="airlinelist">
            <div class="title">



                <input type="submit" class="Post-button " style="margin-top: 1.7em; margin-left: 2%;" value="+ADD"
                       role="button" onClick=" redirect(); return false;">

                <form action="" mathod="GET">
                    <div class="searchBox">

                        <input class="searchInput" type="text" name="search"  value="<?php if (isset($_GET['search']))  ?>" placeholder="Search">
                        <button type="submit" class="searchButton" href="#">

                            <i class='fa fa-search'></i>
                        </button>


                    </div>

                </form>

                <h1>Airline Companies</h1>

            </div>

            <?php
            if (isset($_GET['search'])) {
                $filter = $_GET['search'];
               //$sql="SELECT * FROM airline WHERE name LIKE %$filter%";
                $stmt = $pdo->prepare("SELECT * FROM airline WHERE name LIKE '%" . $filter . "%'");
                $stmt->execute();
                $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

                $SrchRecord = $stmt->rowCount();
                if ($SrchRecord == 0) {
                    echo "There is no record";
                } else {
                    foreach ($stmt->fetchAll() as $row) {
                        ?>

                        <a href="reviews.php?post=<?php echo $row["airlineID"]; ?>">
                            <div class="airline1" id="air1">
                                <img src="<?= $row["img"] ?>" alt=" airline img">
                                <div class="menu">
                                    <a href="Update.php?edit=<?php echo $row["airlineID"]; ?>"class="Post-button ">update</a>
                                    <br>
                                    <button id="delete" value="<?php echo $row["airlineID"]; ?>" class="Post-button delete" >Delete</button>
                                </div>
                                <h3><?= $row["name"] ?></h3>
                                <h4><?= $row["description"] ?></h4>
                                <p><br /> </p>
                            </div>
                        </a>

            <?php
        }
    }
} else {
    $stmt = $pdo->prepare("SELECT * FROM airline");
    $stmt->execute();

   // set the resulting array to asscoiative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    foreach ($stmt->fetchAll() as $row) {
        ?>
                    <a href="reviews.php?post=<?php echo $row["airlineID"]; ?>">
                        <div class="airline1" id="air1">
                            <img src="<?= $row["img"] ?>" alt=" airline img">
                            <div class="menu">
                                <a href="Update.php?edit=<?php echo $row["airlineID"]; ?>"class="Post-button " style="padding-top:5%">update</a>
                                <br>
                                <button id="delete" value="<?php echo $row["airlineID"]; ?>" class="Post-button delete" >Delete</button>
                            </div>
                            <h3><?= $row["name"] ?></h3>
                            <h4><?= $row["description"] ?></h4>
                            <p><br /> </p>
                        </div>
                    </a>

        <?php
    }
}
?>



        </div>


    </main>

    <footer>
        <p>&#169;2022 Traveller All rights reserved.</p>
    </footer>

    <script>
        function redirect() {
            location.href = "addAirlines.php";
        }

        function redirectUpdate() {
            location.href = "Update.php";
        }

        function redirectlogout() {
            location.href = "signout.php";
        }
    </script>

</body>

</html>