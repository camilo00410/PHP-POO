<?php 

class Request{
    private $url, $controllers, $methods, $arg;

    public function __construct($url){
        if(!empty($url)){
            $this->url = explode("/",$url);
            $this->controllers = array_shift($this->url);
            $this->methods = array_shift($this->url);
            $this->arg = $this->url;
        }
    }

    public function getController():string{
        return $this->controllers ?: 'index';
    }

    public function getMethods():string{
        return $this->methods ?: 'index';
    }

    public function getArg():array{
        return $this->arg ?: [];
    }
}