<?php

session_start();
require_once '../includes/dbOperations.php';

$response = array();

if (!isset($_POST['btnDeleteQuestion'])) {

    // some fields are missing
    $_SESSION['missing'] = "Some fields are missing";
    $response['error'] = true;
    $response['message'] = "Please fill in all the details";
    header("location:../pet-owner/index.php");

} else {

    // getting the values
    $question_id = $_POST['question_id'];

    // db object
    $db = new DbOperations();

    $result = $db->deleteQuestion($question_id);

    if ($result == 0) {

        // successfully deleted the question
        $_SESSION['success'] = "Successfully deleted the question.";
        $response['error'] = false;
        $response['message'] = 'Successfully deleted the question';
        header("location:../pet-owner/index.php");

    } elseif ($result == 1) {

        // some error occured
        $_SESSION['error'] = "Something went wrong, couldn't delete the question.";
        $response['error'] = true;
        $response['message'] = "Couldn't delete the question";
        header("location:../pet-owner/index.php");

    }
}

echo json_encode($response);
