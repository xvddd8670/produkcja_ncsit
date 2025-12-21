<?php
class AdminPage{
    private $session;

    public function __construct($session){
        #$this->session = $session;
    }

    public function render(){
        include $_SERVER['DOCUMENT_ROOT'] . '/templates/admin/create_user.php';
    }
}

?>
