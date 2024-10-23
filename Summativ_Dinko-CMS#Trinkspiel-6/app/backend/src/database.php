<?php
#Datenbank
Class Database{
// Private Paramater
    private $serverName,
    $userName,
    $dbName,
    $password,
    $charset,
    $data;
    #Private Methode PDO
    private function pdo()
    {
        try{
            return new PDO('mysql:host=localhost;dbname=ineverdid', 'root', 'root');
        }
        catch(exception $e){

        }
    }
#Get row: Übergabe SQL Anweisung, Array
public function setRows(string $query,array $params = [], $fetch = null){
try{
    $stmt = $this->pdo()->prepare($query);
    $stmt -> execute ($params);
    $this->data = $stmt->fetchAll($fetch);
    if($this->data !==false){
        return true;
    }
    else return false;
    
}catch(\Exception $e){
    throw new Exception($e->getMessage());
}
    
}
#return Row
public function getRow(){
    return $this->data;
    }
#Set rows: Übergabe SQL Query & Params
public function setRow(string $query,array $params = []){
    try{
        $stmt = $this->pdo()->prepare($query);
        $stmt -> execute ($params);
    $this->data = $stmt->fetch();
    if($this->data !==false)
    return true;
    else return false;
        // ErrorHandling 
    }catch(\Exception $e){
        throw new Exception($e->getMessage());
    }
    
       
}
// Return Rows
public function getRows(){
    return $this->data;
    }
#Insert Übergabe SQL Anweisung, Array
public function insertRow(string $query,array $params = []){
    try{
        $stmt = $this->pdo()->prepare($query);
        if($stmt -> execute ($params) !== false) 
        return true;
        else  return false;
        // ErrorHandling
    }catch(\Exception $e){
        throw new Exception($e->getMessage());
    }
    
}
#Update* Code wiederholt sich, hier verwende ich die bereits existierende methode insertRow
public function updateRow(string $query,array $params = []){
    if($this->insertRow($query, $params) !== false){
        return true;
    }else return false;
}
#Delete* Code wiederholt sich, hier verwende ich die bereits existierende methode insertRow
public function deleteRow($query, $params = []){
    if($this->insertRow($query, $params) !== false)
        return true;
        else return false;
    }
}
?>