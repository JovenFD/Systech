<?php
include '../../initialize.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $tbl_upload = new Upload();


    // $Inspection_ID  = $_POST['Inspection_ID'];
    // $engine_no      = $_POST['Engine'];
    // $chasis_no      = $_POST['Chassis'];
    // $plate_no       = $_POST['License_Plate'];
    // $mv             = $_POST['MV_File_No'];
    // $fuel           = $_POST['Fuel_Type'];
    // $HCidle         = $_POST['emission_hc'];
    // $COidle         = $_POST['emission_co']; 
    // $k              = $_POST['opacity_k'];
    // $category       = $_POST['opacity_k'];
    // $inspector_name = $_POST['opacity_k'];



    $tbl_upload->id        = htmlspecialchars(trim($_POST["id-upload"]));
    $tbl_upload->PLATE_NUM = htmlspecialchars(trim($_POST["plate-upload"]));
    $tbl_upload->PLATE_NUM = htmlspecialchars(trim($_POST["plate-upload"]));



}
