<?php
include "inc/header.php";
include_once('inc/config.php');

if (isset($_GET['airline_id'])) {
        $airId = $_GET['airline_id'];

        global $pdo;

        $stmt = $pdo->prepare("DELETE FROM airline WHERE airlineID=?;");
        $stmt->bindValue(1, $airId);
        $result = $stmt->execute();

        if ($result) {
            return true;
        } else {
            return false;
        }
}

?>


