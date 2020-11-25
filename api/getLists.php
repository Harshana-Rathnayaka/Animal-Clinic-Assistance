<?php

require_once '../includes/dbOperations.php';
$response = array();

if (isset($_SESSION['user_id'])) {

    $user_id = $_SESSION['user_id'];

    // db object
    $db = new DbOperations();

    $all_users_admin = $db->getAllUsers();
    $pending_users_admin = $db->getPendingUsers();
}

?>