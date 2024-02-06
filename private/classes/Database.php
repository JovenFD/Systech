<?php
    //session_start();
    //error_reporting(1);
    class Database {
        public $host;
        public $name;
        public $user;
        public $passsword;
        public $port;

        private $conn;

        public function __construct()
        {
            $this->host = DB_HOST;
            $this->name = DB_NAME;
            $this->user = DB_USER;
            $this->password = DB_PASS;
            $this->port=DB_PORT;

            $dns = 'mysql:host='. $this->host . ';port='.$this->port.';dbname=' . $this->name;

            try {
                $this->conn = new PDO($dns, $this->user, $this->password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
                //echo "conected";
            } catch (PDOExeption $e) {
                die('An Error occured : ' . $e->getMessage());
            }
        }

        public function getConnection(){
            return $this->conn;
        }
    }

?>