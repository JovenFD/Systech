<?php

    class User{

        public $user_id;
        public $pmvic_name;
        public $username;
        public $password;
        public $role;
        public $status;
        public $userProfile;

        public function __construct(){
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

        public function InsertUser(){
            $data = [
                'pmvic_name' => $this->pmvic_name,
                'username' => $this->username,
                'password' => $this->password,
                'role' => $this->role,
                'status' => $this->status,
                'userProfile' => $this->userProfile
            ];
            $query = "INSERT INTO tbl_users(pmvic_name, username, password, role, status, userProfile) 
                                VALUES(:pmvic_name, :username, :password, :role, :status, :userProfile)";
            $stmt = $this->conn->prepare($query);
            $result = $stmt->execute($data);

            
            if($result){
                return $result;
            }else{
                return false;
            }
        }

        public function UpdateUser(){
            $data = [
                'user_id' => $this->user_id,
                'pmvic_name' => $this->pmvic_name,
                'username' => $this->username,
                'password' => $this->password,
                'role' => $this->role,
                'status' => $this->status
            ];
            $query = "UPDATE tbl_users SET pmvic_name=:pmvic_name, username=:username, password=:password, role=:role, 
                                     status=:status WHERE user_id=:user_id";
            $stmt = $this->conn->prepare($query);
            $result = $stmt->execute($data);

            
            if($result){
                return $result;
            }else{
                return false;
            }
        }

        function fetchUser($user_id){
            $query = "SELECT * FROM tbl_users WHERE  user_id = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([$user_id]);
            $user = $stmt->fetch();
                
            return $user;
        }

        public function getUser(){

            $query = '';
            
            $query .= "SELECT * FROM tbl_users ";
            if(isset($_POST["search"]["value"]))
            {
                $query .= 'WHERE user_id LIKE "%'.$_POST["search"]["value"].'%" ';
                $query .= 'OR pmvic_name LIKE "%'.$_POST["search"]["value"].'%" ';
                $query .= 'OR username LIKE "%'.$_POST["search"]["value"].'%" ';
                $query .= 'OR role LIKE "%'.$_POST["search"]["value"].'%" ';
            } 
            
            if(isset($_POST["order"]))
            {
                $query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
            }
            else
            {
                $query .= 'ORDER BY user_id ASC ';
            }
            
            if($_POST["length"] != -1)
            {
                $query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
            } 


            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            $resultUser = $stmt->fetchAll();

            return $resultUser;
            
        }


        function get_total_all_user_records()
        {
            $query = "SELECT * FROM tbl_users";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt->rowCount();
        }

        function fetchpmvic($user_id){
            $query = "SELECT * FROM tbl_users WHERE  user_id = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([$user_id]);
            $user = $stmt->fetch();
                
            return $user;
        }

        public function DeleteUser(){
            $data = [
                'user_id' => $this->user_id,
            ];
            $query = "DELETE FROM tbl_users WHERE user_id= :user_id";
            $stmt = $this->conn->prepare($query);
            $result = $stmt->execute($data);

            if($result){
                return $result;
            }else{
                return false;
            }
        }

    }