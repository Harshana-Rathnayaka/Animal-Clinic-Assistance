<?php

session_start();
require_once '../includes/dbOperations.php';

$response = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (
        isset($_POST['first_name']) and
        isset($_POST['last_name']) and
        isset($_POST['email']) and
        isset($_POST['contact']) and
        isset($_POST['username']) and
        isset($_POST['password']) and
        isset($_POST['account_type'])
    ) {

        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $contact = $_POST['contact'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $user_type = $_POST['account_type'];
        $status;

        if ($user_type == 'PET_OWNER') {
            $status = 'ACTIVE';
        } else {
            $status = 'PENDING';
        }

        // we can operate the data further
        $db = new DbOperations();

        $result = $db->createUser(
            $first_name, $last_name, $email, $contact, $username, $password, $user_type, $status
        );

        if ($result == 1) {

            // success
            $user = $db->getUserByUsername($username);

            if ($user['user_type'] == 'CLINIC') {

                $response['error'] = false;
                $response['message'] = "User registered successfully";
                $_SESSION['missing'] = "You have succesfully registered and is pending approval. Please check back later.";

            } else {

                $response['error'] = false;
                $response['message'] = "User registered successfully";
                $_SESSION['success'] = "You have succesfully registered. Please log in.";

            }

            header("location:../login.php");

        } elseif ($result == 2) {

            // some error
            $response['error'] = true;
            $response['message'] = "Some error occured, please try again";
            $_SESSION['error'] = "Something went wrong, please try again";
            header("location:../index.php");

        } elseif ($result == 0) {

            // user exists
            $response['error'] = true;
            $response['message'] = "It seems you are already registered, please choose a different email and username";
            $_SESSION['error'] = "It seems you are already registered, please choose a different email and username.";
            header("location:../index.php");

        }
    } else {

        // missing fields
        $response['error'] = true;
        $response['message'] = "Required fields are missing";
        $_SESSION['missing'] = "Required fields are missing.";
        header("location:../index.php");

    }
} else {

    // wrong method
    $response['error'] = true;
    $response['message'] = "Invalid Request";

}

// json output
// echo json_encode($response);
