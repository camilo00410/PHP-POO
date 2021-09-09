<?php

class product{
    public function index(){
        session_start();
        if(!isset($_SESSION['email'])){
            header('location:' . BASE_URL .'login/index?error=200');
        }

        require_once "./models/selectData.php";
        $select = new selectData();
        $products = $select->select('products', '*', 'id_user=' . "'" . $_SESSION['id'] . "'");
        
        require_once "./views/product/product.php";
    }

    public function add(){
        require_once "./views/product/add.php";
    }

    public function show(){
        session_start();

        require_once "./models/insertData.php";
        $insert = new insertData();
        $_POST['id_user'] =  $_SESSION['id'];
        if(isset($_POST['product'])){
            $product = $insert->insert('products',$_POST);
            if(count($product) > 0){
                header('location: '.BASE_URL.'product/index');
            }else{
                header('location: '.BASE_URL.'product/add');
            }
        }      
    }
}