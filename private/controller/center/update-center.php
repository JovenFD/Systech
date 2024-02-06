<?php
    include '../../initialize.php';

    if($_SERVER['REQUEST_METHOD'] == "POST") {
        
        if(!empty($_FILES['pmvicProfile']['name'])){
            $ImageTmp = file_get_contents($_FILES['pmvicProfile']['tmp_name']);
            $database64 = base64_encode($ImageTmp);
        }else{
            $database64 = $_POST["pmvicOldLogo"];
        }

       
            $tbl_pmvic = new Center();
            $tbl_pmvic->pmvic_id= htmlspecialchars(trim($_POST["pmvicID"]));
            $tbl_pmvic->pmvic_name= htmlspecialchars(trim($_POST["pmvicName"]));
            $tbl_pmvic->pnvic_address= htmlspecialchars(trim($_POST["pmvicAddress"]));
            $tbl_pmvic->pmvic_ownner= htmlspecialchars(trim($_POST["pmvicOwner"]));
            $tbl_pmvic->pmvic_contact= htmlspecialchars(trim($_POST["pmvicContact"]));
            $tbl_pmvic->pmvic_status= htmlspecialchars(trim($_POST["pmvicStatus"]));
            $tbl_pmvic->pmciv_profile= $database64;
            $tbl_pmvic->date_operate= htmlspecialchars(trim($_POST["pmvicDateOperate"]));
            $tbl_pmvic->pmvic_desc= htmlspecialchars(trim($_POST["pmvicDesc"]));
    
            $result = $tbl_pmvic->UpdateCenter();

            echo json_encode($result);

        
    }
