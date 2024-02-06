<?php

class Report
{
    public $start_date;
    public $end_date;
    public $select_pmvic;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function  getReport()
    {
        $params = [
            'select_pmvic' => $this->select_pmvic,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date
        ];

        $query = "SELECT * FROM tbl_dermalog
                    WHERE PMVIC_CENTER = :select_pmvic AND DATE_CREATED >= :start_date AND DATE_CREATED <= :end_date AND isDeleted = 0";

        $stmt = $this->conn->prepare($query);
        $stmt->execute($params);
        $result   = $stmt->fetchAll();
        $countRow = $stmt->rowCount();

        echo json_encode([
            'data'            => $result,
            'rowCount'        => $countRow,
            'dataDuplicates'  => $this->countRecord($this->select_pmvic,$this->start_date, $this->end_date)
        ]); 
    }

    function countRecord($select_pmvic,$start_date, $end_date)
    {
        $params = [
            'select_pmvic' => $select_pmvic,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'isDeleted'=> 0
        ];
        // SELECT  MV_FILE, COUNT(MV_FILE) AS TOTAL 
        //             FROM tbl_dermalog
        //             WHERE 
        //             GROUP BY MV_FILE
        //             HAVING MV_FILE > 1
      
        $query = 'SELECT MV_FILE, isDeleted, COUNT(*) as count
                        FROM tbl_dermalog
                        WHERE PMVIC_CENTER = :select_pmvic AND DATE_CREATED >= :start_date AND DATE_CREATED <= :end_date AND isDeleted = :isDeleted
                        GROUP BY MV_FILE, isDeleted
                        HAVING COUNT(*) > 1';
        $stmt = $this->conn->prepare($query);
        $stmt->execute($params);
        return $stmt->rowCount();
    }
}
