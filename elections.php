<?php

require('./conn_db.php');
$bdd = ConnexionBD::getInstance();

session_start();
if(isset($_SESSION['username']) && isset($_SESSION['password']) && isset($_SESSION['msg'])) {
    echo $_SESSION['msg']."<br/>";
   
    $req = $bdd->prepare('SELECT * FROM election');
    $req->execute();
    $elections = $req->fetchAll(PDO::FETCH_OBJ);
    if(count($elections)){
        foreach($elections as $election){
            echo ($election->nom.' : '.$election->description."<br/>" );
        }

    }
    else {
        echo ('No election available');
    }

}
else{
    header("Location: ./login");
}


?>