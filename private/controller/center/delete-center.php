<?php
    include '../../initialize.php';

    if($_SERVER['REQUEST_METHOD'] == "POST") {
        
       
            $tbl_pmvic = new Center();
            $tbl_pmvic->pmvic_id= htmlspecialchars(trim($_POST["delete_id"]));
    
            $result = $tbl_pmvic->DeleteCenter();

            echo json_encode($result);

        
    }