<?php

session_start();
require_once '../includes/dbOperations.php';

$response = array();

// db object
$db = new DbOperations();

if (isset($_POST['btnUpdateUserStatus'])) {

    if (isset($_POST['user_id']) && isset($_POST['status'])) {

        // getting the values
        $user_id = $_POST['user_id'];
        $status = $_POST['status'];

        $result = $db->updateUserStatus($user_id, $status);

        if ($result == 0) {

            //success
            $_SESSION['success'] = "User status updated successfully!";
            $response['error'] = true;
            $response['message'] = "User status updated successfully!";
            header("location:../admin/allusers.php");

        } else {

            // some error
            $_SESSION['error'] = "Something went wrong user status was not updated. Please try again later.";
            $response['error'] = true;
            $response['message'] = "Something went wrong user status was not updated. Please try again later.";
            header("location:../admin/allusers.php");

        }
    } else {

        // some fields are missing
        $_SESSION['missing'] = "Please select an option.";
        $response['error'] = true;
        $response['message'] = "Please fill in all the details";
        header("location:../admin/allusers.php");

    }
} elseif (isset($_POST['btnApproveUser'])) {

    if (isset($_POST['user_id']) && isset($_POST['status'])) {

        // getting the values
        $user_id = $_POST['user_id'];
        $status = $_POST['status'];

        $result = $db->updateUserStatus($user_id, $status);

        if ($result == 0) {

            //success
            $_SESSION['success'] = "Account status updated successfully!";
            $response['error'] = true;
            $response['message'] = "Account status updated successfully!";
            header("location:../admin/index.php");

        } else {

            // some error
            $_SESSION['error'] = "Something went wrong user was not approved. Please try again later.";
            $response['error'] = true;
            $response['message'] = "Something went wrong user was not approved. Please try again later.";
            header("location:../admin/index.php");

        }
    } else {

        // some fields are missing
        $_SESSION['missing'] = "Please select an option.";
        $response['error'] = true;
        $response['message'] = "Please fill in all the details";
        header("location:../admin/index.php");

    }
} elseif (!isset($_POST['btnApproveUser']) && !isset($_POST['btnUpdateUserStatus'])) {

    // some fields are missing
    $_SESSION['missing'] = "Please select an option.";
    $response['error'] = true;
    $response['message'] = "Please fill in all the details";
    header("location:../admin/index.php");

}

echo json_encode($response);
