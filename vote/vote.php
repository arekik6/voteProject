<?php

require('../conn_db.php');
$bdd = ConnexionBD::getInstance();

session_start();

$candidate = $_POST["candidate"];
if(isset($_SESSION['username']) && isset($_SESSION['password'])) {

    if(isset($candidate)) {
        $req = $bdd->prepare('UPDATE candidate_election SET vote_number = vote_number + 1 WHERE id_Candidate = ? AND id_Election = ?');
        $req->execute(array($candidate, $_SESSION['election']));
    }

    echo 'Thank you for your vote <br>';
    ?>


    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <a class="btn btn-primary" href="../elections.php" role="button">Home</a>
    <a class="btn btn-primary" href="../results.php" role="button">Show Results</a>
    

<?php
}
else{
    header("Location: ./login");
}
    
?>