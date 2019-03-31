<?php
require('../../conn_db.php');
$bdd = ConnexionBD::getInstance();
session_start();
if(isset($_SESSION['username']) && isset($_SESSION['password']) && $_SESSION['role']) {
	
    $req = $bdd->prepare('DELETE FROM user WHERE id=?;');
    $req->execute(array($_POST['id']));    
    if($req){
        echo "success";
    }else{
        echo "failed";
    }
    
}else{
    echo "Not Authorized";
}