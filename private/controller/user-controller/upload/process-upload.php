<?php
include '../../../initialize.php';
session_start();
$upload = new Upload();
$result = $upload->userGetUploads($_SESSION['userdata']['pmvicName']);

$output = [];
$data   = [];

foreach ($result['datafetch'] as $row) {
    $sub_array = [];

    $allResult = json_decode($row['OVERALL_EVALUATION'], TRUE);
    $encodedData = htmlspecialchars(json_encode($upload->fortMattJsonData($allResult)));
    $Action = "<td class='remove-colspan'><button class='dropdown-item btn-result-today' data-plateno='$row[PLATE_NUM]' data-json='$encodedData'><i class='dw dw-eye mr-2'></i></button></td>";

    $getEmission = "";
    $emissionRes = "";
    $getEmission = json_decode($row['EMISSIONS'], TRUE);
    $emissionRes = isset($getEmission['Status']['Status']) ? $getEmission['Status']['Status'] : " ";

    $sub_array[] = $Action;
    $sub_array[] = $upload->limitWordsPmvicName($row['PMVIC_CENTER']);
    $sub_array[] = $row['TRANSACTION_NO'];
    $sub_array[] = $row['MV_FILE'];
    $sub_array[] = $row['PLATE_NUM'];
    $sub_array[] = $row['CHASIS_NUM'];
    $sub_array[] = $row['ENGINE_NUM'];
    $sub_array[] = $row['STAGE_NO'];
    $sub_array[] = $row['INSPECTOR_USERNAME'];
    $sub_array[] = ($row['SUCCESS_LOG'] == 'SUCCESS') ? "<span class='badge badge-success'>SUCCESS</span>" : "Not Uploaded";



    $sub_array[] = ($emissionRes == 1) ? "PASSED" : "FAILED";
    $sub_array[] = date('m/d/Y', strtotime($row['DATE_CREATED']));


    $data[] = $sub_array;
}
$output = [
    "draw" => isset($_POST["draw"]) ? intval($_POST["draw"]) : null,
    "recordsTotal"      =>   $result['recordsTotal'],
    "recordsFiltered"   =>   $result['recordsFiltered'],
    "data"              =>   $data
];

echo json_encode($output);
