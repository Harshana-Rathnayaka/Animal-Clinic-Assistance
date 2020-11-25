<?php
session_start();
if (!isset($_SESSION['username'])) {
    $_SESSION['error'] = "Session timed out. Please login to continue.";
    header('location:../login.php');
} elseif (isset($_SESSION['user_type'])) {
    $user_type = $_SESSION['user_type'];

    if ($user_type == 'PET_OWNER') {
        header('location:../pet-owner/index.php');
    } else if ($user_type == 'CLINIC') {
        header('location:../clinic/index.php');
    }
}
?>


<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Settings</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet" />

    <link rel="icon" type="image/png" href="images/icons/favicon.ico" />

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>
    <!-- Custom styles for this template -->
    <link href="css/dashboard.css" rel="stylesheet">
</head>

<body>

<?php
$currentPage = 'settings';
include 'sidebar.php';
?>


                    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
                        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Settings</li>
                                </ol>
                            </nav>
                        </div>

                        <div class="container">
                            <h5 class="text-center">Account Details </h5>

                            <?php
                            if (@$_SESSION['success'] == true) {
                                $success = $_SESSION['success'];
                                ?>
                                <script>
                                    swal({
                                        title: "SUCCESS!",
                                        text: "<?php echo $success; ?>",
                                        icon: "success",
                                        button: "OK",
                                    });
                                </script>
                            <?php
                                unset($_SESSION['success']);
                            } elseif (@$_SESSION['error'] == true) {
                                $error = $_SESSION['error'];
                                ?>
                                <script>
                                    swal({
                                        title: "ERROR!",
                                        text: "<?php echo $error; ?>",
                                        icon: "error",
                                        button: "OK",
                                    });
                                </script>
                            <?php
                                unset($_SESSION['error']);
                            } elseif (@$_SESSION['missing'] == true) {
                                $missing = $_SESSION['missing'];
                                ?>
                                <script>
                                    swal({
                                        title: "INFO!",
                                        text: "<?php echo $missing; ?>",
                                        icon: "info",
                                        button: "OK",
                                    });
                                </script>
                            <?php
                                unset($_SESSION['missing']);
                            }
                            ?>

                            <?php
                            include '../api/viewAccountDetails.php';
                            ?>
                            <form id="myform" action="../api/updateAdminDetails.php" method="POST" enctype="multipart/form-data">

                                <input type="hidden" name="userid" value="<?php echo $_SESSION['Id']; ?>">
                                <div class="form-group">
                                    <label>First Name :</label>
                                    <input type="text" class="form-control" value="<?php echo $result['first_name'] ?>" name="fname">
                                </div>
                                <div class="form-group">
                                    <label>Last Name :</label>
                                    <input type="text" class="form-control" value="<?php echo $result['last_name'] ?>" name="lname">
                                </div>
                                <div class="form-group">
                                    <label>Username :</label>
                                    <input type="text" class="form-control" value="<?php echo $result['username'] ?>" name="uname">
                                </div>
                                <div class="form-group">
                                    <label>Email :</label>
                                    <input type="email" class="form-control" value="<?php echo $result['email'] ?>" name="email">
                                </div>

                                <button name="btnUpdate" type="submit" class="btn btn-warning btn-block">Update</button>

                            </form>
                            <span id="result"></span>
                        </div>
                        <br>

                    </main>

                    <div class="ml-auto mr-auto text-center py-5 mt-5">
                        <footer class="footer">
                            <div class="footer__block block no-margin-bottom">
                                <div class="container-fluid text-center">
                                    <p class="no-margin-bottom">2020 &copy; Dreeko Corporations | All Rights Reserved. <a title="www.github.com/Harshana-Rathnayaka" target="_blank" href="https://github.com/Harshana-Rathnayaka" class="icon-repo-forked"> Repository &rightarrowtail;</a></p>
                                </div>
                            </div>
                        </footer>
                    </div>

                </div>
            </div>

            <script src="js/bootstrap.bundle.min.js"></script>
            <script src="js/feather.min.js"></script>
            <script src="js/dashboard.js"></script>
</body>

</html>