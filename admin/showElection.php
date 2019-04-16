<?php
require('../conn_db.php');
$bdd = ConnexionBD::getInstance();
session_start();
if(isset($_SESSION['username']) && isset($_SESSION['password']) && isset($_SESSION['role'])) {
	if($_SESSION['role']){
        if(isset($_POST['modifyID'])){
            $id = $_POST['modifyID'];
            $req = $bdd->prepare("update election set nom=?,description=? where id=?");
            $req->execute(array($_POST['first'],$_POST['description'],$id));

            $req = $bdd->prepare("delete from candidate_election where id_Election=?");
            $req->execute(array($id));

            //var_dump($req);

            $req = $bdd->prepare("select count(*) from candidate;");
            $req->execute();
            $res = $req->fetch(PDO::FETCH_ASSOC);
            $c = $res['count(*)'];
           
            for($i=0;$i<$c;$i++){           
                if(isset($_POST[''.$i])){
                    
                    $req = $bdd->prepare("insert into candidate_election (id_Candidate,id_Election,vote_number) values(?,?,0);");
                    $req->execute(array($_POST[''.$i],$id));
                }
            }
            //echo $i;
        $electionID = $id;
        }else{
        $electionID = $_POST['election'];
        }
        $req = $bdd->prepare('SELECT * FROM election where id=?');
        $req->execute(array($electionID));    
        $election = $req->fetch(PDO::FETCH_OBJ);
        include '../includes/header.php';
        ?>
        
     <!--    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
        <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
-->
        <link rel="stylesheet" href="../assets/css/showElection.css" crossorigin="anonymous"> 


    <div class="container">  
        <div id="contact">
        
    <h3>Election name:</h3>
        <p><?=$election->nom?></p>
    <h3>Election description:</h3>
        <p><?=$election->description?></p>

            
            <h3>Candidates List:</h3>
            <ul>
            <?php
            $req = $bdd->prepare('SELECT * FROM candidate as c, candidate_election as ce where ce.id_Candidate = c.id and ce.id_Election = ?');
            $req->execute(array($election->id));    
            $candidates = $req->fetchAll(PDO::FETCH_OBJ);
            foreach($candidates as $candidate) {
            ?>
            <div class="form-check">
                
                <li><label><?=$candidate->firstName.' '.$candidate->lastName?></label></li>
            </div>
            
            <?php
            }
            ?>
            </ul>
            <table class='buttonsTable'>
                <tr>

                    <form action="./modify.php" method="post">
                            <button type="submit" name="modifyID" value="<?=$election->id?>" class="btn btn-primary">modify</button>
                    </form>

                    <form action="./delete.php" method="post">
                            <button type="submit" name="deleteID" value="<?=$election->id?>" class="btn btn-danger">delete</button>
                    </form>
                </tr>

            </table>

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