<?php
require('../conn_db.php');
$bdd = ConnexionBD::getInstance();
session_start();
if(isset($_SESSION['username']) && isset($_SESSION['password']) && isset($_SESSION['role'])) {
	if($_SESSION['role']){
        include '../includes/header.php';
        ?>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="../assets/css/style.css" crossorigin="anonymous">


    <div class="container">  
        <form id="contact" action="./add.php" method="post">
            <h3>Add an Election</h3>
            <h4>Type all the election data</h4>
            <fieldset>
                <input name="name" placeholder="Election Name" type="text" tabindex="1" required autofocus>
            </fieldset>
            <fieldset>
                <textarea name="desc" placeholder="Election Description ...." tabindex="5" required></textarea>
            </fieldset>

            <p>Candidates List</p>

            <?php
            $req = $bdd->prepare('SELECT * FROM candidate');
            $req->execute();    
            $candidates = $req->fetchAll(PDO::FETCH_OBJ);
            foreach($candidates as $candidate) {
            ?>
            <div class="form-check">
                <input name ="check-list[]" type="checkbox" class="form-check-input" id="materialUnchecked" value=<?=$candidate->id?>>
                <label class="form-check-label" for="materialUnchecked"><?=$candidate->firstName.' '.$candidate->lastName.' : '.$candidate->C_description?></label>
            </div>

            <?php
            }
            ?>


            <fieldset>
                <button name="submit" type="submit" id="contact-submit" data-submit="...Adding">Submit</button>
            </fieldset>
        </form>
    </div>

        <?php
        

        
        if(isset($_POST["name"]) && isset($_POST["desc"])) {
            $name = $_POST["name"];
            $description = $_POST["description"];
            echo $name." ".$description;

            $req = $bdd->prepare("INSERT INTO election(nom,description) VALUES(?, ?)");
            $req->execute(array($name, $description));

            if(!empty($_POST['check-list'])){
                $req = $bdd->prepare('SELECT id FROM election');
                $req->execute();
                $electtion = $req->fetchAll(PDO::FETCH_OBJ);
                $electtion = $electtion[count($electtion)-1];
                foreach($_POST['check-list'] as $candidate) {
                    $req = $bdd->prepare('INSERT INTO candidate_election(id_election,id_candidate,vote_number) VALUES(?, ?, 0)');
                    $req->execute(array($electtion->id, $candidate));
    
                }
            }
        

        }  
        
    }
    else{
        header("Location: ../login");
    }
}
else{
    header("Location: ../login");
}
?>