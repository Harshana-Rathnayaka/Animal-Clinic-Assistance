<?php

session_start();
require_once '../includes/dbOperations.php';

$response = array();

// checks the method call
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['username']) and isset($_POST['password'])) {

        $username = $_POST['username'];
        $password = $_POST['password'];

        // db object
        $db = new DbOperations();

        if ($db->userLogin($username, $password)) {

            // getting user data
            $user = $db->getUserByUsername($username);

            // checks if the user is approved
            if ($user['status'] == 'ACTIVE') {

                // pet owner account
                if ($user['user_type'] == 'PET_OWNER') {

                    // session and reroute
                    $_SESSION['username'] = $user['username'];
                    $_SESSION['first_name'] = $user['first_name'];
                    $_SESSION['last_name'] = $user['last_name'];
                    $_SESSION['email'] = $user['email'];
                    $_SESSION['user_id'] = $user['user_id'];
                    $_SESSION['user_type'] = $user['user_type'];

                    $response['error'] = false;
                    $response['message'] = "Per Owner";

                    header("location:../pet-owner/index.php");

                    // admin account
                } elseif ($user['user_type'] == 'ADMIN') {

                    // session and reroute
                    $_SESSION['username'] = $user['username'];
                    $_SESSION['first_name'] = $user['first_name'];
                    $_SESSION['last_name'] = $user['last_name'];
                    $_SESSION['email'] = $user['email'];
                    $_SESSION['user_id'] = $user['user_id'];
                    $_SESSION['user_type'] = $user['user_type'];

                    $response['error'] = false;
                    $response['message'] = "Admin";

                    header("location:../admin/index.php");

                    // animal clinic account
                } elseif ($user['user_type'] == 'CLINIC') {

                    // session and reroute
                    $_SESSION['username'] = $user['username'];
                    $_SESSION['first_name'] = $user['first_name'];
                    $_SESSION['last_name'] = $user['last_name'];
                    $_SESSION['email'] = $user['email'];
                    $_SESSION['user_id'] = $user['user_id'];
                    $_SESSION['user_type'] = $user['user_type'];

                    $response['error'] = false;
                    $response['message'] = "Clinic";

                    header("location:../clinic/index.php");

                }
            } elseif ($user['status'] == 'SUSPENDED') {

                $_SESSION['error'] = "Your account is suspended. Please create a new account or contact the administrator.";
                $response['error'] = true;
                $response['message'] = "Your account is suspended. Please create a new account or contact the administrator.";
                header("location:../login.php");

            } elseif ($user['status'] == 'PENDING') {

                $_SESSION['error'] = "Your account is pending approval. Please try again later.";
                $response['error'] = true;
                $response['message'] = "Your account is pending approval. Please try again later.";
                header("location:../login.php");

            }
        } else {

            $_SESSION['error'] = "The username or password you entered is incorrect. Please check again.";
            $response['error'] = true;
            $response['message'] = "Invalid username or password";
            header("location:../login.php");

        }
    } else {

        $response['error'] = true;
        $response['message'] = "Required fields are missing";
        header('location:../login.php');

    }
} else {

    // wrong method
    $response['error'] = true;
    $response['message'] = "Invalid Request";

}

// json output
echo json_encode($response);
