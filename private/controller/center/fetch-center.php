<?php
    include '../../initialize.php';

    if($_SERVER['REQUEST_METHOD'] == "POST") {
        
        $tbl_pmvic = new Center();
        $get_pmvic_id = $tbl_pmvic->fetchpmvic($_POST['edit_id']);
        
        echo json_encode($get_pmvic_id);
    }