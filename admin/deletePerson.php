<?php
require('../conn_db.php');
$bdd = ConnexionBD::getInstance();
session_start();
if(isset($_SESSION['username']) && isset($_SESSION['password']) && $_SESSION['role']) {

    $person = $_POST['personne'];
    if($person == 'user') {
        $req = $bdd->prepare('DELETE FROM user WHERE id=?;');
    }elseif ($person == 'candidate'){
        $req = $bdd->prepare('DELETE FROM candidate WHERE id=?;');
    }
    $success = $req->execute(array($_POST['id']));
    if($success){
        echo "success";
    }else{
        echo "failed";
    }
    
}else{
    echo "Not Authorized";
}