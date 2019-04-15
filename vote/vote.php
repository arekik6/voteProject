<?php

require('../conn_db.php');
$bdd = ConnexionBD::getInstance();

session_start();
include '../includes/header.php';
$candidate = $_POST["candidate"];
if(isset($_SESSION['username']) && isset($_SESSION['password'])) {
    $req = $bdd->prepare('SELECT * FROM user WHERE email = ?');
    $req->execute(array($_SESSION['username']));
    $user = $req->fetch(PDO::FETCH_OBJ);


    if(isset($candidate)) {
        $req = $bdd->prepare('INSERT INTO vote(id_Election,id_User) VALUES(?,?)');
        $req->execute(array($_SESSION['election'],$user->id));

        $req = $bdd->prepare('UPDATE candidate_election SET vote_number = vote_number + 1 WHERE id_Candidate = ? AND id_Election = ?');
        $req->execute(array($candidate, $_SESSION['election']));
    }
    header('Location: ../results/results.php');
    echo 'Thank you for your vote <br>';
    ?>


   <!--  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
   -->
    <a class="btn btn-primary" href="../" role="button">Home</a>
    <a class="btn btn-primary" href="../results" role="button">Show Results</a>
    

<?php
}
else{
    header("Location: ../login");
}
    
?>