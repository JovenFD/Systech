<?php
    include '../../initialize.php';

    if($_SERVER['REQUEST_METHOD'] == "POST") {
        
        $tbl_user = new User();
        $get_user_id = $tbl_user->fetchUser($_POST['edit_id']);
        
        echo json_encode($get_user_id );
    }