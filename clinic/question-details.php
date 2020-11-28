<?php

session_start();
if (!isset($_SESSION['username'])) {
    $_SESSION['error'] = "Session timed out. Please login to continue.";
    header('location:../login.php');
} elseif (isset($_SESSION['user_type'])) {
    $user_type = $_SESSION['user_type'];

    if ($user_type == 'ADMIN') {
        header('location:../admin/index.php');
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Question Details | Animal Clinic Assistance</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/blog-post.css" rel="stylesheet">
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

</head>

<body>

   <!-- Navigation -->
   <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="index.php">Animal Clinic Assistance</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
        aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link btn " href="#">New Post
            </a>
          </li>
          <li class="nav-item text-nowrap">
            <a class="nav-link" href="../logout.php?logout">Sign out</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Page Content -->
  <div class="container">

    <div class="row">

      <!-- Post Content Column -->
      <div class="col-lg-12">

      <?php
require_once '../includes/dbOperations.php';
$question_id = $_REQUEST['question_id'];
$db = new DbOperations();
$result = $db->getSingleQuestion($question_id);
$comments = $db->getCommentsPerQuestion($question_id);
?>

        <!-- Title -->
        <h1 class="mt-5 pt-5"> <?php echo $result['title']; ?> </h1>

        <!-- Author -->
        <p class="lead">
          by
          <a href="#"> <?php echo $result['first_name'] . ' ' . $result['last_name']; ?> </a>
        </p>

        <hr>

        <!-- Date/Time -->
        <p>Posted on <?php echo $result['timestamp']; ?></p>
        <hr>

        <!-- Post Content -->
        <p class="lead text-justify"> <?php echo $result['description']; ?> </p>

        <hr>


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


        <!-- Comments Form -->
        <div class="card my-4">
          <h5 class="card-header">Leave a Comment:</h5>
          <div class="card-body">
            <form action="../api/addComment.php" method="POST">

            <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">
            <input type="hidden" name="question_id" value="<?php echo $result['question_id']; ?>">

              <div class="form-group">
                <textarea name="comment" placeholder="Start typing..." rows="4" required class="form-control"></textarea>
              </div>
              <button type="submit" class="btn btn-primary">Submit</button>
            </form>
          </div>
        </div>

        <?php
while ($row = mysqli_fetch_array($comments)):
?>

        <!-- Single Comment -->
        <div class="media mb-4">
          <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
          <div class="media-body">
            <h5 class="mt-0"> <?php echo $row['first_name'] . ' ' . $row['last_name']; ?> </h5>
            <?php echo $row['comment']; ?>
          </div>
        </div>

        <?php
endwhile;
?>

      </div>

    </div>
    <!-- /.row -->

  </div>
  <!-- /.container -->

  <!-- Footer -->
  <footer class="py-5 bg-dark">
    <div class="container">
    <p class="m-0 text-center text-white">2020 &copy; Dreeko Corporations | All Rights Reserved. <a title="https://github.com/Harshana-Rathnayaka/Animal-Clinic-Assistance" target="_blank" href="https://github.com/Harshana-Rathnayaka/Animal-Clinic-Assistance" class="icon-repo-forked"> Repository &rightarrowtail;</a></p>
    </div>
    <!-- /.container -->
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>
