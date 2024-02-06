<?php
include '../../initialize.php';

$user = new User();
$result = $user->getUser();

$output = array();
$data = array();
$filtered_rows = count($result);
$i = 1;
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
                            class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list"
                        >
                            <a class="dropdown-item view-user" data-id="' . $row['user_id'] . '" 
                                ><i class="dw dw-eye"></i> View</a
                            >
                            <a class="dropdown-item fetch-user"  data-id="' . $row['user_id'] . '"
                                ><i class="dw dw-edit2"></i> Edit</a
                            >
                            <a class="dropdown-item select-delete-user"  data-id="' . $row['user_id'] . '"
                                ><i class="dw dw-delete-3"></i> Delete</a
                            >
                        </div>
                    </div></td>';


    $sub_array[] = ++$count;
    $sub_array[] = $user->limitWordsPmvicName($row['pmvic_name']);
    $sub_array[] = $row['username'];
    $sub_array[] = $row['password'];
    $sub_array[] = $row['role'];
    $sub_array[] = $row['status'];
    $sub_array[] = $row['dateUpdate'];
    $sub_array[] = $Action;

    $data[] = $sub_array;
    $i++;
}
$output = array(
    "draw"              =>   intval($_POST["draw"]),
    "recordsTotal"      =>   $filtered_rows,
    "recordsFiltered"   =>   $user->get_total_all_user_records(),
    "data"              =>   $data
);
echo json_encode($output);
