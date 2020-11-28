<?php

session_start();
require_once '../includes/dbOperations.php';

$response = array();

if (isset($_POST['question_id']) && isset($_POST['user_id']) && isset($_POST['comment'])) {

    // getting the values
    $question_id = $_POST['question_id'];
    $user_id = $_POST['user_id'];
    $comment = $_POST['comment'];

    // db object
    $db = new DbOperations();

    $result = $db->addComment($question_id, $user_id, $comment);

    if ($result == 0) {

        // success
        $_SESSION['success'] = "Comment added successfully!";
        $response['error'] = false;
        $response['message'] = "Comment added successfully!";
        header("location:../clinic/question-details.php");

    } elseif ($result == 1) {

        // some error
        $_SESSION['error'] = "Something went wrong. Please try again later.";
        $response['error'] = true;
        $response['message'] = "Something went wrong. Please try again later.";
        header("location:../clinic/question-details.php");

    }
} else {

    // missing values
    $_SESSION['missing'] = "Some fields are missing.";
    $response['error'] = true;
    $response['message'] = "Some fields are missing.";
    header("location:../clinic/question-details.php");

}
