<?php

class Invoice
{
    public $start_date;
    public $end_date;
    public $select_pmvic;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function  getInvoice()
    {
        $data = [
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'pmvic_name'   => $this->select_pmvic,
        ];

        $sql = "SELECT DATE(r.`DATE_CREATED`) AS date, COUNT(*) AS count, p.price, SUM(p.price) AS total_price
            FROM tbl_dermalog r
            JOIN tbl_pmvic p ON r.PMVIC_CENTER = p.pmvic_name
            WHERE DATE(r.DATE_CREATED) >= :start_date AND DATE(r.DATE_CREATED) <= :end_date AND r.PMVIC_CENTER = :pmvic_name AND r.isDeleted = 0
            GROUP BY DATE(r.`DATE_CREATED`), p.price";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute($data);
        $result = $stmt->fetchAll();

        return $result;
    }
}


// SELECT t1.pmvic_name, t1.upload_rate, COUNT(t2.PMVIC_CENTER) AS data_count, SUM(t2.PMVIC_CENTER) AS data_sum
// FROM tbl_users t1
// JOIN tbl_dermalog t2 ON t1.pmvic_name = t2.PMVIC_CENTER
// WHERE t2.DATE_CREATED BETWEEN '2023-10-08' AND '2023-10-08'
// GROUP BY t1.pmvic_name, t1.upload_rate;


// SELECT t1.pmvic_name, t1.upload_rate, COUNT(t2.PMVIC_CENTER) AS data_count, SUM(t2.PMVIC_CENTER) AS data_sum
// FROM tbl_users t1
// JOIN tbl_dermalog t2 ON t1.pmvic_name = t2.PMVIC_CENTER
// GROUP BY t1.pmvic_name, t1.upload_rate;