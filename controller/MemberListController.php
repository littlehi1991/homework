<?php

error_reporting(E_ALL);
require_once 'db.php';

class MemberListController
{
    //指定原預設撈出筆數
    private $per = 5;

    //錯誤回報
    public function __construct()
    {
        error_reporting(E_ALL);
    }

    //可供修改每次撈取比數的function
    public function setPerPage($num)
    {
        if(is_numeric($num)){
            //判斷傳進來的參數是不是數字，指定這隻class(this)的屬性為$num
            $this->per = $num;
        }
    }

    /*
     * @param $condition = ['method => 'search / sort' , 'param' => 'search: user account | sort: clo|asc or col|desc' ]
     */
    //前端將需求“搜尋/排序" , ”搜尋條件/排序條件"存成陣列回傳至此function
    public function getDataList($condition=[])
    {
        $data = new DB();

        //若沒有設定搜尋及排序條件則維持原設定（空字串）
        $orderBy = " ORDER BY id DESC";
        $conditionQuery = '';
        if(!empty($condition)){
            switch ($condition['method']){
                case 'search':
                    if(!empty($condition['param'])){
                        $conditionQuery .= " WHERE name = '" . $condition['param'] . "'";
                    }
                    break;
                case 'sort':
                    if(!empty($condition['param'])){
                        $t = explode('|', $condition['param']);
                        if(count($t) > 1 and ($t[1] === 'ASC' and $t[1] === 'DESC')){
                            $orderBy = " ORDER BY " . $t[0] . " ". $t[1];
                        }
                    }
                    break;
                default:
                    break;
            }
        }


        //取得指定頁次,判斷沒有GET資訊時要給1
        $cur_page = (empty($_GET['page'])) ? 1 : (int)$_GET['page'];

        //計算全部幾筆資料
        $total_num = "SELECT count(*) FROM NuEIP_test.account_info ".$conditionQuery;
        $page = $data->connectDB()->query($total_num)->fetch_all(1);
        //全部有幾頁
        $total_page = ceil($page[0]['count(*)'] / $this->per);
        //每次要從總數量的文章筆數的第幾序位撈出幾筆資料
        $sql = 'SELECT * FROM NuEIP_test.account_info '. $conditionQuery . $orderBy .' LIMIT ' . ($cur_page - 1) * $this->per . ',' . $this->per;
        $val = $data->query($sql)->fetch_all(1);

        return [
            'data' =>$val,
            'pagination' =>[
                'total_page' => $total_page,
                'total_num' => $total_num,
                'cur_page' => $cur_page
            ]
        ];
    }

    //接到ajax要做function
    public function doInsertProcess($request)
    {
        //檢查是否傳回必要參數
        if(empty($request['account'])or empty($request['name']) or empty($request['birthday']) or empty($request['email']) or empty($request['sex']) and !isset($request['sex'])){
            return false;
        }
        $data = new DB();
        $sql =  "INSERT INTO NuEIP_test.account_info (account , name , sex , birthday , email , remark )
            VALUES ('" . $request['account'] .  "' , '" . $request['name'] . "' , '" . $request['sex'] . "', '" . $request['birthday'] . "' , '" . $request['email'] ."' , '" . $request['remark'] . "')";

        $rs = $data->connectDB()->query($sql);

        if(!$rs){
            return false;
        }
            return true;

    }

    public function doUpdateProcess($request)
    {
        //檢查是否傳回必要參數
        if(empty($request['account'])or empty($request['name']) or empty($request['birthday']) or empty($request['email']) or empty($request['sex']) and !isset($request['sex'])){
            return false;
        }
        $data = new DB();
        $sql = $sql = "UPDATE NuEIP_test.account_info SET account ='". $request['account']."' , name = '" . $request['name'] . "' , sex = '" . $request['sex']. "' ,  birthday = '" . $request['birthday'] . "' , email = '" . $request['email'] . "' , remark = '" . $request['remark'] . "'
        WHERE id = '". $request['id'] . "'";
        $rs = $data->connectDB()->query($sql);

        if(!$rs){
            return false;
        }
            return true;
    }


}