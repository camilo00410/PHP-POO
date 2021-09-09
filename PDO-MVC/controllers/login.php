<?php 

class login{
    public function index(){
        require_once "./views/index.php";        

        session_start();
        require_once "./models/selectData.php";
        $select = new selectData();
        $user = $select->select('users', '*', 'email=' . "'" . $_POST['email'] . "'");
        // var_dump($user);
        
            if(count($user) > 0){
                // verificacion del password
                if(password_verify($_POST['password'], $user[0]['password'])  )  {
                    $_SESSION['id'] = $user[0]['id'];            
                    $_SESSION['email'] = $user[0]['email'];
                    header('location: ' . BASE_URL . 'product/index');
                }
                else{                               
                    header('location: ' . BASE_URL . 'login/index?error=101');
                }
            } 
    }

    public function exit(){
        unset($_SESSION['email']);
        session_destroy();
        header('location: ' . BASE_URL . 'login/index');
        exit;
    }
}