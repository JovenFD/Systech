<?php

class Duplicates
{

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

    public function getAllDuplicates()
    {
        $query = '';
        $query .= 'SELECT t1.* , t1.ENGINE_NUM, t1.INSPECTION_REF_NO, t1.PLATE_NUM
                        FROM tbl_dermalog t1
                        JOIN (
                            SELECT MV_FILE, COUNT(*) AS count
                            FROM tbl_dermalog
                            WHERE isDeleted = 0
                            GROUP BY MV_FILE
                            HAVING COUNT(*) > 1
                        ) t2 ON t1.MV_FILE = t2.MV_FILE ';

        if (isset($_POST["search"]["value"])) {
            $query .= ' WHERE t1.MV_FILE LIKE "%' . $_POST["search"]["value"] . '%" ';
            $query .= 'OR t1.ENGINE_NUM LIKE "%' . $_POST["search"]["value"] . '%" ';
            $query .= 'OR t1.INSPECTION_REF_NO LIKE "%' . $_POST["search"]["value"] . '%" ';
            $query .= 'OR t1.PLATE_NUM LIKE "%' . $_POST["search"]["value"] . '%" ';
        }


        if (isset($_POST["order"])) {
            $query .= 'ORDER BY ' . $_POST['order']['0']['column'] . ' ' . $_POST['order']['0']['dir'] . ' ';
        } else {
            $query .= 'ORDER BY id ASC ';
        }

        if ($_POST["length"] != -1) {
            $query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
        }

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $resultCenter = $stmt->fetchAll();
        $rowCount = $stmt->rowCount();

        return [
            'datafetch' => $resultCenter,
            'rowCount'  => $rowCount
        ];
    }

    function get_total_alltime_records()
    {
        $query = "SELECT t1.* 
                    FROM tbl_dermalog t1
                    JOIN (
                        SELECT MV_FILE, COUNT(*) AS count
                        FROM tbl_dermalog
                        WHERE isDeleted = 0
                        GROUP BY MV_FILE
                        HAVING COUNT(*) > 1
                    ) t2 ON t1.MV_FILE = t2.MV_FILE";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->rowCount();
    }

    public function getDailyDuplicates()
    {
        $query = '';
        $query .= 'SELECT t1.* , t1.ENGINE_NUM, t1.INSPECTION_REF_NO, t1.PLATE_NUM
                        FROM tbl_dermalog t1
                        JOIN (
                            SELECT MV_FILE, COUNT(*) AS count
                            FROM tbl_dermalog
                            WHERE DATE(DATE_CREATED) = DATE(CURDATE()) AND isDeleted = 0
                            GROUP BY MV_FILE
                            HAVING COUNT(*) > 1
                        ) t2 ON t1.MV_FILE = t2.MV_FILE ';

        if (isset($_POST["search"]["value"])) {
            $query .= ' WHERE t1.MV_FILE LIKE "%' . $_POST["search"]["value"] . '%" ';
            $query .= 'OR t1.ENGINE_NUM LIKE "%' . $_POST["search"]["value"] . '%" ';
            $query .= 'OR t1.INSPECTION_REF_NO LIKE "%' . $_POST["search"]["value"] . '%" ';
            $query .= 'OR t1.PLATE_NUM LIKE "%' . $_POST["search"]["value"] . '%" ';
        }

        if (isset($_POST["order"])) {
            $query .= 'ORDER BY ' . $_POST['order']['0']['column'] . ' ' . $_POST['order']['0']['dir'] . ' ';
        } else {
            $query .= 'ORDER BY id ASC ';
        }

        if ($_POST["length"] != -1) {
            $query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
        }

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $resultCenter = $stmt->fetchAll();
        $rowCount = $stmt->rowCount();

        return [
            'datafetch'    => $resultCenter,
            'rowCount'     => $rowCount,
            'recordsTotal' => $this->todayDuplicateRecord()
        ];
    }

    function todayDuplicateRecord()
    {
        $query = 'SELECT MV_FILE, isDeleted, COUNT(*) as count
                    FROM tbl_dermalog
                    WHERE DATE(DATE_CREATED) = DATE(CURDATE()) AND  isDeleted = 0
                    GROUP BY MV_FILE, isDeleted
                    HAVING COUNT(*) > 1';
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->rowCount();
    }

    public function getDailyDuplicatesUser($pmvicName)
    {
        $query = '';
        $query .= 'SELECT t1.* , t1.ENGINE_NUM, t1.INSPECTION_REF_NO, t1.PLATE_NUM
                        FROM tbl_dermalog t1
                        JOIN (
                            SELECT MV_FILE, COUNT(*) AS count
                            FROM tbl_dermalog
                            WHERE DATE(DATE_CREATED) = DATE(CURDATE()) AND isDeleted = 0 AND PMVIC_CENTER="' . $pmvicName . '"
                            GROUP BY MV_FILE
                            HAVING COUNT(*) > 1
                        ) t2 ON t1.MV_FILE = t2.MV_FILE ';

        if (isset($_POST["search"]["value"])) {
            $query .= ' WHERE t1.MV_FILE LIKE "%' . $_POST["search"]["value"] . '%" ';
            $query .= 'OR t1.ENGINE_NUM LIKE "%' . $_POST["search"]["value"] . '%" ';
            $query .= 'OR t1.INSPECTION_REF_NO LIKE "%' . $_POST["search"]["value"] . '%" ';
            $query .= 'OR t1.PLATE_NUM LIKE "%' . $_POST["search"]["value"] . '%" ';
        }

        if (isset($_POST["order"])) {
            $query .= 'ORDER BY ' . $_POST['order']['0']['column'] . ' ' . $_POST['order']['0']['dir'] . ' ';
        } else {
            $query .= 'ORDER BY id ASC ';
        }

        if ($_POST["length"] != -1) {
            $query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
        }

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $resultCenter = $stmt->fetchAll();
        $rowCount = $stmt->rowCount();

        return [
            'datafetch'    => $resultCenter,
            'rowCount'     => $rowCount,
            'recordsTotal' => $this->todayDuplicateRecordUser($pmvicName)
        ];
    }

    function todayDuplicateRecordUser($pmvicName)
    {
        $query = 'SELECT MV_FILE, isDeleted, COUNT(*) as count
                    FROM tbl_dermalog
                    WHERE DATE(DATE_CREATED) = DATE(CURDATE()) AND  isDeleted = 0 AND PMVIC_CENTER="' . $pmvicName . '"
                    GROUP BY MV_FILE, isDeleted
                    HAVING COUNT(*) > 1';
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->rowCount();
    }
}
