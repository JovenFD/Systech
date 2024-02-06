<?php
    include '../../initialize.php';

    if($_SERVER['REQUEST_METHOD'] == "POST") {
        
       
            $tbl_user = new User();
            $tbl_user->user_id= htmlspecialchars(trim($_POST["delete_id"]));
    
            $result = $tbl_user->DeleteUser();

            echo json_encode($result);

        
    }