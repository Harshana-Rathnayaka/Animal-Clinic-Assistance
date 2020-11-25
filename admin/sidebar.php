<nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-sm-3 col-md-2 mr-0 text-center text-info" href="#">Welcome <?php echo $_SESSION['username']; ?>! </a>
    <ul class="navbar-nav px-3">
      <li class="nav-item text-nowrap">
        <a class="nav-link" href="../logout.php?logout">Sign out</a>
      </li>
    </ul>
  </nav>

  <div class="container-fluid">
    <div class="row">
      <nav class="col-md-2 d-none d-md-block bg-light sidebar">
        <div class="sidebar-sticky">
          <ul class="nav flex-column">

          <li class="nav-item">
              <a class="nav-link <?php if($currentPage =='pending-requests'){echo 'active';}?>" href="index.php">
                <span data-feather="user-plus"></span>
              Pending Requests
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link <?php if($currentPage =='all-users'){echo 'active';}?>" href="allusers.php">
                <span data-feather="users"></span>
                All Users
              </a>
            </li>


            <li class="nav-item">
              <a class="nav-link <?php if($currentPage =='settings'){echo 'active';}?>" href="changesettings.php">
                <span data-feather="settings"></span>
                Settings
              </a>
            </li>

          </ul>
        </div>
      </nav>