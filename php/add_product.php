<?php
include 'conn_db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $code = $_POST['code'];
    $name = $_POST['name'];
    $quantity = $_POST['number'];
    $price = $_POST['price'];
    $shelf_number = $_POST['shelf_number']; // 新增货架号字段

    if ($code && $name && $quantity && $price && $shelf_number) {
        $insert_sql = "INSERT INTO product (code, name, number, price, no) VALUES ('{$code}', '{$name}', '{$quantity}', '{$price}', '{$shelf_number}');";
        $result = alter_mysqli($insert_sql);

        if ($result) {
            echo "<script>alert('商品新增成功！'); window.location.href = 'http://192.168.100.128/project/search.html';</script>";
        } else {
            echo "<script>alert('商品新增失败！'); window.location.href = 'http://192.168.100.128/project/add_product.html';</script>";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>新增商品</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        form {
            width: 300px;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #4a5568;
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-top: 10px;
            color: #4a5568;
        }
        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="submit"], button {
            margin-top: 20px;
            padding: 10px;
            width: 100%;
            background-color: #4a5568;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        input[type="submit"]:hover, button:hover {
            background-color: #2d3748;
        }
    </style>
</head>
<body>
    <form method="POST" action="php/add_product.php">
        <h1>新增商品</h1>
        <label for="shelf_number">货架号:</label>
        <input type="text" id="shelf_number" name="shelf_number" required>

        <label for="code">商品编号:</label>
        <input type="text" id="code" name="code" required maxlength="5">
        
        <label for="name">名称:</label>
        <input type="text" id="name" name="name" required>
        
        <label for="quantity">数量:</label>
        <input type="text" id="quantity" name="number" required>
        
        <label for="price">价格:</label>
        <input type="text" id="price" name="price" required>
     
        <input type="submit" value="新增商品">
        <button type="button" onclick="window.location.href='../search.html'">返回</button>
    </form>
</body>
</html>