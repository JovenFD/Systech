<?php

class Location
{

    public $pmvic_name;
    public $location;
    public $loc_id;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function getLocation()
    {

        $query = '';

        $query .= "SELECT * FROM tbl_location ";
        if (isset($_POST["search"]["value"])) {
            $query .= 'WHERE loc_id LIKE "%' . $_POST["search"]["value"] . '%" ';
            $query .= 'OR pmvic_name LIKE "%' . $_POST["search"]["value"] . '%" ';
            $query .= 'OR location LIKE "%' . $_POST["search"]["value"] . '%" ';
        }

        if (isset($_POST["order"])) {
            $query .= 'ORDER BY ' . $_POST['order']['0']['column'] . ' ' . $_POST['order']['0']['dir'] . ' ';
        } else {
            $query .= 'ORDER BY loc_id ASC ';
        }

        if ($_POST["length"] != -1) {
            $query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
        }

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $resultCenter = $stmt->fetchAll();

        return $resultCenter;
    }

    function get_total_all_center_records()
    {
        $query = "SELECT * FROM tbl_location";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->rowCount();
    }

    public function InsertLocation()
    {
        $data = [
            'pmvic_name' => $this->pmvic_name,
            'location'   => $this->location,
        ];
        $query = "INSERT INTO tbl_location(pmvic_name, location) 
                            VALUES(:pmvic_name, :location)";
        $stmt = $this->conn->prepare($query);
        $result = $stmt->execute($data);

        if ($result) {
            return $result;
        } else {
            return false;
        }
    }

    public function UpdateLocation(){

        $data = [
            'pmvic_name' => $this->pmvic_name,
            'location'   => $this->location,
            'loc_id'     => $this->loc_id
        ];
        $query = "UPDATE tbl_location SET pmvic_name=:pmvic_name, location=:location WHERE loc_id=:loc_id";
        $stmt = $this->conn->prepare($query);
        $result = $stmt->execute($data);

        if($result){
            return true;
        }else{
            return false;
        }
        
    }

    function fetchlocation($loc_id){
        $query = "SELECT * FROM tbl_location WHERE loc_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$loc_id]);
        $pmvic = $stmt->fetch();
            
        return $pmvic;
    }

    public function DeleteLocation(){
        $data = [
            'loc_id' => $this->loc_id,
        ];
        $query = "DELETE FROM tbl_location WHERE loc_id=:loc_id";
        $stmt = $this->conn->prepare($query);
        $result = $stmt->execute($data);

        if($result){
            return $result;
        }else{
            return false;
        }
    }
}
