<?php
    include '../../initialize.php';
    session_start();
    $deleted = new Deleted();
    $result = $deleted->getUpload();
    
    $output = array();
    $data = array();
 
   
    foreach($result['datafetch'] as $row)
    {
        $sub_array = array();

        $Action = '<td><div class="dropdown">
                        <a
                            class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
                            href="#"
                            role="button"
                            data-toggle="dropdown"
                        >
                            <i class="dw dw-more"></i>
                        </a>
                        <div
                            class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list"
                        >
                            <a class="dropdown-item fetch-deleted"  data-id="'.$row['id'].'"
                                ><i class="dw dw-upload"></i> Replace</a
                            >
                        </div>
                    </div></td>';

    $getEmission = "";
    $emissionRes = "";
    $getEmission = json_decode($row['EMISSIONS'], TRUE);
    $emissionRes = isset($getEmission['Status']['Status']) ? $getEmission['Status']['Status'] : " ";

            $sub_array[] = 'romel';
            $sub_array[] = '10/09/2023'; 
            $sub_array[] = $row['PMVIC_CENTER'];
            $sub_array[] = $row['TRANSACTION_NO'];
            $sub_array[] = $row['MV_FILE'];
            $sub_array[] = $row['PLATE_NUM'];
            $sub_array[] = $row['INSPECTOR_USERNAME'];
            $sub_array[] = ($row['SUCCESS_LOG'] == 'SUCCESS') ? "SUCCESS" : "Not Uploaded";
            $sub_array[] = ($emissionRes == 1) ? "PASSED" : "FAILED";
            $sub_array[] = date('m/d/Y h:i', strtotime($row['DATE_CREATED']));
            $sub_array[] = $Action;

       
        $data[] = $sub_array;
    }
    $output = array(
        "draw"              =>   intval($_POST["draw"]),
        "recordsTotal"      =>   $result['recordsTotal'],
        "recordsFiltered"   =>   $result['recordsFiltered'],
        "data"              =>   $data
    );
    echo json_encode($output);