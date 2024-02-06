<?php
    include '../initialize.php';

    if($_SERVER['REQUEST_METHOD'] == "POST") {
        $username = $_POST['username'];
        $password = $_POST['password'];
        if(empty($username)){
            echo json_encode("NoUser");
        }elseif(empty($password)){
            echo json_encode("NoPass");
        }elseif(!empty($username) == !empty($password)){
            $user_account = new Login();
            $user_data = $user_account->getUsers($_POST['username'], $_POST['password']);
            echo json_encode($user_data);
        }
    }