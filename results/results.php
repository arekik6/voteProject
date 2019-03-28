<link rel="stylesheet" href="../assets/css/results.css" crossorigin="anonymous">

<?php

require('../conn_db.php');
$bdd = ConnexionBD::getInstance();

session_start();
$electionID = $_POST["election"];
if(isset($_SESSION['username']) && isset($_SESSION['password'])) {
    $req = $bdd->prepare('SELECT * FROM candidate_election as CE, candidate as C, election as E 
            WHERE E.id = ? AND C.id = CE.id_Candidate AND CE.id_Election = E.id');
    $req->execute(array($electionID));
    $votes = $req->fetchAll(PDO::FETCH_OBJ);
    if(count($votes)){
        echo 'Results for '.$votes[0]->nom.' : '.$votes[0]->description.'<br>';
        foreach($votes as $vote){
            echo $vote->firstName.' '.$vote->lastName.' : '.$vote->C_description.' got '.$vote->vote_number.' votes <br>';
        }

    }
}
else{
    header("Location: ../login");
}

?>