<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/user_pages/admin_page.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/user_pages/manager_page.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/user_pages/worker_page.php';

class PageFactory{
    public function __construct(){
    }

    public static function create($session){
        $user_group = $session['user_group'];
        if ($user_group === 'admin'){
            return new AdminPage($session);
        }
        elseif ($user_group === 'manager'){
            return new ManagerPage($session);
        }
        elseif ($user_group === 'worker'){
            return new WorkerPage($session);
        }
    }
}



?>
