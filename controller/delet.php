<?php
error_reporting(E_ALL);
$mid = $_GET['id'];
require 'db.php';
$sql = "DELETE  FROM NuEIP_test.account_info WHERE id = '" . $mid . "' ";
$data = new DB();
$rs = $data->connectDB()->query($sql);
if($rs){
    echo "<script>alert('已刪除');location.href='../view/member.php'</script>";
}else{
    echo "<script>alert('刪除失敗！'); location.href='../view/member.php'</script>";
}
