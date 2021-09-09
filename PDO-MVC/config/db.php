<?php 

class DB
{
    protected $host = HOST;
    protected $port = DB_PORT;
    protected $user = DB_USER;
    protected $password = DB_PASSWORD;
    protected $gestor = DB_GESTOR;
    protected $db = DB_NAME;
    public $con;

    public function __construct(){
        try {
            $option = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_PERSISTENT => true
                ];
            $co = "$this->gestor:host=$this->host;port=$this->port;dbname=$this->db;charset=utf8";
            $this->con = new PDO($co, $this->user, $this->password, $option);

        }catch (PDOException $e){
            echo "Error: " . $e->getMessage();
        }
    }
}