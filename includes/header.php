<?php
$path = substr(__FILE__, strlen($_SERVER['DOCUMENT_ROOT']));
$format_path = str_replace("\\","/",$path);
$root = explode("/",$format_path)[1];
?>
<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">-->
<link rel="stylesheet" href=/node_modules/bootstrap/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="/node_modules/bootstrap/dist/js/bootstrap.min.js">
</script>
<style>
    .right{
        float:right;
    }
</style>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="#"><?= $_SESSION['username'] ?></a>
            <?php 
                if($_SESSION['role']){?>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
                
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                    <li class="nav-item active">
                        <a class="nav-link" href="<?= "/".$root."/admin/index.php"?>">Home <span class="sr-only">(current)</span></a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="<?= "/".$root."/admin/candidate/addCandidate.php"?>">Add Candidate</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= "/".$root."/admin/candidate/candidatesList.php"?>">Candidates list</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= "/".$root."/admin/users/add_user.php"?>">Add User</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= "/".$root."/admin/users/users_list.php"?>">Users List</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= "/".$root."/admin/add.php"?>">Add Election</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= "/".$root."/admin/modify.php"?>">Modify Election</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= "/".$root."/deletePerson.php"?>">Delete Election</a>
                    </li>
                </ul>
               
            </div>
            <?php }
             
            $path = '/'.explode('\\',dirname(__DIR__))[3].'/includes/logout.php';

            ?>

            <div class="float-right">
            <a class="nav-link" href=<?=$path?>>Logout</a>
            </div>
        </nav>