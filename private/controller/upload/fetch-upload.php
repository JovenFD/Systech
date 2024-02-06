<?php
    include '../../initialize.php';

    if($_SERVER['REQUEST_METHOD'] == "POST") {
        
        $tbl_upload = new Upload();
        $get_upload_id = $tbl_upload->fetchUpload($_POST['reupload_id']);
        
        echo json_encode($get_upload_id);
    }