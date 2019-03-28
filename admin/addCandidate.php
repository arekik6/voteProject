<<<<<<< HEAD
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

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
</div>
=======
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
        <form id="contact" action="./addCandidate.php" method="post">
            <h3>Add a Candidate</h3>
            <h4>Type all the candidate data</h4>

            <fieldset>
                <input type="text" name="first" placeholder="First Name" />
            </fieldset>
            <fieldset>
                <input type="text" name="last" placeholder="Last Name" />
            </fieldset>
            <fieldset>
                <input type="text" name="email" placeholder="Email" />
            </fieldset>
            <fieldset>
                <input type="text" name="tel" placeholder="Tel" />
            </fieldset>
            <fieldset>
                <input type="text" name="address" placeholder="Address"/>
            </fieldset>
            <fieldset>
                <input type="text" name="description" placeholder="Description" />
            </fieldset>
            <fieldset>
                <input type="text" name="img" placeholder="Image"/>
            </fieldset>
            

            <fieldset>
                <button name="submit" type="submit" id="contact-submit" data-submit="...Adding">Submit</button>
            </fieldset>
        </form>
    </div>

<?php


        if(isset($_POST["first"]) && isset($_POST["last"]) && isset($_POST["email"]) && isset($_POST["tel"]) && isset($_POST["address"]) && isset($_POST["description"]) && isset($_POST["img"])) {
            $first = $_POST["first"];
            $last = $_POST["last"];
            $email = $_POST["email"];
            $tel = $_POST["tel"];
            $address = $_POST["address"];
            $description = $_POST["description"];
            $img = $_POST["img"];

            $req = $bdd->prepare('INSERT INTO candidate(firstName,lastName,address,email,img,tel,C_description) VALUES(?, ?, ?, ?, ?, ?, ?)');
            $req->execute(array($first, $last, $email, $tel, $address, $description, $img));
            echo "Candidate Added Successfully";
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


    
>>>>>>> 3f125d97db5b38f75fa135feda80d86d6381413e
