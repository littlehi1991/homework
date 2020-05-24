<?php
require_once __DIR__ .'/../controller/MemberListController.php';

$request = $_POST;

//method : 指定funtion使用方法 insert , update ,delete
//判斷是否有指定method
if (empty($request['method']) and !isset($request['method'])) {
    echo json_encode(['status' => false, 'des' => '缺少必要參數']);
}

$method = new MemberListController();

switch ($request['method']){
    case 'insert':
        //驗證欄位是否有值
        if (empty($request['account']) or empty($request['name']) or empty($request['birthday']) or empty($request['email']) or (empty($request['sex']) and !isset($request['sex']))) {
            echo json_encode(['status' => false, 'des' => '缺少必要欄位']);exit;
        }
        $rs = $method->doInsertProcess($request);
        echo ($rs === true) ? json_encode(['status' => true, 'des' => '新增成功']) : json_encode(['status' => false, 'des' => '失敗']);exit;
        break;
    case 'update' :
        if (empty($request['account']) or empty($request['name']) or empty($request['birthday']) or empty($request['email']) or (empty($request['sex']) and !isset($request['sex']))) {
            echo json_encode(['status' => false, 'des' => '缺少必要欄位']);exit;
        }
        $rs = $method->doUpdateProcess($request);
        $rs = ($rs === true) ? json_encode(['status' => true, 'des' => 'success']) : json_encode(['status' => false, 'des' => 'fail']);
        echo $rs;exit;
        break;
    case 'delete':
        break;
    default:
        echo json_encode(['status' => false, 'des' => '查無方法，請確認method 參數符合規範']);exit;
        break;
}
