<?php
include 'conn_db.php';

// 获取要删除的商品编号
$product_code = $_REQUEST['id'];

// 删除商品
$delete_sql = "DELETE FROM product WHERE code = '{$product_code}';";
$result = alter_mysqli($delete_sql);

if ($result) {
    echo "商品删除成功！";
} else {
    echo "商品删除失败！";
}
?>