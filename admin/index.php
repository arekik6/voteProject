<?php
require('../conn_db.php');
session_start();
$bdd = ConnexionBD::getInstance();
if(isset($_SESSION['username']) && isset($_SESSION['password']) && isset($_SESSION['role'])) {
	if($_SESSION['role']){
        include '../includes/header.php';

        $req = $bdd->prepare('SELECT * FROM election');
        $req->execute();
        $elections = $req->fetchAll(PDO::FETCH_OBJ);
        if(count($elections)){

        ?>
            <!--<script src="//code.&jquery.com/jquery-1.11.1.min.js"></script>
            <script src="/voteProject-master/node_modules/jquery/dist/jquery.min.js"></script>
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
            <link rel="stylesheet" href="/voteProject-master/node_modules/bootstrap/dist/css/bootstrap.min.css" >
            
            <script src="/voteProject-master/node_modules/bootstrap/dist/js/bootstrap.min.js">

            <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>-->
            <link rel="stylesheet" type="text/css" href="../elections.css">


        <form id="contact" action="./showElection.php" method="post">
        <div class="container">
            <div class="col-sm-12">
        <?php
        foreach($elections as $election){
            ?>
               <!--  <input type="radio" name="election" value=<?=$election->id?> >  
                <?= $election->nom.' : '.$election->description."<br/>" ?>-->

                <div class="bs-calltoaction bs-calltoaction-warning">
                    <div class="row">
                        <div class="col-md-9 cta-contents">
                            <h1 class="cta-title"><?=$election->nom?></h1>
                            <div class="cta-desc">
                                <p><?=$election->description?></p>
                               
                            </div>
                        </div>
                        <div class="col-md-3 cta-button">
                            <button name="election" type="submit" value="<?=$election->id?>" class="btn btn-lg btn-block">voir plus</button>
                        </div>
                     </div>
                </div>


        <?php
        }
        ?>
         </div>
        </div>
              <!--   <button name="submit" type="submit" id="contact-submit" data-submit="...Sending">Submit</button>-->
             </form> 

        


      
    <?php
        
    }
    else{
        echo ('no Elections yet');
    }
}
else{
    echo ('<h1>not authorized</h1>');
}
}
else{
    header("Location: ../login");
}
?>