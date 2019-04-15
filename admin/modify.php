<?php
require('../conn_db.php');
session_start();
$bdd = ConnexionBD::getInstance();

unset($_SESSION["cmodifyId"]);
if(isset($_SESSION['username']) && isset($_SESSION['password']) && isset($_SESSION['role'])) {
    if($_SESSION['role']){

        $id = $_POST["modifyID"];

        $req = $bdd->prepare('SELECT * FROM election WHERE id=?');
        $req->execute(array($id));
        $election = $req->fetch(PDO::FETCH_OBJ);
        $_SESSION['cmodifyId'] = $id;


        include '../includes/header.php';
        ?>
     <!--    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
      --> 
        <link rel="stylesheet" href="../assets/css/style.css" crossorigin="anonymous">


        <div class="container">
            <form id="contact" action="./showElection.php" method="post">
                <h3>Modify Election</h3>
                <h4>Type all the candidate data</h4>

                <fieldset>
                    <input type="text" name="first" placeholder="Name" value="<?=$election->nom?>" required/>
                </fieldset>
                <fieldset>
                    <input type="text" name="description" placeholder="Description" value="<?=$election->description?>" required/>
                </fieldset>

                <p>Candidates List</p>

                <?php
                    $req = $bdd->prepare('SELECT * FROM candidate');
                    $req->execute();    
                    $candidates = $req->fetchAll(PDO::FETCH_OBJ);
                    foreach($candidates as $candidate) {
                        ?>
                        <div class="form-check">
                            <input name ="check-list[]" type="checkbox" class="form-check-input" id="materialUnchecked" value=<?=$candidate->id?>>
                            <label class="form-check-label" for="materialUnchecked"><?=$candidate->firstName.' '.$candidate->lastName.' : '.$candidate->C_description?></label>
                        </div>

                        <?php
                            }
                ?>




                <fieldset>
                    <button name="submit" type="submit" id="contact-submit" data-submit="...Adding">Submit</button>
                </fieldset>
            </form>
        </div>

        <?php

    }
    else{
        header("Location: ../login");
    }
}
else{
    header("Location: ../login");
}

?>