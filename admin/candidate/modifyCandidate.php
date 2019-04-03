<?php
require('../../conn_db.php');
session_start();
$bdd = ConnexionBD::getInstance();

unset($_SESSION["cmodifyId"]);
if(isset($_SESSION['username']) && isset($_SESSION['password']) && isset($_SESSION['role'])) {
    if($_SESSION['role']){

        $id = $_POST["id"];

        $req = $bdd->prepare('SELECT * FROM candidate WHERE id=?');
        $req->execute(array($id));
        $candidate = $req->fetch(PDO::FETCH_OBJ);
        $_SESSION['cmodifyId'] = $id;


        include '../../includes/header.php';
        ?>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="../../assets/css/style.css" crossorigin="anonymous">


        <div class="container">
            <form id="contact" action="./showCandidate.php" method="post">
                <h3>Add a Candidate</h3>
                <h4>Type all the candidate data</h4>

                <fieldset>
                    <input type="text" name="first" placeholder="First Name" value="<?=$candidate->firstName?>" required/>
                </fieldset>
                <fieldset>
                    <input type="text" name="last" placeholder="Last Name" value="<?=$candidate->lastName?>" required/>
                </fieldset>
                <fieldset>
                    <input type="text" name="email" placeholder="Email" value="<?=$candidate->email?>" required/>
                </fieldset>
                <fieldset>
                    <input type="text" name="tel" placeholder="Tel" value="<?=$candidate->tel?>" required/>
                </fieldset>
                <fieldset>
                    <input type="text" name="address" placeholder="Address" value="<?=$candidate->address?>" required/>
                </fieldset>
                <fieldset>
                    <input type="text" name="description" placeholder="Description" value="<?=$candidate->C_description?>" required/>
                </fieldset>
              <!--  <fieldset>
                    <input type="text" name="img" placeholder="Image"/>
                </fieldset>-->


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