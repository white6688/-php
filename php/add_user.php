<?php
error_reporting(0);
session_start();
if($_SESSION['auth']!='root'){
    echo "<script>alert('权限不足'); window.location.href = '../system.html';</script>";
    die();
}

include 'conn_db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $permission = $_POST['permission'];

    $check_sql = "SELECT * FROM users WHERE username = '$username'";
    $result = select_mysqli($check_sql);

    if ($result) {
        echo "<script>alert('用户名已存在'); window.location.href = '../system.html';</script>";

    } else {
        $insert_sql = "INSERT INTO users (username, password, authority) VALUES ('$username', '$password', '$permission')";

        $re = alter_mysqli($insert_sql);

        if ($re) {
            echo "<script>alert('用户新增成功'); window.location.href = '../system.html';</script>";
        } else {
            echo "<script>alert('用户新增失败'); window.location.href = '../system.html';</script>";
        }
    }

}
?>

<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>新增用户</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .form-container {
            width: 300px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .form-container h2 {
            margin-bottom: 20px;
        }
        .form-container input[type="text"],
        .form-container input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .form-container select {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .form-container button {
            width: 100%;
            padding: 10px;
            background-color: #4a5568;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 10px;
        }
        .form-container button:hover {
            background-color: #718096;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>新增用户</h2>
        <form method="post">
            <input type="text" name="username" placeholder="用户名" required autocomplete="off">
            <input type="password" name="password" placeholder="密码" required>
            <select name="permission" required>
                <option value="normal">normal</option>
                <option value="root">root</option>
            </select>
            <button type="submit">新增用户</button>
        </form>
        <button onclick="window.location.href='../system.html'">返回</button>
    </div>
</body>
</html>