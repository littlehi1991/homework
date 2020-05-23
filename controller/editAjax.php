<?php
error_reporting(E_ALL);
require 'db.php';
$uid = $_POST['edit_id'];
$account = $_POST['edit_account'];
$name = $_POST['edit_name'];
$sex = $_POST['edit_sex'];
$birthday = $_POST['edit_birthday'];
$email = $_POST['edit_email'];
$remark = $_POST['edit_remark'];

$sql = "UPDATE NuEIP_test.account_info SET account ='". $account."' , name = '" . $name . "' , sex = '" . $sql . "' ,  birthday = '" . $birthday . "' , email = '" . $email . "' , remark = '" . $remark . "'
        WHERE id = '". $uid . "'";

echo $sql;exit;

$data = new DB();
$val = $data->connectDB()->query($sql);



if ($val) {

    echo json_encode(['status' => '修改成功']);
    exit;
}

echo json_encode(['status' => '修改失敗']);