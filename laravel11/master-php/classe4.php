<?php 

class MathUtils {
    public static float $pi = 3.144159;

    public static function square(float $num):float {
        return $num * $num;
    }
}

class Connection {

    private static $instance = null;                                                                                                                                                                                                                                                                                                                   
    private function __construct(){}

    public static function singleton() {
        if(null === static::$instance){
            static::$instance = new static();
        }
        return static::$instance;
    }
}

// $connection = new Connection();
$connection =Connection::singleton();


// var_dump(
//     MathUtils::$pi,
//     MathUtils::square(6)
// );