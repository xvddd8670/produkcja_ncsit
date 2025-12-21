<?php
class ManagerPage{
    private $session;

    public function __construct($session){
        #$this->session = $session;
    }

    public function render(){
        include $_SERVER['DOCUMENT_ROOT'] . '/templates/manager/new_order.php';
        include $_SERVER['DOCUMENT_ROOT'] . '/templates/show_by_status.php';
        include $_SERVER['DOCUMENT_ROOT'] . '/templates/show_by_stage.php';
    }
}

?>
