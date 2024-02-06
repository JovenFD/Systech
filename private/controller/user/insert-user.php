<?php
    include '../../initialize.php';

    if($_SERVER['REQUEST_METHOD'] == "POST") {
        
        if(!empty($_FILES['userProfile']['name'])){
                $ImageTmp = file_get_contents($_FILES['userProfile']['tmp_name']);
                $database64 = base64_encode($ImageTmp);
            }else{
                $database64 ="";
            }
      
            $tbl_user = new User();
            $tbl_user->pmvic_name= htmlspecialchars(trim($_POST["pmvic"]));
            $tbl_user->username= htmlspecialchars(trim($_POST["username"]));
            $tbl_user->password= htmlspecialchars(trim($_POST["password"]));
            $tbl_user->role= htmlspecialchars(trim($_POST["role"]));
            $tbl_user->status= htmlspecialchars(trim($_POST["status"]));
            $tbl_user->userProfile= trim($database64);
            
    
            $result = $tbl_user->InsertUser();

            echo json_encode($result);

        
    }