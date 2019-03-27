<?php
require('../conn_db.php');
$bdd = ConnexionBD::getInstance();
session_start();
if(isset($_SESSION['username']) && isset($_SESSION['password']) && isset($_SESSION['role'])) {
	if($_SESSION['role']){
        ?>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="#">Admin Dashboard</a>

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
    </nav>
    <?php
        echo ('hello admin');

        $req = $bdd->prepare('SELECT * FROM election');
        $req->execute();
        $elections = $req->fetchAll(PDO::FETCH_OBJ);
        if(count($elections)){
            ?>
            <form id="contact" action="./delete.php" method="post">
            <?php
            foreach($elections as $election){
                ?>
                    <input type="radio" name="election" value=<?=$election->id?> > 
                    <?= $election->nom.' : '.$election->description."<br/>" ?>
    
            <?php
            }
            ?>
                    <button name="submit" type="submit" id="contact-submit" data-submit="...Sending">Submit</button>
                 </form>
    
        <?php
        }
        else {
            echo ('No election available');
        }

        if(isset($_POST['election'])){
            echo $_POST['election'];

            $req = $bdd->prepare('DELETE FROM candidate_election WHERE id_Election = ?');
            $req->execute(array($_POST['election']));

            $req = $bdd->prepare('DELETE FROM election WHERE id = ?');
            $req->execute(array($_POST['election']));
    
        }
    
    }
    else{
        header("Location: ../login");
    }
}
else{
    header("Location: ../login");
}
?>
