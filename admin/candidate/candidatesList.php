<?php
require('../../conn_db.php');
session_start();
$bdd = ConnexionBD::getInstance();

if(isset($_SESSION['username']) && isset($_SESSION['password']) && isset($_SESSION['role'])) {
	if($_SESSION['role']){
        include '../../includes/header.php';
        ?>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
        <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
        <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">-->
        <link rel="stylesheet" href="/node_modules/bootstrap/dist/css/bootstrap.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="../../assets/css/style.css" crossorigin="anonymous">

        <script src="../lists.js">
        
        </script>
        <table class="table">
            <thead>
                <tr>
                
                <th scope="col">cin</th>
                <th scope="col">FirstName</th>
                <th scope="col">LastName</th>
                <th scope="col">telephone</th>
                <th scope="col"></th>
                
                </tr>
            </thead>
            <tbody>

    <?php
        
        $req = $bdd->prepare('SELECT * FROM candidate');
        $req->execute();    
        $candidates = $req->fetchAll(PDO::FETCH_OBJ);
        $i = 1;
        foreach($candidates as $candidate) {
            ?>
            <tr <?= 'id="'.$i.'" onclick="openUser(this.id,\'./showCandidate.php\')"'?>> 
                
                <td><?=$candidate->id?></td>
                <td><?=$candidate->firstName?></td>
                <td><?=$candidate->lastName?></td>
                <td><?=$candidate->tel?></td>
               
                 
                 <td>
                     <button onclick="<?="openUser(".$i.","."'./modifyCandidate.php'".")"?>; event.stopPropagation();" class="btn btn-primary">modify</button>
                     <button onclick="<?="deleteUser(".$candidate->id.",'candidate',".$i.")"?>; event.stopPropagation();" class="btn btn-danger">delete</button>
                 </td>
            </tr>

        <?php
        $i++;
        }
        ?>
        </tbody>
        </table>


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