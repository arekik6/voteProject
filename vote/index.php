<?php

require('../conn_db.php');
$bdd = ConnexionBD::getInstance();

session_start();

$electionID = $_POST["election"];
if(isset($_SESSION['username']) && isset($_SESSION['password'])) {

    if(isset($electionID)) {
        $_SESSION['election'] = $electionID;
        $req = $bdd->prepare('SELECT * FROM election WHERE id = ?');
        $req->execute(array($electionID));
        $election = $req->fetchAll(PDO::FETCH_OBJ);
        if(count($election)){
            echo ('Welcome in '.$election[0]->nom.' : '.$election[0]->description."<br/>");
            $req = $bdd->prepare('SELECT * FROM candidate as C, candidate_election as CE WHERE C.id = CE.id_candidate and CE.id_Election = ?');
            $req->execute(array($election[0]->id));
            $candidates = $req->fetchAll(PDO::FETCH_OBJ);
            ?>
                <form id="contact" action="./vote.php" method="post">
            <?php
            foreach($candidates as $candidate){
                ?>
                    <input type="radio" name="candidate" value=<?=$candidate->id?> > 
                    <?= $candidate->firstName.' '.$candidate->lastName. ' : '.$candidate->description."<br/>" ?>
            <?php
            }
            ?>

                    <button name="submit" type="submit" id="contact-submit" data-submit="...Voting">Submit</button>
                </form>

        <?php
        }
    }
}
else{
    header("Location: ./login");
}
    
?>