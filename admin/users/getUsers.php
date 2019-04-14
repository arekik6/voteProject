<?php

require('../../conn_db.php');
$bdd = ConnexionBD::getInstance();
session_start();
if(isset($_SESSION['username']) && isset($_SESSION['password']) && isset($_SESSION['role'])) {

        if (isset($_GET['search'])) {
            $req = $bdd->prepare("SELECT * FROM user where CAST(id as CHAR) like ?;");
            $req->execute(array($_GET['search']."%"));
            $candidates = $req->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($candidates);
        }

}
?>