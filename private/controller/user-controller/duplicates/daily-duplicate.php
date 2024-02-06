<?php
include '../../../initialize.php';
session_start();
$upload = new Duplicates();
$result = $upload->getDailyDuplicatesUser($_SESSION['userdata']['pmvicName']);

$output = array();
$data = array();

foreach ($result['datafetch'] as $row) {
    $sub_array = array();

    $Action = '<a class="dropdown-item fetch-deleted" style="color:#e95959; cursor: pointer;"  data-id="' . $row['id'] . '"><i class="icon-copy dw dw-delete-3"></i></a>';

    $sample = json_decode($row['EMISSIONS'], TRUE);

    $sub_array[] = $upload->limitWordsPmvicName($row['PMVIC_CENTER']);;
    $sub_array[] = $row['TRANSACTION_NO'];
    $sub_array[] = $row['MV_FILE'];
    $sub_array[] = $row['PLATE_NUM'];
    $sub_array[] = $row['CHASIS_NUM'];
    $sub_array[] = $row['ENGINE_NUM'];

    $sub_array[] = ($row['SUCCESS_LOG'] == 'SUCCESS') ? "SUCCESS" : "Not Uploaded";;
    $sub_array[] = ($sample['Status']['Status'] == 1) ? "PASSED" : "FAILED";
    $sub_array[] = date('m/d/Y', strtotime($row['DATE_CREATED']));
    $sub_array[] = $Action;

    $data[] = $sub_array;
}

$output = array(
    "draw"              =>   intval($_POST["draw"]),
    "recordsTotal"      =>   $result['recordsTotal'],
    "recordsFiltered"   =>   $result['rowCount'],
    "data"              =>   $data
);

echo json_encode($output);
