<?php
require('../../conn_db.php');
session_start();
$bdd = ConnexionBD::getInstance();

if(isset($_SESSION['username']) && isset($_SESSION['password']) && isset($_SESSION['role'])) {
    if($_SESSION['role']){

        $id = $_POST["id"];

            $req = $bdd->prepare('SELECT * FROM user WHERE id=?');
            $req->execute(array($id));
            $user = $req->fetch(PDO::FETCH_OBJ);


        include '../../includes/header.php';
        ?>

        <!-- 		<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
                <script src="//code.jquery.com/jquery-1.11.1.min.js"></script> -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="../../assets/css/style.css" crossorigin="anonymous">


        <div class="container">
            <form id="contact" action="" method="post">
                <h3>Add a User</h3>
                <h4>Type all the User data</h4>


                <fieldset>
                    <input type="text" name="first" placeholder="First Name" value="<?=$user->firstName?>"/>
                </fieldset>
                <fieldset>
                    <input type="text" name="last" placeholder="Last Name" value="<?=$user->lastName?>" />
                </fieldset>
                <fieldset>
                    <input type="email" name="email" placeholder="Email" value="<?=$user->email?>"/>
                </fieldset>
                <fieldset>
                    <input type="text" name="tel" placeholder="Tel" value="<?=$user->tel?>"/>
                </fieldset>
                <fieldset>
                    <input type="text" name="address" placeholder="Address" value="<?=$user->address?>"/>
                </fieldset>
                <fieldset>
                    <?php if($user->role){?>
                        <input type="radio" name="role" value="0"> Elector<br>
                        <input type="radio" name="role" value="1" checked> admin<br>
                    <?php }else{?>
                        <input type="radio" name="role" value="0" checked> Elector<br>
                        <input type="radio" name="role" value="1"> admin<br>
                    <?php }?>

                </fieldset>



                <fieldset>
                    <button name="submit" type="submit" id="contact-submit" data-submit="...Adding">Submit</button>
                </fieldset>
            </form>
        </div>

        <?php




    }
    else{
        header("Location: ../login");
    }
}
else{
    header("Location: ../login");
}

?>