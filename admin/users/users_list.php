
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
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="../assets/css/style.css" crossorigin="anonymous">

        <table class="table">
            <thead>
                <tr>
                
                <th scope="col">cin</th>
                <th scope="col">FirstName</th>
                <th scope="col">LastName</th>
                <th scope="col">role</th>
                
                </tr>
            </thead>

    <?php
        
        $req = $bdd->prepare('SELECT * FROM user');
        $req->execute();    
        $users = $req->fetchAll(PDO::FETCH_OBJ);
        foreach($users as $user) {
            ?>
            <tr>
                <td><?=$user->id?></td>
                <td><?=$user->firstName?></td>
                <td><?=$user->lastName?></td>
                <td><?php if($user->role){
                    echo "admin";
                 }else{
                     echo "user";
                 } ?></td>
            </tr>

        <?php
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
<!-- 
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">First</th>
      <th scope="col">Last</th>
      <th scope="col">Handle</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>Mark</td>
      <td>Otto</td>
      <td>@mdo</td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td>Jacob</td>
      <td>Thornton</td>
      <td>@fat</td>
    </tr>
    <tr>
      <th scope="row">3</th>
      <td>Larry</td>
      <td>the Bird</td>
      <td>@twitter</td>
    </tr>
  </tbody>
</table> -->