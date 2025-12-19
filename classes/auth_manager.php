<?php
require_once 'sqlite_helper.php';

class AuthManager{
    private $db;


    public function __construct(){
        try {
            $this->db = new SQLiteManager('users.db');
        } catch (Exception $e) {
             "error: " . $e->getMessage();
        }
    }


    public function login($user, $password): bool{
        $dbdata = $this->db->selectWhere('users', ['user' => $user]);
        if (password_verify($password, $dbdata[0]['password'])){
            session_start();
            $_SESSION['user_id'] = $dbdata[0]['ID'];
            $_SESSION['user_name'] = $dbdata[0]['user'];
            $_SESSION['user_group'] = $dbdata[0]['user_group'];
            return true;
        } else {
            return false;
        }
    }


    public function logout(){
        session_start();
        session_destroy();
    }


    public function is_loggedin(): bool{
        session_start();
        if (isset($_SESSION['user_id'])) {
            return true;
        } else {
            return false;
        }
    }


    public function get_user(){
        session_start();
    
    }
}

?>
