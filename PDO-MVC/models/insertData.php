<?php

class insertData extends DB{
    
    // public function insert($table, $field = '*', $cond = ''){
    //     $strQuery = "INSERT INTO $table ";
    //     if($field != '*'){
    //         $strQuery .= " ($field) VALUES ($cond)";
    //     }else{
    //         $strQuery .= "  VALUES '$cond'";
    //     }

    //     $strQuery;
    //     $this->con->beginTransaction();
    //     $prepare = $this->prepare($strQuery);
                
    //     $this->con->commit();
    //     return $prepare;

    // }

    public function insert($table, $fields = []){
        $strQuery = "INSERT INTO $table (";//INSERT INTO tabla () VALUES()
        $arr = $this->arrayDB($fields);
        $strQuery .= $arr[0] . ") VALUES(" . $arr[1] . ")";
        $prepare = $this->con->prepare($strQuery);
        $prepare->execute($arr[2]);//Metod Lazy de insercion
        return $this->con->lastInsertId();
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
    
    public function arrayDB($fields){
        $field = '';
        $fieldValue = '';
        $data = [];
        foreach ($fields as $keyF => $valueF){
            $field .= "$keyF, ";
            $fieldValue .= ":$keyF, ";
            $data[":$keyF"] =  $valueF;//Array Asociativo
        }
        $field = substr($field, 0, strlen($field)-2);
        $fieldValue = substr($fieldValue, 0, strlen($fieldValue)-2);
        return [$field, $fieldValue, $data];
    }
}
    




// public function prepare($query){
//     try {
//         $prepare = $this->con->prepare($query);
//         $prepare->execute();
//         return $prepare;
//     }catch (Exception $e){
//         echo $e->getMessage();
//     }
// }

// public function insert($table, $fields = []){
//     $strQuery = "INSERT INTO $table (";//INSERT INTO tabla () VALUES()
//     $arr = $this->arrayDB($fields);
//     $strQuery .= $arr[0] . ") VALUES(" . $arr[1] . ")";
//     $prepare = $this->con->prepare($strQuery);
//     $prepare->execute($arr[2]);//Metod Lazy de insercion
//     return $this->con->lastInsertId();
// }