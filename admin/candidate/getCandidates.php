<?php

require('../../conn_db.php');
$bdd = ConnexionBD::getInstance();
session_start();
if(isset($_SESSION['username']) && isset($_SESSION['password']) && isset($_SESSION['role'])&& $_SESSION['role']) {

        if (isset($_GET['search'])) {
            $search = $_GET['search'];
            if(is_numeric($search)){
            $req = $bdd->prepare("SELECT * FROM candidate where CAST(id as CHAR) like ?;");
            $req->execute(array($_GET['search']."%"));
            $candidates = $req->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($candidates);
            }else{
            
            $req = $bdd->prepare("SELECT * FROM candidate where firstName like ? union SELECT * FROM candidate where lastName like ?");
            $req->execute(array($_GET['search']."%",$search."%"));
            $candidates = $req->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($candidates);
            }
        }

}
?>