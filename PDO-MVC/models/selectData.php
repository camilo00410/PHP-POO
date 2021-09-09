<?php

class selectData extends DB{

    
    public function select($table, $field = '*', $cond = ''){
        $strQuery = "SELECT $field FROM $table";//SELECT * FROM users
        if($cond != ''){
            $strQuery .= " WHERE $cond";
        }
     $strQuery;
        $this->con->beginTransaction();
        $prepare = $this->prepare($strQuery);
        $return = $prepare->fetchAll(PDO::FETCH_ASSOC);
        $this->con->commit();
        return $return;

    }
    
    public function prepare($query){
        try {
            $prepare = $this->con->prepare($query);
            $prepare->execute();
            return $prepare;
        }catch (Exception $e){
            echo $e->getMessage();
        }
    }
}
    