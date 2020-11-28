<?php

session_start();
if (!isset($_SESSION['username'])) {
    $_SESSION['error'] = "Session timed out. Please login to continue.";
    header('location:../login.php');
} elseif (isset($_SESSION['user_type'])) {
    $user_type = $_SESSION['user_type'];

    if ($user_type == 'ADMIN') {
        header('location:../admin/index.php');
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
    <title>Add New Question</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet"  />
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
$currentPage = 'new-question';
include 'sidebar.php';


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

            <div class="container">
                <h3>New Question</h3>
                <form action="../api/addNewQuestion.php" method="post">
                    <input hidden name="user_id" value="<?php echo $_SESSION['user_id']; ?>">
                    <div class="form-group">
                        <label>Title:</label>
                        <input type="text" required class="form-control" placeholder="Enter the title" name="title">
                    </div>
                    <div class="form-group">
                        <label>Description:</label>
                        <textarea rows="7" col="5" required name="description" placeholder="Enter the description" class="form-control"></textarea>
                    </div>
                    <button type="submit" name="btnNewQuestion" class="btn btn-block btn-primary">Submit</button>
                </form>
            </div>
        </main>


        <div class="ml-auto mr-auto text-center py-5 mt-5">
        <?php include '../footer.php';?>
        </div>


    </div>
</div>

    <script src="js/jquery-3.3.1.slim.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/feather.min.js"></script>
    <script src="js/Chart.min.js"></script>
    <script src="js/dashboard.js"></script>
</body>
</html>
