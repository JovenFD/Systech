<?php
    include '../../initialize.php';

    if($_SERVER['REQUEST_METHOD'] == "POST") {
        
        $tbl_location = new Location();
        $tbl_location->pmvic_name  = htmlspecialchars(trim($_POST["pmvicName"]));
        $tbl_location->location    = htmlspecialchars(trim($_POST["pmvicLocation"]));
        
        if(isset($_POST['loc_id'])
        ) {
            $tbl_location->loc_id  = htmlspecialchars(trim($_POST["loc_id"]));

            $result = $tbl_location->UpdateLocation();
        } else {
            $result = $tbl_location->InsertLocation();
        }

        echo json_encode($result);
    }
