<?php
session_start();
if (isset($_SESSION['username'])) {
    $usertype = $_SESSION['user_type'];
    if ($usertype == 'ADMIN') {
        header("location:admin/index.php");
    } elseif ($usertype == 'CLINIC') {
        header("location:clinic/index.php");
    } elseif ($usertype == 'PET_OWNER') {
        header("location:pet-owner/index.php");
    }
    exit;
}
?>





<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Colorlib Templates">
    <meta name="author" content="Colorlib">
    <meta name="keywords" content="Colorlib Templates">

    <!-- Title Page-->
    <title>Registration | Animal Clinic Assistance</title>

    <!-- Icons font CSS-->
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <!-- Font special for pages-->
    <link
        href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Vendor CSS-->
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="css/main.css" rel="stylesheet" media="all">
</head>

<body>
    <div class="page-wrapper bg-gra-02 p-t-130 p-b-100 font-poppins">
        <div class="wrapper wrapper--w680">
            <div class="card card-4">
                <div class="card-body">
                    <h2 class="title">Registration Form</h2>
                    <form method="POST" action="api/registerUser.php">
                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">first name</label>
                                    <input class="input--style-4" type="text" name="first_name" required>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">last name</label>
                                    <input class="input--style-4" type="text" name="last_name" required>
                                </div>
                            </div>
                        </div>

                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Email</label>
                                    <input class="input--style-4" type="email" name="email" required>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Phone Number</label>
                                    <input class="input--style-4" type="number" name="contact" required>
                                </div>
                            </div>
                        </div>

                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Username</label>
                                    <input class="input--style-4" type="text" name="username" required>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Password</label>
                                    <input class="input--style-4" type="password" name="password" required>
                                </div>
                            </div>
                        </div>

                        <div class="input-group">
                            <label class="label">Account Type</label>
                            <div class="rs-select2 js-select-simple select--no-search">
                                <select name="account_type">
                                    <option disabled="disabled" selected="selected">Choose option</option>
                                    <option value="PET_OWNER">Pet Owner</option>
                                    <option value="CLINIC">Clinic</option>
                                </select>
                                <div class="select-dropdown"></div>
                            </div>
                        </div>




                        <?php
if (@$_SESSION['error'] == true) {
    ?>
                        <div class=" text-danger alert text-center py-3">
                            <?php echo $_SESSION['error']; ?>
                        </div>
                    <?php
unset($_SESSION['error']);
} elseif (@$_SESSION['missing'] == true) {
    ?>
                        <div class=" text-danger alert text-center py-3">
                            <?php echo $_SESSION['missing']; ?>
                        </div>
                    <?php
unset($_SESSION['success']);
} elseif (@$_SESSION['success'] == true) {
    ?>
                        <div class=" text-danger alert text-center py-3">
                            <?php echo $_SESSION['success']; ?>
                        </div>
                    <?php
unset($_SESSION['success']);
}
?>



                        <div class="p-t-15">
                            <button class="btn btn--radius-2 btn--blue" name="registerBtn" type="submit">Submit</button>
                        </div>
                    </form>

                    <div class="p-t-15 col-3">
                        <label class="label">Already a member? <a href="login.php">Login now</a> </label>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Jquery JS-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <!-- Vendor JS-->
    <script src="vendor/select2/select2.min.js"></script>
    <script src="vendor/datepicker/moment.min.js"></script>
    <script src="vendor/datepicker/daterangepicker.js"></script>

    <!-- Main JS-->
    <script src="js/global.js"></script>

</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>
<!-- end document-->