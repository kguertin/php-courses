<?php

class Session {
    private $signed_in = false;
    public $user_id;

    function _construct(){
        session_start();
        $this->check_login();
    }

    public function is_signed_in(){
        return $this->signed_in;
    }
    
    public function log_in($user){
        if($user){
            $this->user_id = $_SESSION['user_id'] = $user->id;
            $this->signed_in = true;
        }
    }

    private function check_login(){
        if(isset($_SESSION['user_id'])){
            $this->user_id = $_SESSION['user_id'];
            $this->signed_in = true;
        } else {
            unset($this->user_id);
            $this->signed_in = false;
        }
    }

    public function log_out($user){
        unset($_SESSION['user_id']);
        unset($this->user_id);
        $this->signed_in = false; 
    }

}
$session = new Session();