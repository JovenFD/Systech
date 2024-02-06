<?php

class Upload
{

    public $id;
    public $CHASIS_NUM;
    public $DATE_CREATED;
    public $ENGINE_NUM;
    public $BRANCH_ID;
    public $PMVIC_CENTER;
    public $ITP_CODE;
    public $INSPECTION_ID;
    public $INSPECTION_REF_NO;
    public $INSPECTOR_USERNAME;
    public $MODE;
    public $MV_FILE;
    public $PLATE_NUM;
    public $PURPOSE;
    public $QUEUE_ID;
    public $STAGE_NO;
    public $TRANSACTION_NO;
    public $VEHICLE_INFORMATION;
    public $BRAKES;
    public $DEFECTS;
    public $EMISSIONS;
    public $LIGHTS;
    public $NOISE;
    public $OPACITY;
    public $SIDESLIP;
    public $SPEEDOMETER;
    public $SUSPENSION;
    public $ERROR_LOG;
    public $SUCCESS_LOG;
    public $STATUS;
    public $OVERALL_EVALUATION;


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

    public function getUpload()
    {
        $searchQuery = $this->prepareSearchQuery();

        $query = "SELECT * FROM tbl_dermalog WHERE 1 $searchQuery AND isDeleted = 0 ";

        $query .= isset($_POST["order"]) ? $this->prepareOrderBy($_POST['order']) : 'ORDER BY id ASC ';

        $query .= $this->prepareLimit();

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $resultUpload = $stmt->fetchAll();

        return [
            'datafetch'       => $resultUpload,
            'recordsFiltered' => $this->RecordsUploadTotal(),
            'recordsTotal'    => $this->RecordsUploadTotal()
        ];
    }

    private function prepareSearchQuery()
    {
        $searchQuery = '';

        if (isset($_POST["search"]["value"])) {
            $searchValue = $_POST["search"]["value"];
            $columnsToSearch = ['id', 'CHASIS_NUM', 'ENGINE_NUM', 'PMVIC_CENTER', 'INSPECTION_REF_NO', 'MV_FILE', 'PLATE_NUM', 'TRANSACTION_NO'];

            $searchQuery .= 'AND (';

            foreach ($columnsToSearch as $column) {
                $searchQuery .= "$column LIKE '%$searchValue%' OR ";
            }

            $searchQuery = rtrim($searchQuery, 'OR ') . ')';
        }

        return $searchQuery;
    }

    private function prepareOrderBy($order)
    {
        return 'ORDER BY ' . $order['0']['column'] . ' ' . $order['0']['dir'] . ' ';
    }

    private function prepareLimit()
    {
        $limit = '';

        if (isset($_POST["length"]) && $_POST["length"] != -1 && isset($_POST["start"])) {
            $limit = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
        }

        return $limit;
    }

    private function RecordsUploadTotal()
    {
        $query = "SELECT * FROM tbl_dermalog WHERE isDeleted = 0";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->rowCount();
    }

    public function getTodayUpload()
    {
        $searchQuery = $this->prepareSearchQuery();

        $query = "SELECT * FROM tbl_dermalog WHERE 1 $searchQuery AND DATE(DATE_CREATED) = CURDATE() AND isDeleted = 0 ";

        //$query = "SELECT * FROM tbl_dermalog WHERE 1 $searchQuery AND DATE(DATE_CREATED) = '2023-09-28' AND isDeleted = 0 ";//testing porposes

        $query .= isset($_POST["order"]) ? $this->prepareOrderBy($_POST['order']) : 'ORDER BY id ASC ';
        $query .= $this->prepareLimit();

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        $resultUpload = $stmt->fetchAll();

        return [
            'datafetch'      => $resultUpload,
            'recordsFiltered' => $this->RecordsTodayTotal(),
            'recordsTotal'   => $this->RecordsTodayTotal()
        ];
    }

    public function RecordsTodayTotal()
    {
        $query = "SELECT * FROM tbl_dermalog WHERE isDeleted = 0 and DATE(DATE_CREATED) = CURDATE()";

        //$query = "SELECT * FROM tbl_dermalog WHERE isDeleted = 0 and DATE(DATE_CREATED) = '2023-09-28'";//testing porposes

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->rowCount();
    }

    public function fortMattJsonData($data)
    {
        $response = $this->getResponseHtml($data);
        $all = $this->getOverallEvaluationHtml($data);

        $tests = [
            'NOISE_TEST',
            'EMISSION_TEST',
            'OPACITY_TEST',
            'LIGHT_TEST',
            'SIDESLIP_TEST',
            'SPEED_TEST',
            'SUSPENSION_TEST',
            'BRAKES_TEST',
            'VISUAL_DEFECTS_FOUND'
        ];

        $formattedTests = [];
        foreach ($tests as $index => $test) {
            $formattedTests[$index] = $this->existDataHtml($test, $data);
        }

        return array_merge([$response, $all], $formattedTests);
    }

    private function getResponseHtml($data)
    {
        $response = isset($data['RESPONSE']) ? '<span class="text-success">' . $data['RESPONSE'] . '</span>' : '<span class="text-danger">No data</span>';
        return $response;
    }

    private function getOverallEvaluationHtml($data)
    {
        if (isset($data['OVERALL_EVALUATION'])) {
            return $data['OVERALL_EVALUATION'] == 0 ? '<span class="text-danger">FAILED</span>' : "<span class='text-success'>PASSED</span>";
        } else {
            return '<span class="text-danger">No data</span>';
        }
    }

    private function existDataHtml($param, $data)
    {
        $na = '<span class="text-danger">No data</span>';
        $ck = "<i class='icon-copy ion-checkmark-round text-success'></i>";
        $ek = "<i class='icon-copy ion-close-round text-danger'></i>";

        if (isset($data['PMVIC_TESTS'][$param])) {
            return $data['PMVIC_TESTS'][$param] == 0 ? $ek : $ck;
        } else {
            return $na;
        }
    }

    public function todayRecordsTotal()
    {
        $query = "SELECT * FROM tbl_dermalog WHERE DATE(DATE_CREATED) = DATE(CURDATE()) AND isDeleted = 0";
        return $this->executeRowCountQuery($query);
    }

    public function recordsTotal()
    {
        $query = "SELECT * FROM tbl_dermalog WHERE isDeleted = 0";
        return $this->executeRowCountQuery($query);
    }

    private function executeRowCountQuery($query)
    {
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->rowCount();
    }



    public function UpdateReUpload()
    {
        $data = [
            'PLATE_NUM'          => $this->PLATE_NUM,
            'MV_FILE'            => $this->MV_FILE,
            'OVERALL_EVALUATION' => $this->OVERALL_EVALUATION,
            'INSPECTION_REF_NO'  => $this->INSPECTION_REF_NO,
            'SUCCESS_LOG'        => $this->SUCCESS_LOG,
            'STATUS'             => 'OK',
            'id'                 => $this->id
        ];

        $query = "UPDATE tbl_dermalog SET 
        PLATE_NUM=:PLATE_NUM, 
        MV_FILE=:MV_FILE, 
        OVERALL_EVALUATION=:OVERALL_EVALUATION, 
        INSPECTION_REF_NO=:INSPECTION_REF_NO, 
        SUCCESS_LOG=:SUCCESS_LOG, STATUS=:STATUS WHERE id=:id";

        $stmt = $this->conn->prepare($query);
        $result = $stmt->execute($data);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    function get_total_all_upload_records()
    {
        $query = "SELECT * FROM tbl_dermalog";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->rowCount();
    }

    function fetchUpload($id)
    {
        $query = "SELECT * FROM tbl_dermalog WHERE  id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);
        $upload = $stmt->fetch();

        return $upload;
    }

    public function UpdateToDeleted()
    {
        $data = [

            'id'          => $this->id,
            'isDeleted'   => 1
        ];

        $query = "UPDATE tbl_dermalog SET 
        isDeleted=:isDeleted WHERE id=:id";

        $stmt = $this->conn->prepare($query);
        $result = $stmt->execute($data);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function UpdateToReplace()
    {
        $data = [
            'id'                 => $this->id,
            'isDeleted'   => 0
        ];

        $query = "UPDATE tbl_dermalog SET 
        isDeleted=:isDeleted WHERE id=:id";

        $stmt = $this->conn->prepare($query);
        $result = $stmt->execute($data);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    // for user side
    public function userGetUploads($pmvicName)
    {
        $searchQuery = $this->prepareSearchQuery();
        $dateFilter = 'AND DATE(DATE_CREATED) = DATE(CURDATE())';
        //$dateFilter = "AND DATE(DATE_CREATED) = '2023-09-28'"; //testing porposes
        $pmvicFilter = 'AND PMVIC_CENTER="' . $pmvicName . '"';
        $orderBy = isset($_POST["order"]) ? $this->prepareOrderBy($_POST['order']) : 'ORDER BY id ASC';
        $limit = isset($_POST["length"]) && $_POST["length"] != -1 && isset($_POST["start"]) ? 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'] : '';

        $query = "SELECT * FROM tbl_dermalog WHERE 1 $searchQuery AND isDeleted = 0 $dateFilter $pmvicFilter $orderBy $limit";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $resultUpload = $stmt->fetchAll();
        $rowCount = $stmt->rowCount();

        return [
            'datafetch'       => $resultUpload,
            'recordsFiltered' => $this->recordsTotalUserUploads($pmvicName),
            'recordsTotal'    => $this->recordsTotalUserUploads($pmvicName)
        ];
    }

    public function RecordsTotalUserUploads($pmvicName)
    {
        $query = "SELECT * FROM tbl_dermalog WHERE isDeleted = 0 and PMVIC_CENTER='$pmvicName' and (DATE(DATE_CREATED) = DATE(CURDATE()))";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->rowCount();
    }


    public function All_Upload_Today($pmvic_Name)
    {
        $query = "SELECT *
        FROM tbl_dermalog
        WHERE PMVIC_CENTER = '$pmvic_Name' AND SUCCESS_LOG ='SUCCESS' ";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->rowCount();
    }

    public function Upload_Today($pmvic_Name)
    {
        $query = "SELECT *
        FROM tbl_dermalog
        WHERE DATE(DATE_CREATED) = DATE(CURDATE()) AND PMVIC_CENTER = '$pmvic_Name' AND SUCCESS_LOG ='SUCCESS'";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->rowCount();
    }
}
