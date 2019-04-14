<?php
define("ROW_PER_PAGE",2);
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
        <link rel="stylesheet" href="../../assets/css/candidateList.css" crossorigin="anonymous">

        <script src="../lists.js">
        
        </script>
        <form name='frmSearch' action='' method='post'>

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
        /* Pagination Code starts */
        $per_page_html = '';
        $page = 1;
        $start=0;
        if(!empty($_POST["page"])) {
            $page = $_POST["page"];
            $start=($page-1) * ROW_PER_PAGE;
        }
        $limit=" limit " . $start . "," . ROW_PER_PAGE;

        $sql = 'SELECT * FROM candidate ORDER BY id ASC ';
        $pagination_statement = $bdd->prepare($sql);
        $pagination_statement->execute();    
        $row_count = $pagination_statement->rowCount();
        if(!empty($row_count)){
            $per_page_html .= "<div style='text-align:center;margin:20px 0px;'>";
            $page_count=ceil($row_count/ROW_PER_PAGE);
            if($page_count>1) {
                for($i=1;$i<=$page_count;$i++){
                    if($i==$page){
                        $per_page_html .= '<input type="submit" name="page" value="' . $i . '" class="btn-page current" />';
                    } else {
                        $per_page_html .= '<input type="submit" name="page" value="' . $i . '" class="btn-page" />';
                    }
                }
            }
            $per_page_html .= "</div>";
        }
        
        $query = $sql.$limit;
        $pdo_statement = $bdd->prepare($query);
        $pdo_statement->execute();
        $result = $pdo_statement->fetchAll(PDO::FETCH_OBJ);
        ?>

        <tbody id='table-body'>

        <?php
    	if(!empty($result)) { 
            $j = 1;
            foreach($result as $candidate) {
                ?>
                <tr <?= 'id="'.$candidate->id.'" onclick="openUser(this.id,\'./showCandidate.php\')"'?>> 
                    
                    <td><?=$candidate->id?></td>
                    <td><?=$candidate->firstName?></td>
                    <td><?=$candidate->lastName?></td>
                    <td><?=$candidate->tel?></td>
                
                    
                    <td>
                        <button onclick="<?="openUser(".$candidate->id.","."'./modifyCandidate.php'".")"?>; event.stopPropagation();" class="btn btn-primary">modify</button>
                        <button onclick="<?="deleteUser(".$candidate->id.",'candidate',".$candidate->id.")"?>; event.stopPropagation();" class="btn btn-danger">delete</button>
                    </td>
                </tr>

            <?php
            $j++;
            }
        }
        ?>
        </tbody>
        </table>
        <?= $per_page_html ?>
        </form>


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