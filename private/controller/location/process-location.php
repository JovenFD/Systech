<?php
include '../../initialize.php';

$loc = new Location();
$result = $loc->getLocation();

$output = array();
$data = array();
$filtered_rows = count($result);

$count = 0;

foreach ($result as $row) {
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
                            class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                            <a class="dropdown-item fetch-pmvic"  data-id="' . $row['loc_id'] . '"
                                ><i class="dw dw-edit2"></i> Edit</a
                            >
                            <a class="dropdown-item select-delete-pmvic"  data-id="' . $row['loc_id'] . '"
                                ><i class="dw dw-delete-3"></i> Delete</a
                            >
                        </div>
                    </div></td>';

    $sub_array[] = $row['pmvic_name'];
    $sub_array[] = $row['location'];
    $sub_array[] = $row['date_update'];
    $sub_array[] = $Action;

    $data[] = $sub_array;
}
$output = array(
    "draw"              =>   intval($_POST["draw"]),
    "recordsTotal"      =>   $filtered_rows,
    "recordsFiltered"   =>   $loc->get_total_all_center_records(),
    "data"              =>   $data
);
echo json_encode($output);
