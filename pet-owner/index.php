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
    <title>All Questions</title>

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
$currentPage = 'all-questions';
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



      <div class="table-responsive">
        <table id="myQuestionsTable" class="table table-striped table-sm">
          <thead>
            <tr>
              <th>#ID</th>
              <th width="15%">Title</th>
              <th>Description</th>
              <th width="15%">Action</th>
            </tr>
          </thead>
          <tbody>

          <?php
include '../api/getLists.php';
while ($row = mysqli_fetch_array($my_questions)):
?>

              <tr>
                  <td> <?php echo $row['question_id']; ?> </td>
                  <td> <?php echo $row['title']; ?> </td>
                  <td class="text-justify"> <?php echo $row['description']; ?> </td>

                  <td>
                    <form method="POST">
                      <button type="submit" name="btnViewQuestion" class="btn btn-sm btn-info">View</button>

                    <br>
                    <br>

                      <button type="submit" name="btnDeleteQuestion" class="btn btn-sm btn-danger">Delete</button>
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
        <?php include '../footer.php';?>
      </div>


  </div>
</div>

        <script src="js/jquery-3.3.1.slim.min.js"></script>
        <script src="js/bootstrap.bundle.min.js"></script>
        <script src="js/feather.min.js"></script>
        <script src="js/Chart.min.js"></script>
        <script src="js/dashboard.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>

        <script>
          $(document).ready(function() {
            $('#myQuestionsTable').DataTable({
              "lengthMenu": [5, 10],
            });
          });
        </script>

  </body>
</html>
