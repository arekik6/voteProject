<?php



require('./conn_db.php');
$bdd = ConnexionBD::getInstance();

session_start();
include './includes/header.php';
if(isset($_SESSION['username']) && isset($_SESSION['password']) && isset($_SESSION['msg'])) {
    echo $_SESSION['msg']."<br/>";
   
    $req = $bdd->prepare('SELECT * FROM election');
    $req->execute();
    $elections = $req->fetchAll(PDO::FETCH_OBJ);
    if(count($elections)){
        ?>
        <form id="contact" action="./vote/index.php" method="post">
        <?php
        foreach($elections as $election){
            ?>
                <input type="radio" name="election" value=<?=$election->id?> > 
                <?= $election->nom.' : '.$election->description."<br/>" ?>

        <?php
        }
        ?>
                <button name="submit" type="submit" id="contact-submit" data-submit="...Sending">Submit</button>
             </form>

    <?php
    }
    else {
        echo ('No elections available');
    }

}
else{
    header("Location: ./login");
}


?>

<div class="container">
	<div class="row">
        <div class="span12">
    		<ul class="thumbnails">
                <li class="span5 clearfix">
                  <div class="thumbnail clearfix">
                    <img src="http://placehold.it/320x200" alt="ALT NAME" class="pull-left span2 clearfix" style='margin-right:10px'>
                    <div class="caption" class="pull-left">
                      <a href="http://bootsnipp.com/" class="btn btn-primary icon  pull-right">Select</a>
                      <h4>      
                      <a href="#" >Luis Felipe Kaufmann</a>
                      </h4>
                      <small><b>RG: </b>99384877</small>  
                    </div>
                  </div>
                </li>
                  <li class="span5 clearfix">
                  <div class="thumbnail clearfix">
                    <img src="http://placehold.it/320x200" alt="ALT NAME" class="pull-left span2 clearfix" style='margin-right:10px'>
                    <div class="caption" class="pull-left">
                      <a href="http://bootsnipp.com/" class="btn btn-primary icon  pull-right">Select</a>
                      <h4>      
                      <a href="#" >Luis Felipe Kaufmann</a>
                      </h4>
                      <small><b>RG: </b>99384877</small>  
                    </div>
                  </div>
                </li>
                  <li class="span5 clearfix">
                  <div class="thumbnail clearfix">
                    <img src="http://placehold.it/320x200" alt="ALT NAME" class="pull-left span2 clearfix" style='margin-right:10px'>
                    <div class="caption" class="pull-left">
                      <a href="http://bootsnipp.com/" class="btn btn-primary icon  pull-right">Select</a>
                      <h4>      
                      <a href="#" >Luis Felipe Kaufmann</a>
                      </h4>
                      <small><b>RG: </b>99384877</small>  
                    </div>
                  </div>
                </li>
                  <li class="span5 clearfix">
                  <div class="thumbnail clearfix">
                    <img src="http://placehold.it/320x200" alt="ALT NAME" class="pull-left span2 clearfix" style='margin-right:10px'>
                    <div class="caption" class="pull-left">
                      <a href="http://bootsnipp.com/" class="btn btn-primary icon  pull-right">Select</a>
                      <h4>      
                      <a href="#" >Luis Felipe Kaufmann</a>
                      </h4>
                      <small><b>RG: </b>99384877</small>     
                    </div>
                  </div>
                </li>
                  <li class="span5 clearfix">
                  <div class="thumbnail clearfix">
                    <img src="http://placehold.it/320x200" alt="ALT NAME" class="pull-left span2 clearfix" style='margin-right:10px'>
                    <div class="caption" class="pull-left">
                      <a href="http://bootsnipp.com/" class="btn btn-primary icon  pull-right">Select</a>
                      <h4>      
                      <a href="#" >Luis Felipe Kaufmann</a>
                      </h4>
                      <small><b>RG: </b>99384877</small>
                    </div>
                  </div>
                </li>
                  <li class="span5 clearfix">
                  <div class="thumbnail clearfix">
                    <img src="http://placehold.it/320x200" alt="ALT NAME" class="pull-left span2 clearfix" style='margin-right:10px'>
                    <div class="caption" class="pull-left">
                      <a href="http://bootsnipp.com/" class="btn btn-primary icon  pull-right">Select</a>
                      <h4>      
                      <a href="#" >Luis Felipe Kaufmann</a>
                      </h4>
                      <small><b>RG: </b>99384877</small>
                    </div>
                  </div>
                </li>
            </ul>
        </div>
	</div>
</div>

<div class="list-group">
  <a href="#" class="list-group-item list-group-item-action flex-column align-items-start active">
    <div class="d-flex w-100 justify-content-between">
      <h5 class="mb-1">List group item heading</h5>
      <small>3 days ago</small>
    </div>
    <p class="mb-1">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
    <small>Donec id elit non mi porta.</small>
  </a>
  <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
    <div class="d-flex w-100 justify-content-between">
      <h5 class="mb-1">List group item heading</h5>
      <small class="text-muted">3 days ago</small>
    </div>
    <p class="mb-1">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
    <small class="text-muted">Donec id elit non mi porta.</small>
  </a>
  <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
    <div class="d-flex w-100 justify-content-between">
      <h5 class="mb-1">List group item heading</h5>
      <small class="text-muted">3 days ago</small>
    </div>
    <p class="mb-1">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
    <small class="text-muted">Donec id elit non mi porta.</small>
  </a>
</div>