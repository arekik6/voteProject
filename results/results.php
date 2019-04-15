<?php

require('../conn_db.php');
$bdd = ConnexionBD::getInstance();

session_start();
?>
<link rel="stylesheet" href="../assets/css/results.css" crossorigin="anonymous">
<?php
include '../includes/header.php';

if(isset($_SESSION["election"])){
    $electionID = $_SESSION["election"];
}
elseif(isset($_POST["election"])){
    $electionID = $_POST["election"];
}

if(isset($_SESSION['username']) && isset($_SESSION['password'])) {
    if(isset($electionID)){
        $req = $bdd->prepare('SELECT * FROM candidate_election as CE, candidate as C, election as E 
                WHERE E.id = ? AND C.id = CE.id_Candidate AND CE.id_Election = E.id');
        $req->execute(array($electionID));
        $votes = $req->fetchAll(PDO::FETCH_OBJ);
        ?>
        
        <div class="container">
                <div class="table-container">
                    <table class="table table-filter">
                        <tbody>
                        
        <?php
        
        if(count($votes)){
            echo '<h2>Results for '.$votes[0]->nom.' : '.$votes[0]->description.'</h2><br>';
            foreach($votes as $vote){
            ?>
                    <tr data-status="pagado">
                    
                        <td>
                            <div class="media">
                                <a href="#" class="pull-left">
                                    <img src="<?='.'.$vote->img?>" class="media-photo">
                                </a>
                                <div class="media-body">
                                    <!-- <span class="media-meta pull-right">Febrero 13, 2016</span> -->
                                    <h4 class="title">
                                    <?= $vote->firstName . ' ' . $vote->lastName ?>
                                        <!-- <span class="pull-right pagado">(Pagado)</span> -->
                                    </h4>
                                    <p class="summary"><?= $vote->C_description ?></p>
                                </div>
                            </div>
                        </td>
                        <td>
                        <?= $vote->vote_number?>
                        </td>
                    </tr>

                    <?php
            
            }

        }
    }
}
else{
    header("Location: ../login");
}
unset($_SESSION["election"]);

?>
</tbody>
</table>
</div>
</div>