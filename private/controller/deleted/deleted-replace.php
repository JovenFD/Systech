<?php
include '../../initialize.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $tbl_upload = new Upload();


    $tbl_upload->id = $_POST["id-deleted"];

    $result = $tbl_upload->UpdateToReplace();
        
    echo json_encode($result);




}

