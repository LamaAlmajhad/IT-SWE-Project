<?php
session_start();
$current_user = false;

if (isset($_SESSION['user_id'])) {
    $current_user = array();
    $current_user['id'] = $_SESSION['user_id'];
    $current_user['username'] = $_SESSION['user_name'];
    $current_user['email'] = $_SESSION['email'];
    $current_user['homepage'] = $_SESSION['user_homepage'];
}
?>