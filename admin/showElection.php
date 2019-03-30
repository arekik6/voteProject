<?php
require('../conn_db.php');
$bdd = ConnexionBD::getInstance();
session_start();
if(isset($_SESSION['username']) && isset($_SESSION['password']) && isset($_SESSION['role'])) {
	if($_SESSION['role']){
        $electionID = $_POST['election'];
        $req = $bdd->prepare('SELECT * FROM election where id=?');
            $req->execute(array($electionID));    
            $election = $req->fetch(PDO::FETCH_OBJ);

        include '../includes/header.php';
        ?>
        
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
        <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="../assets/css/style.css" crossorigin="anonymous">


    <div class="container">  

        
    <h2 style="color:white;">Election name:</h2>
        <h3><?=$election->nom?></h3>
    <h2 style="color:white;">Election description:</h2>
        <h3><?=$election->description?></h3>
        <!-- 
            <fieldset>
                <input name="name" placeholder="Election Name" type="text" tabindex="1" required autofocus>
            </fieldset>
            <fieldset>
                <textarea name="desc" placeholder="Election Description ...." tabindex="5" required></textarea>
            </fieldset> -->

            
            <h3 style="color:white;">Candidates List:</h3>
            <ul>
            <?php
            $req = $bdd->prepare('SELECT * FROM candidate as c, candidate_election as ce where ce.id_Candidate = c.id and ce.id_Election = ?');
            $req->execute(array($election->id));    
            $candidates = $req->fetchAll(PDO::FETCH_OBJ);
            foreach($candidates as $candidate) {
            ?>
            <div class="form-check">
                
                <li><label><?=$candidate->firstName.' '.$candidate->lastName.' : '.$candidate->C_description?></label></li>
            </div>
            
            <?php
            }
            ?>
            </ul>
    </div>

        <?php
        
    }else{
        header("Location: ../login");
    }
}
else{
    header("Location: ../login");
}
?>