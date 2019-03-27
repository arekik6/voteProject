<?php
session_start();
if(isset($_SESSION['username']) && isset($_SESSION['password']) && isset($_SESSION['role'])) {
	if($_SESSION['role']){
        ?>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="assets/css/style.css" crossorigin="anonymous">
        <script src="assets/js/script.js"></script>

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="#">Admin Dashboard</a>

    <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
        <li class="nav-item active">
            <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="add.php">Add Election</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="modify.php">Modify Election</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="delete.php">Delete Election</a>
        </li>
        </ul>
    </div>
    </nav>


    <div class="container">  
        <form id="contact" action="./add.php" method="post">
            <h3>Add an Election</h3>
            <h4>Type all the election data</h4>
            <fieldset>
                <input name="name" placeholder="Election Name" type="text" tabindex="1" required autofocus>
            </fieldset>
            <fieldset>
                <textarea name="description" placeholder="Election Description ...." tabindex="5" required></textarea>
            </fieldset>

            <input name="submit" id="contact-submit" type="button" value="Add Candidate" onclick="javascript: addCandidate();"/>

            <p>Candidate 1</p>
            <fieldset>
                <input type="text" name="first[]" placeholder="First Name" size="10"/>
                <input type="text" name="last[]" placeholder="Last Name" size="10"/>
                <input type="text" name="email[]" placeholder="Email" size="10"/>
                <input type="text" name="tel[]" placeholder="Tel" size="10"/>
                <input type="text" name="address[]" placeholder="Address" size="10"/>
                <input type="text" name="description[]" placeholder="Description" size="10"/>
                <input type="text" name="img[]" placeholder="Image" size="10"/>
            </fieldset>
            

            <fieldset>
                <button name="submit" type="submit" id="contact-submit" data-submit="...Adding">Submit</button>
            </fieldset>
        </form>
    </div>

    <?php
    /*
    $name = $_POST["name"];
    $description = $_POST["description"];
    $first = $_POST["first[]"];
    $last = $_POST["last[]"];
    $email = $_POST["email[]"];
    $tel = $_POST["tel[]"];
    $address = $_POST["address[]"];
    $descriptionC = $_POST["description[]"];
    $img = $_POST["img[]"];

    
    if(isset($name) && isset($description) && isset($first) && isset($last) && isset($email) && isset($tel) && isset($address) && isset($descriptionC) && isset($img)) {
        echo $name.$description.$first.$last.$email.$tel.$address.$descriptionC.$img;
        /*$req = $bdd->prepare('INSERT INTO candidate(firstName,lastName,address,email,img,tel,description) VALUES(?, ?, ?, ?, ?, ?, ?)');
        $req->execute(array($first, $last, $email, $tel, $address, $descriptionC, $img));
        $req = $bdd->prepare('INSERT INTO election(nom,description) VALUES(?, ?, ?, ?, ?, ?, ?)');
        $req->execute(array($name, $description));

    }
    */
    }
    else{
        header("Location: ../login");
    }
}
else{
    header("Location: ../login");
}
?>