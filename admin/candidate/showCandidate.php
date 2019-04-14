<?php
require('../../conn_db.php');
$bdd = ConnexionBD::getInstance();
session_start();
if(isset($_SESSION['username']) && isset($_SESSION['password']) && isset($_SESSION['role'])) {
	if($_SESSION['role']){

        if(isset($_SESSION['cmodifyId'])){
            $id = $_SESSION['cmodifyId'];
            if(isset($_POST['first']) && isset($_POST['last']) && isset($_POST['email']) && isset($_POST['tel'])
                && isset($_POST['address']) && isset($_POST['description'])){

                $req = $bdd->prepare('update candidate set firstName=? , lastName=? , address=? , email=? , tel=? ,C_description=? where id=? ');
                $req->execute(array($_POST['first'],$_POST['last'],$_POST['address'],$_POST['email'],$_POST['tel'],$_POST['description'],$id));
        }else{
            $id = $_POST['id'];
        }

        $req = $bdd->prepare('SELECT * FROM candidate where id=?');
            $req->execute(array($id));    
            $candidate = $req->fetch(PDO::FETCH_OBJ);

        include '../../includes/header.php';
        ?>
        
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
        <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="../../assets/css/style.css" crossorigin="anonymous">


    <div class="container">  
        <div id="contact">

    <h3>candidate firstname:</h3>
        <p><?=$candidate->firstName?></p>
    <h3>candidate lastName:</h3>
        <p><?=$candidate->lastName?></p>
    <h3>candidate address:</h3>
        <p><?=$candidate->address?></p>
    <h3>candidate email:</h3>
        <p><?=$candidate->email?></p>
    <h3>candidate tel:</h3>
        <p><?=$candidate->tel?></p>
    <h3>candidate description:</h3>
        <p><?=$candidate->C_description?></p>
   
   
    </div>
    </div>      
        <?php
        
    }else{
        header("Location: ../login");
    }
}
else{
    header("Location: ../login");
}
?>