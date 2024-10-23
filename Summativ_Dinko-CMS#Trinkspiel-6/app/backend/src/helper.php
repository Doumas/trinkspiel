<?php
// Helfer Klasse, Message & String/Array säuberung 
trait Helper{
    public static $error = [];
    public static $success = [];
// String von möglichen befreien
public static function flash(array $flash, string $type){
    $data = self::cleanArray($flash);
    $type = self::cleanString($type);
    switch($type) {
        case 'error':
            foreach($data as $key => $value)
            self::$error[$key.'Error'] = $value;
            break;
            case 'success':
                foreach($data as $key => $value)
                self::$success[$key] = $value;
            }
        }
        // return Array Error
    public static function getErrors(){
        if(!empty(self::$error))
        { 
            return(self::$error);
        }
        else return false;
    }
     // return Array Success
    public static function getSuccess(){
        if(!empty(self::$success))
        { 
            return(self::$success);
        }
        else return false;
    }
    // Return nach String Säuberung, Befreiung von überflüßigen Leerzeichen, \, Html Tags.  
public static function cleanString(string $string){
    if(!empty($string)){
        // return clean Data
        return stripslashes(trim(htmlentities($string, ENT_QUOTES, "UTF-8")));
    } else return false;
}
// Return nach Array Säuberung...  
public static function cleanArray(array $array){
    if(!empty($array)){
        foreach($array as $key => $value){
            // Verwende cleanString für Key => Value
            $data[self::cleanString($key)] = self::cleanString($value);
        }
        // return clean Data
        return $data;
    } else return false;
    }
}

?>