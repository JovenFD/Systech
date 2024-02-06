<?php
include '../../initialize.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $tbl_pmvic = new Location();
    $tbl_pmvic->loc_id = htmlspecialchars(trim($_POST["delete_id"]));

    $result = $tbl_pmvic->DeleteLocation();

    echo json_encode($result);
}
