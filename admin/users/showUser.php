<?php
require('../../conn_db.php');
$bdd = ConnexionBD::getInstance();
session_start();
if(isset($_SESSION['username']) && isset($_SESSION['password']) && isset($_SESSION['role'])) {
	if($_SESSION['role']){
	    if(isset($_SESSION['modifyId'])){
	        $id = $_SESSION['modifyId'];
	        if(isset($_POST['first'])&&isset($_POST['last'])&&isset($_POST['email'])&&isset($_POST['tel'])
                &&isset($_POST['address'])&&isset($_POST['role'])){

                $req = $bdd->prepare('update user set firstName=? , lastName=? , address=? , email=? , tel=? ,role=? where id=? ');
                $req->execute(array($_POST['first'],$_POST['last'],$_POST['address'],$_POST['email'],$_POST['tel'],$_POST['role'],$id));

            }else{
	           // echo "problem";
            }
            unset($_SESSION['modifyId']);
            unset($_SESSION['id']);
        }else{
            $id = $_GET['id'];
        }

        $req = $bdd->prepare('SELECT * FROM user where id=?');
            $req->execute(array($id));    
            $user = $req->fetch(PDO::FETCH_OBJ);

        include '../../includes/header.php';
        ?>
        
     <!--    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
        <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
       -->  <link rel="stylesheet" href="../../assets/css/style.css" crossorigin="anonymous">


    <div class="container">  
        <div id="contact">

    <h3>user cin:</h3>
        <p><?=$user->id?></p>
    <h3>user firstname:</h3>
        <p><?=$user->firstName?></p>
    <h3>user lastName:</h3>
        <p><?=$user->lastName?></p>
    <h3>user address:</h3>
        <p><?=$user->address?></p>
    <h3>user email:</h3>
        <p><?=$user->email?></p>
    <h3>user tel:</h3>
        <p><?=$user->tel?></p>
    <h3>user role:</h3>
        <p><?php if($user->role){
            echo "admin";
        }else{
                echo "Elector";
            }   
        ?></p>
   
        
        <!-- 
            <fieldset>
                <input name="name" placeholder="user Name" type="text" tabindex="1" required autofocus>
            </fieldset>
            <fieldset>
                <textarea name="desc" placeholder="user Description ...." tabindex="5" required></textarea>
            </fieldset> -->

            <!-- 
            <h3>Candidates List:</h3>
            <ul>
            <?php
            /* $req = $bdd->prepare('SELECT * FROM candidate as c, candidate_user as ce where ce.id_Candidate = c.id and ce.id_user = ?');
            $req->execute(array($user->id));    
            $candidates = $req->fetchAll(PDO::FETCH_OBJ);
            foreach($candidates as $candidate) { */
            ?>
            <div class="form-check">
                
                <li><label><?=$candidate->firstName.' '.$candidate->lastName.' : '.$candidate->C_description?></label></li>
            </div>
             
            <?php
            //}
            ?>
            </ul>-->
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
unset($_SESSION['modifyId']);
unset($_SESSION['id']);
?>