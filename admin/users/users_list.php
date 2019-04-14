
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
        <link rel="stylesheet" href="../../assets/css/style.css" crossorigin="anonymous">

        <script src="../lists.js">
        </script>
        <script>
            function myFunction() {
                console.log("myFunction declenchée");
                var input, filter;
                input = document.getElementById('myInput');
                filter = input.value;//.toLowerCase();

                var container = document.getElementById("tbody");
                while (container.firstChild) {
                    container.removeChild(container.firstChild);
                }
                var http = new XMLHttpRequest();
                var url = './getUsers.php?search=' + filter;
                //var params = 'search=' + filter;
                http.open('GET', url, true);

                //Send the proper header information along with the request
                http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                http.onreadystatechange = function() {//Call a function when the state changes.
                    if(http.readyState == 4 && http.status == 200) {
                        console.log("1st if ");
                        console.log(http.responseText);
                        response = JSON.parse(http.responseText);
                        for (i in response){
                            var tr = document.createElement("tr");
                            tr.id = i;
                            tr.onclick = "openUser(" + i + ",'./showUser.php')"

                            var td1 = document.createElement("td");
                            var td2 = document.createElement("td");
                            var td3 = document.createElement("td");
                            var td4 = document.createElement("td");
                            var td5 = document.createElement("td");
                            var button1 = document.createElement("button");
                            button1.classList.add("btn btn-primary");
                            button1.innerText = 'modify';
                            button1.onclick = "openUser(" + i + ",./modifyUser.php); event.stopPropagation();";
                            var button2 = document.createElement("button");
                            button2.classList.add("btn btn-danger");
                            button2.innerText = 'delete';
                            button2.onclick = "deleteUser(" + response[i].id + ",'user'," + i + "); event.stopPropagation();";
                            td5.appendChild(button1);
                            td5.appendChild(button2);

                            td1.innerText = response[i].id;
                            td2.innerText = response[i].firstName;
                            td3.innerText = response[i].lastName;
                            if(response[i].role){
                                td4.innerText = 'admin';
                            }else{
                                td4.innerText = 'user';
                            }
                            tr.appendChild(td1);
                            tr.appendChild(td2);
                            tr.appendChild(td3);
                            tr.appendChild(td4);
                            tr.appendChild(td5);
                            container.appendChild(tr);

                        }
                    }
                }

                http.send('');
            }
        </script>

        <div >

        <input style="left:50%;width: 60%;margin: 2px;" type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names.." title="Type in a name">
        </div>
        <table class="table">
            <thead>
                <tr>
                
                <th scope="col">cin</th>
                <th scope="col">FirstName</th>
                <th scope="col">LastName</th>
                <th scope="col">role</th>
                <th scope="col"></th>
                
                </tr>
            </thead>
            <tbody id="tbody">

    <?php
        
        $req = $bdd->prepare('SELECT * FROM user');
        $req->execute();    
        $users = $req->fetchAll(PDO::FETCH_OBJ);
        $i = 1;
        $path = "./showUser.php";
        foreach($users as $user) {
            ?>
            <tr <?= 'id="'.$i.'" onclick="openUser(this.id,\''.$path.'\')"'?>> 
                
                <td><?=$user->id?></td>
                <td><?=$user->firstName?></td>
                <td><?=$user->lastName?></td>
                <td><?php if($user->role){
                    echo "admin";
                 }else{
                     echo "user";
                 } ?></td>
                 
                 <td>
                     <button onclick="<?="openUser(".$i.","."'./modifyUser.php'".")"?>; event.stopPropagation();" class="btn btn-primary">modify</button>
                     <button onclick="<?="deleteUser(".$user->id.",'user',".$i.")"?>; event.stopPropagation();" class="btn btn-danger">delete</button>

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