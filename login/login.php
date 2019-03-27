<?php

require('../conn_db.php');
$bdd = ConnexionBD::getInstance();

session_start();

$username = $_POST["USERNAME"];
$password = $_POST["Password"];


if(isset($username) && isset($password)) {
    $req = $bdd->prepare('SELECT * FROM user WHERE email = ? AND password = ?');
    $req->execute(array($username, $password));
    $user = $req->fetchAll(PDO::FETCH_OBJ);
    if(count($user)){
        $_SESSION['username'] = $user[0]->email;
        $_SESSION['password'] = $user[0]->password;
        $_SESSION['role'] = $user[0]->role;
        $_SESSION['msg'] = 'Welcome '.$user[0]->firstName.' '.$user[0]->lastName;

        echo ('Welcome '.$user[0]->firstName.' '.$user[0]->lastName);
        if($user[0]->role){
            header("Location: ../admin");
        }
        else{
            header("Location: ../elections.php");
        }
    }
    else {
        $_SESSION['msg'] = 'Wrong credentials';
        echo ('Wrong credentials');
        header("Location: ./");

    }
}

?>