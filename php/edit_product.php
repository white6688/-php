<?php
include 'conn_db.php';

// 获取要编辑的商品编号
$product_code = $_GET['id'];

// 查询商品信息
$sql = "SELECT * FROM product WHERE code = '{$product_code}';";
$product = select_mysqli($sql);

$product = $product[0]; // 获取第一条记录

// 处理表单提交
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $new_code = $_POST['new_code'];
    $name = $_POST['name'];
    $quantity = $_POST['number'];
    $price = $_POST['price'];
    $shelf_number = $_POST['shelf_number']; // 新增货架号

    // 更新商品信息
    $update_sql = "UPDATE product SET code = '{$new_code}', name = '{$name}', number = '{$quantity}', price = '{$price}', no = '{$shelf_number}' WHERE code = '{$product_code}';";
    $result = alter_mysqli($update_sql);

    if ($result) {
        echo "<script>alert('商品信息更新成功！'); setTimeout(function() { window.location.href = 'http://192.168.100.128/project/search.html'; }, 500);</script>";
    } else {
        echo "<script>alert('商品信息更新失败！');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>编辑商品</title>
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
    <form method="POST">
        <h1>编辑商品</h1>
        <label for="new_code">新商品编号:</label>
        <input type="text" id="new_code" name="new_code" value="<?php echo $product[1]; ?>">
        
        <label for="name">名称:</label>
        <input type="text" id="name" name="name" value="<?php echo $product[2]; ?>">
        
        <label for="quantity">数量:</label>
        <input type="text" id="quantity" name="number" value="<?php echo $product[3]; ?>">
        
        <label for="price">价格:</label>
        <input type="text" id="price" name="price" value="<?php echo $product[4]; ?>">
        
        <label for="shelf_number">货架号:</label>
        <input type="text" id="shelf_number" name="shelf_number" value="<?php echo $product[0]; ?>">
        
        <input type="submit" value="更新商品信息">
        <button type="button" onclick="window.location.href='../search.html'">返回</button>
    </form>
</body>
</html>