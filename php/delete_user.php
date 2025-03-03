<?php
include 'conn_db.php';

$username=$_REQUEST['username'];

if($username=='root'){
    echo 'root用户不能删除';
    exit;
}

$sql = "DELETE FROM users WHERE username = '$username'";

$arr = alter_mysqli($sql);

if($arr){
    echo '删除成功';
}else{
    echo '删除失败';
}

?>