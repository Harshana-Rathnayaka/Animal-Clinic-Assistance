<?php

require_once '../includes/dbOperations.php';
$response = array();

if (isset($_SESSION['user_id'])) {

    $user_id = $_SESSION['user_id'];

    // db object
    $db = new DbOperations();

    $users_admin = $db->getUsers();
}

?>