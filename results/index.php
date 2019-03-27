<?php

require('../conn_db.php');
$bdd = ConnexionBD::getInstance();

session_start();
<<<<<<< HEAD
include '../includes/header.php';

=======
>>>>>>> 52c8804640bebdd54e1192e5cf18731049c67cad
if(isset($_SESSION['username']) && isset($_SESSION['password']) && isset($_SESSION['msg'])) {
    echo $_SESSION['msg']."<br/>";
   
    $req = $bdd->prepare('SELECT * FROM election');
    $req->execute();
    $elections = $req->fetchAll(PDO::FETCH_OBJ);
    if(count($elections)){
        ?>
        <form id="contact" action="./results.php" method="post">
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

}
else{
    header("Location: ../login");
}


?>