<?php
error_reporting(0);
session_start();
if($_SESSION['auth']!='root'){
    echo "<script>alert('权限不足')</script>";
    die();
}

include 'conn_db.php';

$str = $_POST['query'];

$sql = "SELECT username, authority FROM users WHERE username LIKE '%{$str}%';";

$arr = select_mysqli($sql);

if ($arr) {
    echo "<style>
            table {
                width: 100%;
                border-collapse: collapse;
                font-family: Arial, sans-serif;
            }
            th, td {
                padding: 10px;
                text-align: center;
                border: 1px solid #ddd;
            }
            th {
                background-color: #4a5568;
                color: white;
            }
            tr:nth-child(even) {
                background-color: #f2f2f2;
            }
            tr:hover {
                background-color: #ddd;
            }
          </style>";

    echo "<table>
            <tr>
                <th>序号</th>
                <th>username</th>
                <th>authority</th>
                <th>操作</th>
            </tr>";
    
    $counter = 1; // 初始化序号计数器
    
    foreach ($arr as $v) {
        echo "<tr id='row_" . $v[0] . "'>";
        echo "<td>" . $counter . "</td>"; // 输出序号
        echo "<td>" . $v[0] . "</td>"; // 输出用户名
        echo "<td>" . $v[1] . "</td>"; // 输出权限
        echo "<td>
                <button onclick=\"editUser('" . $v[0] . "')\">编辑</button>
                <button onclick=\"deleteur('" . $v[0] . "')\">删除</button>
              </td>"; // 输出编辑和删除按钮
        echo "</tr>";
        
        $counter++; // 递增序号
    }
    echo "</table>";
    die();
} else {
    echo null;
    die();
}
?>