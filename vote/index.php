<?php

require('../conn_db.php');
$bdd = ConnexionBD::getInstance();

session_start();
include '../includes/header.php';


$electionID = $_POST["election"];
if (isset($_SESSION['username']) && isset($_SESSION['password'])) {

    if (isset($electionID)) {
        $_SESSION['election'] = $electionID;
        $req = $bdd->prepare('SELECT * FROM election WHERE id = ?');
        $req->execute(array($electionID));
        $election = $req->fetchAll(PDO::FETCH_OBJ);
        if (count($election)) {
            $req = $bdd->prepare('SELECT * FROM candidate as C, candidate_election as CE WHERE C.id = CE.id_candidate and CE.id_Election = ?');
            $req->execute(array($election[0]->id));
            $candidates = $req->fetchAll(PDO::FETCH_OBJ);
            ?>

            <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
            <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
            <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

            <form id="contact" action="./vote.php" method="post">
            <div class="container">
            <h2><?= 'Welcome in ' . $election[0]->nom . ' election ' ?></h2>
            <div class="table-container">
                <table class="table table-filter">
                    <tbody>
                <?php
                foreach ($candidates as $candidate) {
                    ?>
                <!-- <input type="radio" name="candidate" value=<?= $candidate->id ?> > 
                  <?= $candidate->firstName . ' ' . $candidate->lastName . ' : ' . $candidate->C_description . "<br/>" ?> -->

                <tr data-status="pagado">
                    <td>
                        <div class="ckbox">
                            <input type="radio" id="radio1" name="candidate" value="<?= $candidate->id ?>">
                            <label for="radio1"></label>
                        </div>
                    </td>
                    <td>
                        <div class="media">
                            <a href="#" class="pull-left">
                                <img src="<?=$candidate->img?>" class="media-photo">
                            </a>
                            <div class="media-body">
                                <!-- <span class="media-meta pull-right">Febrero 13, 2016</span> -->
                                <h4 class="title">
                                <?= $candidate->firstName . ' ' . $candidate->lastName ?>
                                    <!-- <span class="pull-right pagado">(Pagado)</span> -->
                                </h4>
                                <p class="summary"><?= $candidate->C_description ?></p>
                            </div>
                        </div>
                    </td>
                </tr>


                <?php

            }
            ?>
                    </tbody>
                </table>
                <button name="submit" type="submit" id="contact-submit" class="btn btn-primary" data-submit="...Voting">Submit</button>
            </div>
            </div>
                
            </form>

<?php

}
}
} else {
    header("Location: ../login");
}

?>

<!-- 
<div class="container">
    <div class="table-container">
        <table class="table table-filter">
            <tbody>
                <tr data-status="pagado">
                    <td>
                        <div class="ckbox">
                            <input type="checkbox" id="checkbox1">
                            <label for="checkbox1"></label>
                        </div>
                    </td>
                    <td>
                        <a href="javascript:;" class="star">
                            <i class="glyphicon glyphicon-star"></i>
                        </a>
                    </td>
                    <td>
                        <div class="media">
                            <a href="#" class="pull-left">
                                <img src="https://s3.amazonaws.com/uifaces/faces/twitter/fffabs/128.jpg" class="media-photo">
                            </a>
                            <div class="media-body">
                                <span class="media-meta pull-right">Febrero 13, 2016</span>
                                <h4 class="title">
                                    Lorem Impsum
                                    <span class="pull-right pagado">(Pagado)</span>
                                </h4>
                                <p class="summary">Ut enim ad minim veniam, quis nostrud exercitation...</p>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr data-status="pendiente">
                    <td>
                        <div class="ckbox">
                            <input type="checkbox" id="checkbox3">
                            <label for="checkbox3"></label>
                        </div>
                    </td>
                    <td>
                        <a href="javascript:;" class="star">
                            <i class="glyphicon glyphicon-star"></i>
                        </a>
                    </td>
                    <td>
                        <div class="media">
                            <a href="#" class="pull-left">
                                <img src="https://s3.amazonaws.com/uifaces/faces/twitter/fffabs/128.jpg" class="media-photo">
                            </a>
                            <div class="media-body">
                                <span class="media-meta pull-right">Febrero 13, 2016</span>
                                <h4 class="title">
                                    Lorem Impsum
                                    <span class="pull-right pendiente">(Pendiente)</span>
                                </h4>
                                <p class="summary">Ut enim ad minim veniam, quis nostrud exercitation...</p>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr data-status="cancelado">
                    <td>
                        <div class="ckbox">
                            <input type="checkbox" id="checkbox2">
                            <label for="checkbox2"></label>
                        </div>
                    </td>
                    <td>
                        <a href="javascript:;" class="star">
                            <i class="glyphicon glyphicon-star"></i>
                        </a>
                    </td>
                    <td>
                        <div class="media">
                            <a href="#" class="pull-left">
                                <img src="https://s3.amazonaws.com/uifaces/faces/twitter/fffabs/128.jpg" class="media-photo">
                            </a>
                            <div class="media-body">
                                <span class="media-meta pull-right">Febrero 13, 2016</span>
                                <h4 class="title">
                                    Lorem Impsum
                                    <span class="pull-right cancelado">(Cancelado)</span>
                                </h4>
                                <p class="summary">Ut enim ad minim veniam, quis nostrud exercitation...</p>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr data-status="pagado" class="selected">
                    <td>
                        <div class="ckbox">
                            <input type="checkbox" id="checkbox4" checked>
                            <label for="checkbox4"></label>
                        </div>
                    </td>
                    <td>
                        <a href="javascript:;" class="star star-checked">
                            <i class="glyphicon glyphicon-star"></i>
                        </a>
                    </td>
                    <td>
                        <div class="media">
                            <a href="#" class="pull-left">
                                <img src="https://s3.amazonaws.com/uifaces/faces/twitter/fffabs/128.jpg" class="media-photo">
                            </a>
                            <div class="media-body">
                                <span class="media-meta pull-right">Febrero 13, 2016</span>
                                <h4 class="title">
                                    Lorem Impsum
                                    <span class="pull-right pagado">(Pagado)</span>
                                </h4>
                                <p class="summary">Ut enim ad minim veniam, quis nostrud exercitation...</p>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr data-status="pendiente">
                    <td>
                        <div class="ckbox">
                            <input type="checkbox" id="checkbox5">
                            <label for="checkbox5"></label>
                        </div>
                    </td>
                    <td>
                        <a href="javascript:;" class="star">
                            <i class="glyphicon glyphicon-star"></i>
                        </a>
                    </td>
                    <td>
                        <div class="media">
                            <a href="#" class="pull-left">
                                <img src="https://s3.amazonaws.com/uifaces/faces/twitter/fffabs/128.jpg" class="media-photo">
                            </a>
                            <div class="media-body">
                                <span class="media-meta pull-right">Febrero 13, 2016</span>
                                <h4 class="title">
                                    Lorem Impsum
                                    <span class="pull-right pendiente">(Pendiente)</span>
                                </h4>
                                <p class="summary">Ut enim ad minim veniam, quis nostrud exercitation...</p>
                            </div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>


<div class="container">
    <div class="row">

        <section class="content">
            <h1>Table Filter</h1>
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="pull-right">
                            <div class="btn-group">
                                <button type="button" class="btn btn-success btn-filter" data-target="pagado">Pagado</button>
                                <button type="button" class="btn btn-warning btn-filter" data-target="pendiente">Pendiente</button>
                                <button type="button" class="btn btn-danger btn-filter" data-target="cancelado">Cancelado</button>
                                <button type="button" class="btn btn-default btn-filter" data-target="all">Todos</button>
                            </div>
                        </div>
                        <div class="table-container">
                            <table class="table table-filter">
                                <tbody>
                                    <tr data-status="pagado">
                                        <td>
                                            <div class="ckbox">
                                                <input type="checkbox" id="checkbox1">
                                                <label for="checkbox1"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="javascript:;" class="star">
                                                <i class="glyphicon glyphicon-star"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <div class="media">
                                                <a href="#" class="pull-left">
                                                    <img src="https://s3.amazonaws.com/uifaces/faces/twitter/fffabs/128.jpg" class="media-photo">
                                                </a>
                                                <div class="media-body">
                                                    <span class="media-meta pull-right">Febrero 13, 2016</span>
                                                    <h4 class="title">
                                                        Lorem Impsum
                                                        <span class="pull-right pagado">(Pagado)</span>
                                                    </h4>
                                                    <p class="summary">Ut enim ad minim veniam, quis nostrud exercitation...</p>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr data-status="pendiente">
                                        <td>
                                            <div class="ckbox">
                                                <input type="checkbox" id="checkbox3">
                                                <label for="checkbox3"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="javascript:;" class="star">
                                                <i class="glyphicon glyphicon-star"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <div class="media">
                                                <a href="#" class="pull-left">
                                                    <img src="https://s3.amazonaws.com/uifaces/faces/twitter/fffabs/128.jpg" class="media-photo">
                                                </a>
                                                <div class="media-body">
                                                    <span class="media-meta pull-right">Febrero 13, 2016</span>
                                                    <h4 class="title">
                                                        Lorem Impsum
                                                        <span class="pull-right pendiente">(Pendiente)</span>
                                                    </h4>
                                                    <p class="summary">Ut enim ad minim veniam, quis nostrud exercitation...</p>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr data-status="cancelado">
                                        <td>
                                            <div class="ckbox">
                                                <input type="checkbox" id="checkbox2">
                                                <label for="checkbox2"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="javascript:;" class="star">
                                                <i class="glyphicon glyphicon-star"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <div class="media">
                                                <a href="#" class="pull-left">
                                                    <img src="https://s3.amazonaws.com/uifaces/faces/twitter/fffabs/128.jpg" class="media-photo">
                                                </a>
                                                <div class="media-body">
                                                    <span class="media-meta pull-right">Febrero 13, 2016</span>
                                                    <h4 class="title">
                                                        Lorem Impsum
                                                        <span class="pull-right cancelado">(Cancelado)</span>
                                                    </h4>
                                                    <p class="summary">Ut enim ad minim veniam, quis nostrud exercitation...</p>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr data-status="pagado" class="selected">
                                        <td>
                                            <div class="ckbox">
                                                <input type="checkbox" id="checkbox4" checked>
                                                <label for="checkbox4"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="javascript:;" class="star star-checked">
                                                <i class="glyphicon glyphicon-star"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <div class="media">
                                                <a href="#" class="pull-left">
                                                    <img src="https://s3.amazonaws.com/uifaces/faces/twitter/fffabs/128.jpg" class="media-photo">
                                                </a>
                                                <div class="media-body">
                                                    <span class="media-meta pull-right">Febrero 13, 2016</span>
                                                    <h4 class="title">
                                                        Lorem Impsum
                                                        <span class="pull-right pagado">(Pagado)</span>
                                                    </h4>
                                                    <p class="summary">Ut enim ad minim veniam, quis nostrud exercitation...</p>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr data-status="pendiente">
                                        <td>
                                            <div class="ckbox">
                                                <input type="checkbox" id="checkbox5">
                                                <label for="checkbox5"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="javascript:;" class="star">
                                                <i class="glyphicon glyphicon-star"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <div class="media">
                                                <a href="#" class="pull-left">
                                                    <img src="https://s3.amazonaws.com/uifaces/faces/twitter/fffabs/128.jpg" class="media-photo">
                                                </a>
                                                <div class="media-body">
                                                    <span class="media-meta pull-right">Febrero 13, 2016</span>
                                                    <h4 class="title">
                                                        Lorem Impsum
                                                        <span class="pull-right pendiente">(Pendiente)</span>
                                                    </h4>
                                                    <p class="summary">Ut enim ad minim veniam, quis nostrud exercitation...</p>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="content-footer">
                    <p>
                        Page © - 2016 <br>
                        Powered By <a href="https://www.facebook.com/tavo.qiqe.lucero" target="_blank">TavoQiqe</a>
                    </p>
                </div>
            </div>
        </section>

    </div>
</div>  -->