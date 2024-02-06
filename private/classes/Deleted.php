<?php

class Deleted{

    public $id;

    public function __construct(){
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function getUpload(){

        $query = '';
        
        $query .= "SELECT * FROM tbl_dermalog ";
        if(isset($_POST["search"]["value"]))
        {
            $query .= 'WHERE 1 and (id LIKE "%'.$_POST["search"]["value"].'%" ';
            $query .= 'OR CHASIS_NUM LIKE "%'.$_POST["search"]["value"].'%" ';
            $query .= 'OR ENGINE_NUM LIKE "%'.$_POST["search"]["value"].'%" ';
            $query .= 'OR PMVIC_CENTER LIKE "%'.$_POST["search"]["value"].'%" ';
            $query .= 'OR INSPECTION_REF_NO LIKE "%'.$_POST["search"]["value"].'%" ';
            $query .= 'OR MV_FILE LIKE "%'.$_POST["search"]["value"].'%" ';
            $query .= 'OR PLATE_NUM LIKE "%'.$_POST["search"]["value"].'%" ';
            $query .= 'OR TRANSACTION_NO LIKE "%'.$_POST["search"]["value"].'%") ';
        } 

            $query .= 'and (isDeleted = 1) ';
        
        if(isset($_POST["order"]))
        {
            $query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
        }
        else
        {
            $query .= 'ORDER BY id ASC ';
        }
        
        
        if($_POST["length"] != -1)
        {
            $query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
        } 


        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $resultUpload = $stmt->fetchAll();

        $rowCount = $stmt->rowCount();

        return [
            'datafetch'   => $resultUpload,
            'recordsFiltered'    => $rowCount,
            'recordsTotal'=> $this->RecordsTotal()
        ];
    }

    function RecordsTotal()
    {
        $query = "SELECT * FROM tbl_dermalog WHERE isDeleted = 1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->rowCount();
    }
}