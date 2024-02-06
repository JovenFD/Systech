<?php
    include '../../initialize.php';

    if($_SERVER['REQUEST_METHOD'] == "POST") {

        $tbl_user = new User();
        $tbl_user->user_id= htmlspecialchars(trim($_POST["user_id"]));
        $tbl_user->pmvic_name= htmlspecialchars(trim($_POST["pmvic"]));
        $tbl_user->username= htmlspecialchars(trim($_POST["username"]));
        $tbl_user->password= htmlspecialchars(trim($_POST["password"]));
        $tbl_user->role= htmlspecialchars(trim($_POST["role"]));
        $tbl_user->status= htmlspecialchars(trim($_POST["status"]));

        $result = $tbl_user->UpdateUser();

        echo json_encode($result);

    }