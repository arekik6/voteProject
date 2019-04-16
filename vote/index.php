<?php

require('../conn_db.php');
$bdd = ConnexionBD::getInstance();

session_start();
include '../includes/header.php';


$electionID = $_POST["election"];
if (isset($_SESSION['username']) && isset($_SESSION['password'])) {
    $req = $bdd->prepare('SELECT * FROM user WHERE email = ?');
    $req->execute(array($_SESSION['username']));
    $user = $req->fetch(PDO::FETCH_OBJ);

    if (isset($electionID)) {
        $req = $bdd->prepare('SELECT * FROM vote WHERE id_Election = ? AND id_User = ?');
        $req->execute(array($electionID,$user->id));
        $votes = $req->fetchAll(PDO::FETCH_OBJ);
        if(!count($votes)){
            $_SESSION['election'] = $electionID;
            $req = $bdd->prepare('SELECT * FROM election WHERE id = ?');
            $req->execute(array($electionID));
            $election = $req->fetch(PDO::FETCH_OBJ);
            if (isset($election)) {
                $req = $bdd->prepare('SELECT * FROM candidate as C, candidate_election as CE WHERE C.id = CE.id_candidate and CE.id_Election = ?');
                $req->execute(array($election->id));
                $candidates = $req->fetchAll(PDO::FETCH_OBJ);
                ?>
<!-- 
            <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
            <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
            <script src="//code.jquery.com/jquery-1.11.1.min.js"></script> -->

            <form id="contact" action="./vote.php" method="post">
            <div class="container">
            <h2><?= 'Welcome in ' . $election->nom . ' election ' ?></h2>
            <div class="table-container">
                <table class="table table-filter">
                    <tbody>
                <?php
                foreach ($candidates as $candidate) {
                    ?>
                <!-- <input type="radio" name="candidate" value=<?= $candidate->id ?> > 
                  <?= $candidate->firstName . ' ' . $candidate->lastName . ' : ' . $candidate->C_description . "<br/>" ?> -->

                <tr data-status="pagado">
                    <td>
                        <div class="ckbox">
                            <input type="radio" id="radio1" name="candidate" value="<?= $candidate->id ?>">
                            <label for="radio1"></label>
                        </div>
                    </td>
                    <td>
                        <div class="media">
                            <a href="#" class="pull-left">
                                <img widhth="70px" height="70px" src="<?='.'.$candidate->img?>" class="media-photo">
                            </a>
                            <div class="media-body">
                                <!-- <span class="media-meta pull-right">Febrero 13, 2016</span> -->
                                <h4 class="title">
                                <?= $candidate->firstName . ' ' . $candidate->lastName ?>
                                    <!-- <span class="pull-right pagado">(Pagado)</span> -->
                                </h4>
                                <p class="summary"><?= $candidate->C_description ?></p>
                            </div>
                        </div>
                    </td>
                </tr>


                <?php

                }
            ?>
                    </tbody>
                </table>
                <button name="submit" type="submit" id="contact-submit" class="btn btn-primary" data-submit="...Voting">Submit</button>
            </div>
            </div>
                
            </form>
            <center>
                <form method='post' action='../results/results.php'>
                    <button type="submit" name="election" value="<?=$_POST["election"]?>" id="contact-submit" class="btn btn-success" >RESULTS</button>
                </form>
            </center>


        <?php

            }
        }
        else{
            ?>
            <center>
                <h2>Sorry you already voted in this election</h2>
                <h2>You can Always see the results : </h2>
                <form method='post' action='../results/results.php'>
                    <button type="submit" name="election" value="<?=$_POST["election"]?>" id="contact-submit" class="btn btn-success" >RESULTS</button>
                </form>
            </center>

        <?php
        }
    }
}
else {
    header("Location: ../login");
}


?>