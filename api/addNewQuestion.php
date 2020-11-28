<?php

session_start();
require_once '../includes/dbOperations.php';

$response = array();

// check the method request
if (isset($_POST['btnNewQuestion'])) {

    if (isset($_POST['user_id']) && isset($_POST['title']) && isset($_POST['description'])) {

        // getting the values from the form
        $user_id = $_POST['user_id'];
        $title = $_POST['title'];
        $description = $_POST['description'];

        // db object
        $db = new DbOperations();

        $result = $db->createPost($user_id, $title, $description);

        if ($result == 0) {

            // success
            $_SESSION['success'] = "Question posted successfully!";
            $response['error'] = false;
            $response['message'] = "Question posted successfully!";
            header("location:../pet-owner/index.php");

        } elseif ($result == 1) {

            // some error
            $_SESSION['error'] = "Something went wrong. Please try again later.";
            $response['error'] = true;
            $response['message'] = "Something went wrong. Please try again later.";
            header("location:../pet-owner/new-question.php");

        }

    } else {

        // missing values
        $_SESSION['missing'] = "Some fields are missing.";
        $response['error'] = true;
        $response['message'] = "Some fields are missing.";
        header("location:../pet-owner/new-question.php");

    }

    echo json_encode($response);
}
