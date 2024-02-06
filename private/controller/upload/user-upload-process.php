<?php
    include '../../initialize.php';

    session_start();
    $upload = new Upload();
    $result = $upload->getUpload();

    $output = array();
    $data = array();
    $filtered_rows = count($result);

       $count = 0;
   
    foreach($result as $row)
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
                            <a class="dropdown-item view-pmvic" data-id="'.$row['id'].'" 
                                ><i class="dw dw-eye"></i> View</a
                            >
                            <a class="dropdown-item re-upload"  data-id="'.$row['id'].'"
                                ><i class="dw dw-upload"></i> Re-upload</a
                            >
                            <a class="dropdown-item select-delete-pmvic"  data-id="'.$row['id'].'"
                                ><i class="dw dw-delete-3"></i> Delete</a
                            >
                        </div>
                    </div></td>';
        
        
        $sample = json_decode($row['EMISSIONS'], TRUE);
        

        $sub_array[] = ++$count;
        $sub_array[] = $row['PMVIC_CENTER'];
        $sub_array[] = $row['TRANSACTION_NO'];
        $sub_array[] = $row['MV_FILE'];
        $sub_array[] = $row['PLATE_NUM'];
        $sub_array[] = $row['CHASIS_NUM'];
        $sub_array[] = $row['ENGINE_NUM'];
        $sub_array[] = $row['STAGE_NO'];
        $sub_array[] = $row['INSPECTOR_USERNAME'];
        $sub_array[] = ($row['SUCCESS_LOG'] == 'SUCCESS') ? "SUCCESS" : "Not Uploaded";;
        $sub_array[] = ($sample['Status']['Status'] == 1) ? "PASSED" : "FAILED";
        $sub_array[] = $row['DATE_CREATED'];
        $sub_array[] = $Action;
       
        $data[] = $sub_array;
    }
    $output = array(
        "draw"              =>   intval($_POST["draw"]),
        "recordsTotal"      =>   $filtered_rows,
        "recordsFiltered"   =>   $upload->get_total_all_upload_records(),
        "data"              =>   $data
    );
    echo json_encode($output);

    
    

   

?>

        