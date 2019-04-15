<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<?php
session_start();

if(isset($_SESSION['username']) && isset($_SESSION['password']) && isset($_SESSION['role'])) {
	if($_SESSION['role']){
        include '../includes/header.php';
       
    require('../conn_db.php');
    $bdd = ConnexionBD::getInstance();
    
    if(isset($_SESSION['username']) && isset($_SESSION['password']) && isset($_SESSION['role'])) {
        if($_SESSION['role']){
    

        if(isset($_POST['deleteID'])){
            echo $_POST['deleteID'];

            $req = $bdd->prepare('DELETE FROM candidate_election WHERE id_Election = ?');
            $req->execute(array($_POST['deleteID']));

            $req = $bdd->prepare('DELETE FROM election WHERE id = ?');
            $req->execute(array($_POST['deleteID']));
            header("Location: ./index.php");

        }
    
    }
    else{
        header("Location: ../login");
    }
}
else{
    header("Location: ../login");
}

}
}
?>

