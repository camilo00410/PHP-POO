<?php

class DB{
    protected $gestor = 'mysql';
    protected $host = '127.0.0.1';
    protected $port = '3306';
    protected $user = 'root';
    protected $pass = '';
    protected $db = 'ejemplo';
    protected $con;

    public function __construct()
    {
        try {
            $option = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_PERSISTENT => true
            ];
            $conn = "$this->gestor:host=$this->host;port=$this->port;dbname=$this->db;charset=utf8";
            $this->con = new PDO($conn, $this->user, $this->pass, $option);
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function prepare($query){
        try {
            $prepare = $this->con->prepare($query);
            $prepare->execute();
            return $prepare;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function select($table, $fields = '*', $cond = ''){
        $strQ = "SELECT $fields FROM $table ";
        if($cond !== ''){
            $strQ .= " WHERE $cond";
        }
        $this->con->beginTransaction();
        $prepare=$this->prepare($strQ);
        $return = $prepare->fetchAll(PDO::FETCH_ASSOC);
        $this->con->commit();
        return $return;
    }

    public function arrayDB($fields){
        $field = '';
        $fieldValue = '';
        $data = [];
        $data2 = [];
        foreach($fields as $keyF => $valueF){
            $field .= "$keyF, ";
            $fieldValue .= ":$keyF, ";
            $data[":$keyF"] = $valueF;
            $data2["$keyF"] = ":$keyF";
        }
        $field = substr($field, 0, strlen($field)-2);
        $fieldValue = substr($fieldValue, 0, strlen($fieldValue)-2);
        return [$field, $fieldValue, $data, $data2];
    }

    public function insert($table, $fields = []){
        $strQ = " INSERT  INTO $table  (";
        $arr = $this->arrayDB($fields);
        $strQ .=  $arr[0] . ") VALUES ( $arr[1] )";
        $prepare = $this->con->prepare($strQ);
        $prepare->execute($arr[2]);
        return $this->con->lastInsertId();
    }

    public function update($table, $fields = [], $cond = '', $value){
        $strQ = " UPDATE $table SET ";
        $arr = $this->arrayDB($fields);
        foreach($arr[3] as $keyC => $valueC){
            $strQ .= $keyC ."= :$keyC, ";
        }
        $strQ = substr($strQ, 0 , strlen($strQ)-2);
        $strQ .= " WHERE $cond = :$cond ";
        $prepare = $this->con->prepare($strQ);
        $prepare->bindParam(":$cond",$value);
        $prepare->execute($arr[2]);
        return $this->con->lastInsertId();
    }

    public function delete($table, $cond = ''){
        $strQ = "DELETE FROM $table WHERE $cond";
        $prepare = $this->prepare($strQ);
        return $prepare;
    }

}