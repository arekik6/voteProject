<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<style>
  .right {
    float: right;
  }
</style>
<?php
$path = substr(__FILE__, strlen($_SERVER['DOCUMENT_ROOT']));
$format_path = str_replace("\\", "/", $path);
$root = explode("/", $format_path)[1];
?>
<script src=<?= "/" . $root . '/node_modules/jquery/dist/jquery.min.js' ?>></script>
<link rel="stylesheet" href=<?= "/" . $root . '/node_modules/bootstrap/dist/css/bootstrap.min.css' ?>>
<script src=<?= "/" . $root . '/node_modules/bootstrap/dist/js/bootstrap.min.js' ?>>
</script>
<style>
  .f-right {
    text-align: right;
    /*background-color: black;*/
    margin-right:1px; 
  }
  
</style>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <a class="navbar-brand" href="<?='/'.$root."/"?>"><?= $_SESSION['firstName'] ?></a>
 
    <div class="collapse navbar-collapse" id="navbarTogglerDemo03">

    <?php
     if ($_SESSION['role']) { ?>
      <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
        <li class="nav-item active">
          <a class="nav-link" href="<?= "/" . $root . "/admin/index.php" ?>">Home <span class="sr-only">(current)</span></a>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Users</a>
          <div class="dropdown-menu" aria-labelledby="dropdown04">
            <a class="dropdown-item" href="<?= "/" . $root . "/admin/users/users_list.php" ?>">Users list</a>
            <a class="dropdown-item" href="<?= "/" . $root . "/admin/users/add_user.php" ?>">Add user</a>

          </div>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Elections</a>
          <div class="dropdown-menu" aria-labelledby="dropdown04">
            <a class="dropdown-item" href="<?= "/" . $root . "/admin/index.php" ?>">Elections List</a>
            <a class="dropdown-item" href="<?= "/" . $root . "/admin/add.php" ?>">Add election</a>
          </div>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Candidates</a>
          <div class="dropdown-menu" aria-labelledby="dropdown04">
            <a class="dropdown-item" href="<?= "/" . $root . "/admin/candidate/index.php" ?>">Candidates List</a>
            <a class="dropdown-item" href="<?= "/" . $root . "/admin/candidate/addCandidate.php" ?>">Add candidate</a>
          </div>
        </li>


      </ul>
     <?php }?>
    
  </div>

  <?php

$path = '/' . explode('\\', dirname(__DIR__))[3] . '/includes/logout.php';

?>

  <a class="nav-link f-right" href=<?= $path ?>>Logout</a>
 
</nav>