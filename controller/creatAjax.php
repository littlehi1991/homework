<?php
require 'db.php';
$account = $_POST['creat_accont'];
$username = $_POST['creat_name'];
$sex = $_POST['creat_sex'];
$birthday = $_POST['creat_birthday'];
$email = $_POST['creat_email'];
$remark = $_POST['creat_remark'] ;

$sql =  "INSERT INTO NuEIP_test.account_info (account , name , sex , birthday , email , remark )
            VALUES ('" . $account .  "' , '" . $username . "' , '" . $sex . "', '" . $birthday . "' , '" . $email ."' , '" . $remark . "')";

$data = new DB();
$val = $data->connectDB()->query($sql);


if ($val) {
    echo json_encode(['status' => '新增成功']);
    exit;
}

echo json_encode(['status' => '新增失敗']);