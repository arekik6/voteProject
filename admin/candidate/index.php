<?php
define("ROW_PER_PAGE",4);
require('../../conn_db.php');
session_start();
$bdd = ConnexionBD::getInstance();

if(isset($_SESSION['username']) && isset($_SESSION['password']) && isset($_SESSION['role'])) {
	if($_SESSION['role']){
				include '../../includes/header.php';
				$search_keyword = '';
				if(!empty($_POST['search']['keyword'])) {
					$search_keyword = $_POST['search']['keyword'];
				}

        ?>
         <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
        <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="../../assets/css/style.css" crossorigin="anonymous">
        <link rel="stylesheet" href="../../assets/css/candidateList.css" crossorigin="anonymous">

        <script src="../lists.js">
        
        </script>
        <form name='frmSearch' action='' method='post'>
				<div id="search" style="text-align:right;margin:20px 20px;" ><input type='text' name='search[keyword]' value="<?= $search_keyword ?>" id='keyword' maxlength='25'></div>

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
			
        $sql = 'SELECT * FROM candidate WHERE id LIKE :keyword OR firstName LIKE :keyword OR lastName LIKE :keyword ORDER BY id ASC ';
				$pagination_statement = $bdd->prepare($sql);
				$pagination_statement->bindValue(':keyword', '%' . $search_keyword . '%', PDO::PARAM_STR);
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
				$pdo_statement->bindValue(':keyword', '%' . $search_keyword . '%', PDO::PARAM_STR);
        $pdo_statement->execute();
        $result = $pdo_statement->fetchAll(PDO::FETCH_OBJ);
        ?>

        <tbody id='table-body'>
        <?php
    	if(!empty($result)) { 
            foreach($result as $candidate) {
                ?>
                <tr <?= 'id="'.$candidate->id.'" '?>> 

                    <td><?=$candidate->id?></td>
                    <td><?=$candidate->firstName?></td>
                    <td><?=$candidate->lastName?></td>
                    <td><?=$candidate->tel?></td>
					<td >
                    <table class='buttonsTable'>
                        <tr>

                            <form action="./showCandidate.php" method="post">
                                    <button type="submit" name="showID" value="<?=$candidate->id?>" class="btn btn-success">show</button>
                            </form>

                            <form action="./modifyCandidate.php" method="post">
                                    <button type="submit" name="modifyID" value="<?=$candidate->id?>" class="btn btn-primary">modify</button>
                            </form>
                            <button type="button" onclick="<?="deleteUser(".$candidate->id.",'candidate',".$candidate->id.")"?>; event.stopPropagation();" class="btn btn-danger">delete</button>

                        </tr>

                    </table>

                	</td>


                </tr>

            <?php
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