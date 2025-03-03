<?php
include 'conn_db.php';

$str = $_POST['query'];
if($str == null){
    echo null;
    die();
}

if (ctype_digit($str)) {
    $sql = "SELECT * FROM product WHERE code LIKE '%{$str}%';";
} else {
    $sql = "SELECT * FROM product WHERE name LIKE '%{$str}%';";
}

$arr = select_mysqli($sql);

if ($arr) {
    echo "<style>
            table {
                width: 1000px;
                border-collapse: collapse;
                font-family: Arial, sans-serif;
                margin:auto;
                font: size 20px;
            }
            th, td {
                padding: 10px;
                text-align: center;
                border: 1px solid #ddd;
            }
            th {
                background-color:#4a5568;
                color: white;
            }
            tr:nth-child(even) {
                background-color: #f2f2f2;
            }
            tr:hover {
                background-color: #ddd;
            }
            button {
                padding: 5px 10px;
                margin: 2px;
                cursor: pointer;
            }
          </style>";

    echo "<table>
            <tr>
                <th>编号</th>
                <th>货架号</th>
                <th>商品编号</th>
                <th>名称</th>
                <th>数量</th>
                <th>价格</th>
                <th>操作</th>
            </tr>";
    
    $counter = 1; // 初始化编号计数器
    
    foreach ($arr as $v) {
        echo "<tr id='row_" . $v[1] . "'>";
        echo "<td>" . $counter . "</td>"; // 显示编号
        echo "<td>" . $v[0] . "</td>"; // 货架号
        echo "<td>" . $v[1] . "</td>"; // 商品编号
        echo "<td>" . $v[2] . "</td>"; // 名称
        echo "<td>" . $v[3] . "</td>"; // 数量
        echo "<td>" . $v[4] . "</td>"; // 价格
        echo "<td>
                <button onclick=\"window.location.href='http://192.168.100.128/project/php/edit_product.php?id=" . $v[1] . "'\">编辑</button>
                <button onclick=\"deleteProduct('" . $v[1] . "')\">删除</button>
              </td>"; // 编辑和删除按钮
        echo "</tr>";
        
        $counter++; // 增加编号计数器
    }
    echo "</table>";
    die();
} else {
    echo null;
    die();
}
?>


