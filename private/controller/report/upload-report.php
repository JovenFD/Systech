<?php
    include '../../initialize.php';

    if($_SERVER['REQUEST_METHOD'] == "POST") {
        
        $tbl_invoice = new Report();
        $tbl_invoice->start_date    = date('Y-m-d', strtotime($_POST['startdate']));
        $tbl_invoice->end_date      = date('Y-m-d', strtotime($_POST['enddate']));
        $tbl_invoice->select_pmvic  = $_POST['selectPmvic'];

       $tbl_invoice->getReport();
    }