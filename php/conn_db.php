<?php
session_start();

// 面向对象
class Database {
    private $conn;

    public function __construct() {
        $this->connect();
    }

    private function connect() {
        $ip = 'localhost';
        $user = 'root';
        $pwd = 'p-0p-0p-0';
        $this->conn = mysqli_connect($ip, $user, $pwd, 'project');
        mysqli_query($this->conn, "set names utf8");
    }

    public function select($sql) {
        $re = mysqli_query($this->conn, $sql);
        $n = mysqli_num_rows($re);
        if ($n) {
            $arr = mysqli_fetch_all($re);
            return $arr;
        } else {
            return null;
        }
    }

    public function alter($sql) {
        $re = mysqli_query($this->conn, $sql);
        if ($re) {
            return true;
        } else {
            return null;
        }
    }

    public function close() {
        mysqli_close($this->conn);
    }
}



function select_mysqli($sql) {
    $db = new Database();
    $result = $db->select($sql);
    $db->close();
    return $result;
}

function alter_mysqli($sql) {
    $db = new Database();
    $result = $db->alter($sql);
    $db->close();
    return $result;
}




// 原代码
// function conn_mysqli(){
//     $ip='localhost';
//     $user='root';
//     $pwd='p-0p-0p-0';
//     $conn=mysqli_connect($ip,$user,$pwd,'project');
//     mysqli_query($conn,"set names utf8" );
//     return $conn;
// }

// function select_mysqli($sql){
//     $conn=conn_mysqli();
//     $re=mysqli_query($conn,$sql);
//     $n=mysqli_num_rows($re);
//     if($n){
//         $arr=mysqli_fetch_all($re);
//         mysqli_close($conn);
//         return $arr;
//     }else{
//         mysqli_close($conn);
//         return null;
//     }
    
// }

// function alter_mysqli($sql){
//     $conn=conn_mysqli();
//     $re=mysqli_query($conn,$sql);
//     if($re){
//         mysqli_close($conn);
//         return true;
//     }else{
//         mysqli_close($conn);
//         return null;
//     }
// }
?>
