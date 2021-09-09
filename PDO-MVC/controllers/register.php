<?php

class register{
    public function index(){
        require_once "./views/register.php";        

        session_start();
        require_once "./models/insertData.php";
        $pass = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $_POST['password'] = $pass;
        $insert = new insertData();
        if(isset($_POST['email'])){
            // $us = $insert->insert('users', 'email, password', "'" . $_POST['email'] . "','" . $pass."'");     
            $us = $insert->insert('users', $_POST );  
            if(count($us) > 0){
                header('location: '.BASE_URL.'login/index');
            }else{
                header('location: '.BASE_URL.'register/index');
            }
        }        
    }
}