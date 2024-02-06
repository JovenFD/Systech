<?php
    //session_start();
    class Login{
        public $username;
        public $password;
        private $conn;

        public function __construct(){
            $db = new Database();
            $this->conn = $db->getConnection();
        }

        public function getUsers($username,$password){
            

            $query = "SELECT * FROM tbl_users WHERE username = :username AND password = :password";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([
                'username' => $username, 
                'password' => $password
            ]);
            $user  = $stmt->fetch();
            $total = $stmt->rowCount();

            if($total > 0){
                if($user['status']=='INACTIVE') {
                    return 0;
                    die();
                }
                
                return $this->set_userdata($user);

            } else {
                return 0;
            }
        }

        public function set_userdata($array){
            if(!isset($_SESSION)){
                session_start();
            }
            $_SESSION['userdata'] = array(
                "id"       => $array['user_id'],
                "pmvicName" => $array['pmvic_name'],
                "access"   => $array['role'],
                "username" => $array['username'],
                "pmvicImage" => $array['userProfile']
            );

            return $_SESSION['userdata'];
        }

        public function get_userdata(){
            if(!isset($_SESSION)){
                session_start();
            }

            if(isset($_SESSION['userdata'])){
                return $_SESSION['userdata'];
            }else{
                return null;
            }

            
        }

        public function logout(){
            if(!isset($_SESSION)){
                session_start();
            }

            $_SESSION['userdata'] = null;
            unset($_SESSION['userdata']);
            header("Refresh:0");


        }

        

    }
?>