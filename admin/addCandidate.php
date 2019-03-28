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


    