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
    <title>All Users</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet" />

    <link rel="icon" type="image/png" href="images/icons/favicon.ico" />

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
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
$currentPage = 'all-users';
include 'sidebar.php';
?>



                    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
                        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">All Users</li>
                                </ol>
                            </nav>
                        </div>

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
                                    icon: "warning",
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


                        <div class="table-responsive">
                            <table id="allUsersTable" class="table text-center table-striped table-dark table-hover table-sm">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>Contact</th>
                                        <th>Type</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
include '../api/getLists.php';
while ($row = mysqli_fetch_array($all_users_admin)):
?>
                                            <tr>
                                                <td><?php echo $row['user_id']; ?></td>
                                                <td><?php echo $row['first_name']; ?></td>
                                                <td><?php echo $row['last_name']; ?></td>
                                                <td><?php echo $row['username']; ?></td>
                                                <td><?php echo $row['email']; ?></td>
                                                <td><?php echo $row['contact']; ?></td>

                                                <?php
if ($row['user_type'] == 'CLINIC'):
?>
                                                <td class="text-info "><?php echo $row['user_type']; ?></td>
                                                <?php
else:
?>
                                                <td class="text-primary"><?php echo $row['user_type']; ?></td>
                                                <?php
endif;
?>


                                                <?php
if ($row['status'] == 'PENDING'): ?>
                                                <td class="badge badge-warning"><?php echo $row['status']; ?></td>
                                                <?php
elseif ($row['status'] == 'SUSPENDED'): ?>
                                                    <td class="badge badge-danger"><?php echo $row['status']; ?></td>
                                                <?php
else:
?>
                                                    <td class="badge badge-success"><?php echo $row['status']; ?></td>
                                                    <?php
endif;
?>


                                                <td class="text-left">
                                                    <form action="../api/updateUserStatus.php" method="POST">
                                                        <input type="hidden" name="user_id" value="<?php echo $row['user_id']; ?>" >
                                                        <div class="form-group">
                                                            <select class="form-control col-10" name="status" required>
                                                                <option selected disabled>Update User</option>
                                                                <option value="ACTIVE">Activate</option>
                                                                <option value="SUSPENDED">Suspend</option>
                                                            </select>
                                                        </div>
                                                        <br>
                                                        <button type="submit" name="btnUpdateUserStatus" class="btn btn-primary">Update</button>
                                                    </form>
                                                </td>

                                            </tr>

                                            <?php
endwhile;
?>

                                </tbody>
                            </table>
                        </div>
                    </main>

                    <div class="ml-auto mr-auto text-center py-5 mt-5">
                    <?php include 'footer.php';?>
                    </div>

                </div>
            </div>
            <script src="js/jquery-3.3.1.slim.min.js"></script>
            <script src="js/bootstrap.bundle.min.js"></script>
            <script src="js/feather.min.js"></script>
            <script src="js/Chart.min.js"></script>
            <script src="js/dashboard.js"></script>

            <!--===============================================================================================-->
            <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
            <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
            <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>

            <script>
                $(document).ready(function() {
                    $('#allUsersTable').DataTable({
                        "lengthMenu": [2, 5, 10],
                    });
                });
            </script>

</body>

</html>