<?php
error_reporting(E_ALL);
require '../controller/config.php';
require '../controller/db.php';
$data = new DB();

//取得指定頁次,判斷沒有GET資訊時要給1
$cur_page = (empty($_GET['page'])) ? 1 : (int)$_GET['page'];

//每頁幾筆資料
$per_page = 5;
//計算全部幾筆資料
$totol_num = "SELECT count(*) FROM NuEIP_test.account_info ";
$page = $data->connectDB()->query($totol_num)->fetch_all(1);

//全部有幾頁
$totol_page = ceil($page[0]['count(*)'] / $per_page);


//每次要從總數量的文章筆數的第幾序位撈出幾筆資料
$sql = 'SELECT * FROM NuEIP_test.account_info ORDER BY id DESC LIMIT ' . ($cur_page - 1) * $per_page . ',' . $per_page;
$val = $data->query($sql)->fetch_all(1);

?>
<!doctype html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
        <meta name="generator" content="Jekyll v3.8.6">
        <title>NuETP 上機作業</title>


        <!-- CSS only -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

        <!-- JS, Popper.js, and jQuery -->
<!--        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>-->
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        <!-- Favicons -->
        <meta name="theme-color" content="#563d7c">
        <script>
            $(document).on('click','.btn-link' ,function () {
                showCreatLB();
            });

            function showCreatLB() {
                $('.lb_creat').css('display' , 'block');
            }

            function hideCreatLB() {
                $('.lb_creat').css('display' , 'none');
            }

            function sendCreat() {
                let Caccount = $('.account').val();
                let Cname = $('.username').val();
                let Csex = $('.sex').val();
                let Cbirthday = $('.birthday').val();
                let Cemail = $('.email').val();
                let Cremark = $('.remark').val();

                $.ajax({
                    type: 'POST',
                    dataType: 'JSON',
                    url: '../controller/creatAjax.php',
                    data: {
                        creat_accont:Caccount,
                        creat_name:Cname,
                        creat_sex:Csex,
                        creat_birthday:Cbirthday,
                        creat_email:Cemail,
                        creat_remark:Cremark
                },
                    success: function(creat_value) {
                        alert(creat_value['status']);
                        hideCreatLB();
                    }
                });
            }

            function showEditLB(id,account,username,sex,birthday,email,userremark) {
                let get_id = id;
                let get_account = account;
                let gee_name = username;
                let get_sex = sex;
                let get_birthdat = birthday;
                let get_email = email;
                let get_userremark = userremark;

                console.log(get_id);

                $('.lb_update').css('display' , 'block');
                $('.userId').val(get_id);
                $('.Eaccount').val(get_account);
                $('.Eusername').val(gee_name);
                $('.Esex').val(get_sex);
                $('.Ebirthday').val(get_birthdat);
                $('.Eemail').val(get_email);
                $('.Eremark').html(get_userremark);
            }

            function hideEditLB() {
                $('.lb_update').css('display' , 'none');
            }

            function sendEdit(){
                let eId = $('.userId').val();
                let eAccount = $('.Eaccount').val();
                let eName = $('.Eusername').val();
                let eSex = $('.Esex').val();
                let eBirthday = $('.Ebirthday').val();
                let eEmail = $('.Eemail').val();
                let eRemark = $('.Eremark').html();

                $.ajax({
                    type: 'POST',
                    datatype: 'JSON',
                    url: '../controller/editAjax.php',
                    data: {
                        edit_id: eId,
                        edit_account: eAccount,
                        edit_name: eName,
                        edit_sex: eSex,
                        edit_birthday: eBirthday,
                        edit_email: eEmail,
                        edit_remark: eRemark
                    },
                    success: function (edit_value) {
                        alert(edit_value['status']);
                        hideEditLB();
                    }
                });
            }


        </script>
        <style>
            .bd-placeholder-img {
                font-size: 1.125rem;
                text-anchor: middle;
                -webkit-user-select: none;
                -moz-user-select: none;
                -ms-user-select: none;
                user-select: none;
            }

            @media (min-width: 768px) {
                .bd-placeholder-img-lg {
                    font-size: 3.5rem;
                }
            }
        </style>
    </head>
        <header>
            <!-- Fixed navbar -->
            <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
                <a class="navbar-brand" href="<?php echo DOMAIN.'homework/view/member.php';?>">上機作業</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="#">關於我 <span class="sr-only">(current)</span></a>
                        </li>
                    </ul>
                    <form class="form-inline mt-2 mt-md-0">
                        <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                    </form>
                </div>
            </nav>
        </header>
        <!-- Fixed navbar -->
        <div class="container">

<!--            新增帳號的燈箱-->

            <div class="lb_creat" style="width:100%;height:130%;background-color: rgba(0,0,0,0.5); z-index: 999999; position: absolute; left: 0; top: 0; display: none">
                <div class="lb_creat_content" style="position: relative; top: 15%;left: 25%; width: 40%; height: 750px; background-color: white;">
                    <div class="py-4 text-left" style="padding-left: 5%;">
                        <h2>新增帳號</h2>
                    </div>
                    <div class="col-md-11"style="padding-left: 5%;">
                        <form class="needs-validation" novalidate method="post">
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label for="account">帳號</label>
                                    <input type="text" class="form-control account" id="account" placeholder="請輸入6~12位英數文字" value="" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="username">姓名</label>
                                <div class="input-group">
                                    <input type="text" class="form-control username" id="username" placeholder="請輸入姓名" value="" required>
                                    <div class="invalid-feedback" style="width: 100%;">
                                        Your username is required.
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="sex">性別：</label>
                                <br/>
                                <div style="padding-top: 5px;padding-left: 20px;">
                                    <input class="form-check-input sex" type="radio" name="sex" id="exampleRadios1" value="0" >
                                    <label class="form-check-label" for="exampleRadios1">
                                        男性
                                    </label>
                                    <br/>
                                    <input class="form-check-input sex" type="radio" name="sex" id="exampleRadios2" value="1">
                                    <label class="form-check-label" for="exampleRadios2">
                                        女性
                                    </label>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="username">生日</label>
                                <div class="input-group">
                                    <input type="date" class="form-control birthday" id="birthday" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="email">Email <span class="text-muted">(Optional)</span></label>
                                <input type="email" class="form-control email" id="email" placeholder="you@example.com" value="" required>
                                <div class="invalid-feedback">
                                    Please enter a valid email address for shipping updates.
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="remark">備註</label>
                                <div class="input-group">
                                    <textarea name="remark" class="remark"></textarea>
                                </div>
                            </div>

                            <hr class="mb-4">
                            <div style="float: right;">
                                <button type="button" class="btn btn-primary" onclick="sendCreat();">送出</button>
                                <button type="button" class="btn btn-secondary" onclick="hideCreatLB();">取消</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!--            編輯資料的燈箱-->

            <div class="lb_update" style="width:100%;height:130%;background-color: rgba(0,0,0,0.5); z-index: 999999; position: absolute; left: 0; top: 0; display: none ">
                <div class="lb_uptade_ontent" style="position: relative; top: 15%;left: 25%; width: 50%; height:73%;background-color: white;">
                    <div class="py-4 text-left" style="padding-left: 5%;">
                        <h2>修改資料</h2>
                    </div>
                    <div class="col-md-11"style="padding-left: 5%;">
                        <form class="needs-validation" novalidate>
                            <input type="hidden" class="userId" value="">
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label for="account">帳號</label>
                                    <input type="text" class="form-control Eaccount" id="account" placeholder="請輸入6~12位英數文字" value="" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="username">姓名</label>
                                <div class="input-group">
                                    <input type="text" class="form-control Eusername" id="username" placeholder="請輸入姓名" value="" required >
                                    <div class="invalid-feedback" style="width: 100%;">
                                        Your username is required.
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="sex">性別：</label>
                                <br/>
                                <div style="padding-top: 5px;padding-left: 20px;">
                                    <input class="form-check-input Esex" type="radio" name="sex" id="exampleRadios1" value="0" >
                                    <label class="form-check-label" for="exampleRadios1">
                                        男性
                                    </label>
                                    <br/>
                                    <input class="form-check-input Esex" type="radio" name="sex" id="exampleRadios2" value="1" >
                                    <label class="form-check-label" for="exampleRadios2">
                                        女性
                                    </label>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="username">生日</label>
                                <div class="input-group">
                                    <input type="date" class="form-control Ebirthday" id="birthday" value="">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="email">Email <span class="text-muted">(Optional)</span></label>
                                <input type="email" class="form-control Eemail" id="email" placeholder="you@example.com" value="">
                                <div class="invalid-feedback">
                                    Please enter a valid email address for shipping updates.
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="remark">備註</label>
                                <div class="input-group">
                                    <textarea name="remark" class="Eremark"></textarea>
                                </div>
                            </div>

                            <hr class="mb-4">
                            <div style="float: right;">
                                <button type="button" class="btn btn-primary" onclick="sendEdit()">完成編輯</button>
                                <button type="button" class="btn btn-secondary" onclick="hideEditLB();" >取消</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

<!--            取出目前存在資料庫的資料渲染在HTML中-->

            <div class="col-md-12" style="margin-top: 7%;">
                <h2>Member List</h2>
                <div>
                    <button type="button" class="btn btn-link">新增資料</button>
                </div>
                <div class="col-md-12" style="text-align: center;">
                    <div class="table-responsive">
                        <table class="table table-striped table-sm">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>帳號</th>
                                <th>姓名</th>
                                <th>性別</th>
                                <th>生日</th>
                                <th>信箱</th>
                                <th>備註</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $sex = '';
                            foreach ($val as $k => $v){
                               $birthday= date("Y/m/d ",strtotime($v['birthday']));
                                switch ($v['sex']){
                                    case '0':
                                        $sex = '男';
                                    break;
                                    case '1':
                                        $sex = '女';
                                    break;
                                }
                                ?>
                            <tr>
                                <td><?php echo $v['id'];?></td>
                                <td><?php echo $v['account'];?></td>
                                <td><?php echo $v['name'];?></td>
                                <td><?php echo $sex ;?></td>
                                <td><?php echo $birthday;?></td>
                                <td><?php echo $v['email'];?></td>
                                <td><?php echo $v['remark'];?></td>
                                <th><span class="edit" style="color:#0080FF	;" onclick="showEditLB('<?= $v['id']?>','<?= $v['account']?>','<?= $v['name']?>','<?= $v['sex']?>','<?= $v['birthday']?>','<?= $v['email']?>','<?= $v['remark']?>')" >編輯</span>｜
                                    <a href='<?php echo DOMAIN . 'homework/controller/delet.php?id='.$v['id'];?>' onClick="return confirm('確定刪除？')" >刪除</a></th>
                            </tr>
                            </tbody>
                            <?php }?>
                        </table>
                    </div>
                </div>
            </div>
            <div style="text-align: center;">
               <?php require 'page.php'; ?>
            </div>
        </div>
    </body>
</html>
