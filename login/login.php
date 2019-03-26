<?php

require('../conn_db.php');
$bdd = ConnexionBD::getInstance();

$username = $_POST["USERNAME"];
$password = $_POST["Password"];


if(isset($username) && isset($password)) {
    $req = $bdd->prepare('SELECT * FROM user WHERE email = ? AND password = ?');
    $req->execute(array($username, $password));
    $user = $req->fetchAll(PDO::FETCH_OBJ);
    if(count($user)){
        echo ('Welcome '.$user[0]->firstName.' '.$user[0]->lastName);
        if($user[0]->role){
            header("Location: ../admin");
        }
        else{
            header("Location: ../elections.php");
        }
    }
    else {
        echo ('Wrong credentials');
        header("Location: index.html");

    }
}


?>