<?php
session_start();

include 'conn_db.php';

$username = $_POST['username'];
$password = $_POST['password'];
$captcha = $_POST['captcha'];


function login($username,$password,$captcha){
    // if (strtolower($captcha) !== strtolower($_SESSION['captcha'])) {
    //     header("Location: http://192.168.100.128/project/login.html?wrong-captcha");
    //     exit();
    // }

    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";

    $arr = select_mysqli($sql);

    if ($arr) {
        $_SESSION['login']=1;
        $_SESSION['name']=$username;
        $_SESSION['auth']=role($username);
        echo 'login-pass';
        header("Location: http://192.168.100.128/project/index.html?");
        exit();
    }
    else {
        header('Location: http://192.168.100.128/project/login.html?login-failed');
        exit();
    }    
}

function role($username){
    $sql="SELECT authority FROM users WHERE username='$username'";
    $arr = select_mysqli($sql);
    return $arr[0][0];
}



login($username,$password,$captcha);

?>