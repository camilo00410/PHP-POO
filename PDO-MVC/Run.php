<?php

class Run{
    public static function Exce(Request $res){
        $routeController = './controllers/' . $res->getController();
        if(is_readable($routeController . '.php')){
            try{
                require_once "$routeController.php";
                $contr = $res->getController();
                $controller = new $contr;
                $method = $res->getMethods();
                call_user_func([$controller, $method], $res->getArg());
            }catch(Throwable $th){
                echo $th;
            }
        }else{
            echo "No funciona";
        }
    }
}