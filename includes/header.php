<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<style>
.right{
    float:right;
}
</style>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="#"><?php echo $_SESSION['username'];?></a>
            <?php 
                if($_SESSION['role']){?>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
                
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="add.php">Add Election</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="modify.php">Modify Election</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="delete.php">Delete Election</a>
                    </li>
                </ul>
               
            </div>
            <?php }
             
            $path = dirname(__FILE__);
            $path .= "/logout.php";
            $path = "C:/xampp/htdocs/voteProject-master/includes/logout.php"
            //include_once($path);
            ?>
            <div class="float-right">
            <a class="nav-link" href="/voteProject-master/includes/logout.php">Logout</a>
            </div>
            <!-- <form action="/voteProject-master/includes/logout.php" method="get">
                <input type="submit" value="Logout">
             </form> -->
        </nav>