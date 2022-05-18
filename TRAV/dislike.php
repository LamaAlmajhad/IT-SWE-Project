<?php
include "inc/header.php";
include_once('inc/config.php');

if (isset($_GET['review_id'])) {
        $revId = $_GET['review_id'];

        global $pdo;

        $stmt = $pdo->prepare("UPDATE review SET disagree=disagree+1 WHERE reviewID=?;");
        $stmt->bindValue(1, $revId);
        $result = $stmt->execute();

        if ($result) {
            return true;
        } else {
            return false;
        }
}

?>