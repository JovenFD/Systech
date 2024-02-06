<?php
    include '../../initialize.php';

    $center = new Center();
    $result = $center->getCenter();

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
                            <a class="dropdown-item view-pmvic" data-id="'.$row['pmvic_id'].'" 
                                ><i class="dw dw-eye"></i> View</a
                            >
                            <a class="dropdown-item fetch-pmvic"  data-id="'.$row['pmvic_id'].'"
                                ><i class="dw dw-edit2"></i> Edit</a
                            >
                            <a class="dropdown-item select-delete-pmvic"  data-id="'.$row['pmvic_id'].'"
                                ><i class="dw dw-delete-3"></i> Delete</a
                            >
                        </div>
                    </div></td>';
        
       

        if($row['pmvic_profile'] != ""){
            $profile = '<img src="data:image;base64, ' .$row['pmvic_profile']. ' " style="width:45px;height:45px; border-radius:20px;">';
        }else{
            $profile = '<img src="../../backend/img/no-image.png" style="width:45px;height:45px; border-radius:20px;">';
        }
        $sub_array[] = ++$count;
        
        $sub_array[] = $profile;
        $sub_array[] = $center->limitWordsPmvicName($row['pmvic_name']);
        $sub_array[] = $row['pmvic_address'];
        $sub_array[] = $row['pmvic_owner'];
        $sub_array[] = $row['pmvic_contact'];
        $sub_array[] = $row['pmvic_status'];
        $sub_array[] = $row['date_operate'];
        $sub_array[] = $row['date_created'];
        $sub_array[] = $Action;
       
        $data[] = $sub_array;
    }
    $output = array(
        "draw"              =>   intval($_POST["draw"]),
        "recordsTotal"      =>   $filtered_rows,
        "recordsFiltered"   =>   $center->get_total_all_center_records(),
        "data"              =>   $data
    );
    echo json_encode($output);

?>

        