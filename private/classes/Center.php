<?php

class Center
{

    public $pmvic_id;
    public $pmvic_name;
    public $pmvic_description;
    public $pnvic_address;
    public $pmvic_ownner;
    public $pmvic_contact;
    public $pmvic_status;
    public $pmciv_profile;
    public $date_operate;
    public $pmvic_desc;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function limitWordsPmvicName($inputString, $charLimit = 4, $ellipsis = '...')
    {
        if (mb_strlen($inputString) <= $charLimit) {
            return $inputString;
        } else {
            $limitedString = mb_substr($inputString, 0, $charLimit);

            return $limitedString . $ellipsis;
        }
    }

    public function InsertCenter()
    {
        $data = [
            'pmvic_name'       => $this->pmvic_name,
            'pmvic_desc'       => $this->pmvic_description,
            'pmvic_address'    => $this->pnvic_address,
            'pmvic_owner'      => $this->pmvic_ownner,
            'pmvic_contact'    => $this->pmvic_contact,
            'pmvic_status'     => $this->pmvic_status,
            'pmvic_profile'    => $this->pmciv_profile,
            'date_operate'     => $this->date_operate,
            'pmvic_access'     => 0
        ];

        $query = "INSERT INTO tbl_pmvic(pmvic_name, pmvic_desc, pmvic_address, pmvic_owner, pmvic_contact, pmvic_status, pmvic_profile, date_operate, pmvic_access) 
                                VALUES(:pmvic_name, :pmvic_desc, :pmvic_address, :pmvic_owner, :pmvic_contact, :pmvic_status, :pmvic_profile, :date_operate, :pmvic_access)";
        $stmt = $this->conn->prepare($query);
        $result = $stmt->execute($data);


        if ($result) {
            return $result;
        } else {
            return false;
        }
    }

    public function UpdateCenter()
    {

        $data = [
            'pmvic_id' => $this->pmvic_id,
            'pmvic_name' => $this->pmvic_name,
            'pmvic_address' => $this->pnvic_address,
            'pmvic_owner'   => $this->pmvic_ownner,
            'pmvic_contact' => $this->pmvic_contact,
            'pmvic_status' => $this->pmvic_status,
            'pmvic_profile' => $this->pmciv_profile,
            'date_operate' => $this->date_operate,
            'pmvic_desc' => $this->pmvic_desc
        ];

        $query = "UPDATE tbl_pmvic SET pmvic_name=:pmvic_name, pmvic_address=:pmvic_address, pmvic_owner=:pmvic_owner, pmvic_contact=:pmvic_contact, 
                                            pmvic_status=:pmvic_status, pmvic_profile=:pmvic_profile, date_operate=:date_operate, pmvic_desc=:pmvic_desc
                                            WHERE pmvic_id=:pmvic_id";
        $stmt = $this->conn->prepare($query);
        $result = $stmt->execute($data);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function DeleteCenter()
    {
        $data = [
            'pmvic_id' => $this->pmvic_id,
        ];
        $query = "DELETE FROM tbl_pmvic WHERE pmvic_id= :pmvic_id";
        $stmt = $this->conn->prepare($query);
        $result = $stmt->execute($data);

        if ($result) {
            return $result;
        } else {
            return false;
        }
    }

    public function getCenter()
    {

        $query = '';

        $query .= "SELECT * FROM tbl_pmvic ";
        if (isset($_POST["search"]["value"])) {
            $query .= 'WHERE pmvic_id LIKE "%' . $_POST["search"]["value"] . '%" ';
            $query .= 'OR pmvic_name LIKE "%' . $_POST["search"]["value"] . '%" ';
            $query .= 'OR pmvic_address LIKE "%' . $_POST["search"]["value"] . '%" ';
            $query .= 'OR pmvic_owner LIKE "%' . $_POST["search"]["value"] . '%" ';
        }

        if (isset($_POST["order"])) {
            $query .= 'ORDER BY ' . $_POST['order']['0']['column'] . ' ' . $_POST['order']['0']['dir'] . ' ';
        } else {
            $query .= 'ORDER BY pmvic_id ASC ';
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
        $query = "SELECT * FROM tbl_pmvic";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->rowCount();
    }

    function get_Center_Name()
    {
        $query = "SELECT * FROM tbl_pmvic WHERE pmvic_role=0";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $resultName = $stmt->fetchAll();

        return $resultName;
    }

    function fetchpmvic($pmvic_id)
    {
        $query = "SELECT * FROM tbl_pmvic WHERE  pmvic_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$pmvic_id]);
        $pmvic = $stmt->fetch();

        return $pmvic;
    }
}
