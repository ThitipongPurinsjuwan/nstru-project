<?php
use app\models\Organization;
use app\models\OrganizationType;

$this->title = 'ข้อมูลภาพรวม';
$token = "2ffa459adcc37176dbf93a82addf61dc";
$auth = "Authenticator=>".$token."".date("Ymd");

$Terrorist = Yii::$app->db->createCommand("SELECT COUNT(*) FROM `eform_data` WHERE form_id = '21'")->queryScalar();
?>

<link rel="stylesheet" href="../../html-version/assets/css/style_equipment.css" />
<script src="../../js/highcharts.js"></script>
<script src="../../js/exporting.js"></script>
<script src="../../js/export-data.js"></script>
<script src="../../js/accessibility.js"></script>


<style>
.mb-15,
.card,
.card-profile-img,
.blog_left .blog_post .content,
.gender_overview,
.recent_comments li,
.todo_list li {
    margin-bottom: 5px;
}

.card-footer {
    padding: 0px 0px !important;
    background: none;
}

.iconall {
    content: "\e001";
    background-color: #dab90a;
    padding: 16px;
    border: -32;
    border-radius: 50px;
    color: #fff;
    text-align: center !important;
    font-size: 49;

}

.bbt {
    border-radius: 30px;
    margin-top: 20;
}

.top {
    margin-top: 10;
    margin-bottom: 20;
}

.ribbon .ribbon-box {
    padding: 8px !important;
}

p {
    margin-bottom: 1px !important;
}

.card1 {
    height: 300px;
}

.card3 {
    height: 224px;
}

.card2 {
    height: 190px;
    width: 100%;
}

table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

td,
th {
    border: 1px solid #0a96b9;
    text-align: left;
    padding: 8px;
    font-size: 13px;
}

tr:nth-child(even) {
    background-color: #dddddd;
}

.menu-slot {
    height: 40px;
}

.menu-slot-left {
    float: left;
    display: inline-block;
}

.menu-slot-right {
    float: right;
    display: inline-block;
}

.div-scrollbar {
    height: 250px;
    overflow-y: scroll;
    padding: 0em 1em 1em 1em;
    margin-bottom: 1em;
    font-size: 14px !important;
    width: 100%;
}

.font-20,
#calendar.fc .fc-toolbar h2,
.top_counter .icon i {
    font-size: 20px;
    margin-top: 16px;
}
</style>

<br>
<div class="section-body">
    <div class="container-fluid">

        <h4>ฐานข้อมูล ผกร.</h4>

    </div>
</div>
<div class="section-body mt-3">
    <div class="container-fluid">


        <div class="row clearfix">
            <div class="pp col-lg-3 col-md-6 col-sm-12">
                <a href="index.php?r=eform-data/index&form_id=21" class="operating-cursor text-muted">
                    <div class="card bg-red">
                        <div class="card-body">
                            <div class="widgets2">
                                <div class="state">
                                    <h6>ข้อมูลผกร.</h6>
                                    <h2> <?php echo number_format($count_zdi = Yii::$app->db->createCommand("SELECT COUNT(*) FROM eform_data WHERE form_id = '21' ORDER BY id ASC")->queryScalar()); ?>
                                    </h2>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-user-alt-slash"></i>
                                </div>
                            </div>
                            <div class="progress progress-sm">
                                <div class="progress-bar bg-gray-light" role="progressbar" aria-valuenow="62"
                                    aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                            </div>
                            <span class="text-small">Terrorist information</span>
                        </div>
                    </div>
                </a>
            </div>
            <div class="pp col-lg-3 col-md-6 col-sm-12">
                <a href="index.php?r=operating-main" class="operating-cursor text-muted">
                    <div class="card bg-aqua-active">
                        <div class="card-body">
                            <div class="widgets2">
                                <div class="state">
                                    <h6>พื้นที่ปฏิบัติการ</h6>
                                    <h2 id="show_main"></h2>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-map-signs"></i>
                                </div>
                            </div>
                            <div class="progress progress-sm">
                                <div class="progress-bar bg-gray-light" role="progressbar" aria-valuenow="31"
                                    aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                            </div>
                            <span class="text-small">Operating area data</span>
                        </div>
                    </div>
                </a>
            </div>
            <div class="pp col-lg-3 col-md-6 col-sm-12">
                <a href="index.php?r=organization" class="operating-cursor text-muted">
                    <div class="card bg-green-active">
                        <div class="card-body">
                            <div class="widgets2">
                                <div class="state">
                                    <h6>องค์กร</h6>
                                    <h2>
                                        <?php echo number_format($count_organization = Yii::$app->db->createCommand("SELECT COUNT(*) FROM organization ORDER BY id ASC")->queryScalar()); ?>
                                    </h2>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-sitemap"></i>
                                </div>
                            </div>
                            <div class="progress progress-sm">
                                <div class="progress-bar bg-gray-light" role="progressbar" aria-valuenow="78"
                                    aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                            </div>
                            <span class="text-small small-box-footer">organization</span>
                        </div>
                    </div>
                </a>
            </div>
            <div class="pp col-lg-3 col-md-6 col-sm-12">
                <div class="card bg-yellow">
                    <div class="card-body">
                        <div class="widgets2">
                            <div class="state">
                                <h6>ประเภทผกร.</h6>
                                <h2>
                                    <?php echo number_format($count_Terrorist_type = Yii::$app->db->createCommand("SELECT COUNT(*) FROM Terrorist_type ORDER BY id ASC")->queryScalar()); ?>
                                </h2>
                            </div>
                            <div class="icon">
                                <i class="fas fa-align-center"></i>
                            </div>
                        </div>
                        <div class="progress progress-sm">
                            <div class="progress-bar bg-gray-light" role="progressbar" aria-valuenow="20"
                                aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                        </div>
                        <span class="text-small">Terrorist type</span>
                    </div>
                </div>
            </div>
        </div>



        <div class="card">
            <div class="card-header bg-red">
                <h3 class="card-title">ข้อมูลผกร.</h3>
                <div class="card-options">
                    <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i
                            class="fe fe-chevron-up"></i></a>
                    <a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i
                            class="fe fe-maximize"></i></a>
                    <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
                </div>
            </div>
            <div class="card-body">
                <div class="row clearfix">
                    <div class=" col-lg-4 col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">ข้อมูลผกร.</h3>
                            </div>
                            <div class="card-body">
                                <div class="row text-center">
                                    <div class="col-4 border-right pb-4 pt-4">
                                        <label class="mb-0">ผู้ชาย</label>
                                        <h4 class="font-30 font-weight-bold text-col-blue">
                                            <?php   
                                            $boy = "ชาย";
                                            $b = Yii::$app->db->createCommand("SELECT * FROM `eform_data` WHERE form_id = '21' AND data_json LIKE '%\"gender\":\"".$boy."%'")->queryAll();
                                            echo count($b); 
                                    ?>
                                        </h4>
                                    </div>
                                    <div class="col-4 border-right pb-4 pt-4">
                                        <label class="mb-0">ผู้หญิง</label>
                                        <h4 class="font-30 font-weight-bold text-col-blue">
                                            <?php   
                                            $female = "หญิง";
                                            $g = Yii::$app->db->createCommand("SELECT * FROM `eform_data` WHERE form_id = '21' AND data_json LIKE '%\"gender\":\"".$female."%'")->queryAll();
                                            echo count($g); 
                                    ?>
                                        </h4>
                                    </div>
                                    <div class="col-4 pb-4 pt-4">
                                        <label class="mb-0">ไม่ระบุ</label>
                                        <h4 class="font-30 font-weight-bold text-col-blue">
                                            <?php   
                                            $female = "ไม่ระบุ";
                                            $g = Yii::$app->db->createCommand("SELECT * FROM `eform_data` WHERE form_id = '21' AND data_json LIKE '%\"gender\":\"".$female."%'")->queryAll();
                                            echo count($g); 
                                    ?>
                                        </h4>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label class="d-block">เพศชาย : <span class="float-right">
                                            <?php   
                                            $boy = "ชาย";
                                            $b = Yii::$app->db->createCommand("SELECT * FROM `eform_data` WHERE form_id = '21' AND data_json LIKE '%\"gender\":\"".$boy."%'")->queryAll();
                                            
                                            $count = count($b); 
                                           echo round($percent = (($count/$Terrorist) * 100), 2);
                                           $percent
                                    ?>%</span>
                                    </label>
                                    <div class="progress progress-sm">
                                        <div class="progress-bar card-rad" role="progressbar" aria-valuenow="77"
                                            aria-valuemin="0" aria-valuemax="100"
                                            style="width: <?php echo $percent;?>%;"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="d-block">เพศหญิง : <span class="float-right">
                                            <?php   
                                            $boy = "หญิง";
                                            $b = Yii::$app->db->createCommand("SELECT * FROM `eform_data` WHERE form_id = '21' AND data_json LIKE '%\"gender\":\"".$boy."%'")->queryAll();
                                            
                                            $count = count($b); 
                                           echo round($percent = (($count/$Terrorist) * 100), 2);
                                           $percent
                                    ?>%</span>
                                    </label>
                                    <div class="progress progress-sm">
                                        <div class="progress-bar card-rad" role="progressbar" aria-valuenow="77"
                                            aria-valuemin="0" aria-valuemax="100"
                                            style="width: <?php echo $percent;?>%;"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="d-block">ไม่ระบุเพศ : <span class="float-right">
                                            <?php   
                                            $boy = "ไม่ระบุ";
                                            $b = Yii::$app->db->createCommand("SELECT * FROM `eform_data` WHERE form_id = '21' AND data_json LIKE '%\"gender\":\"".$boy."%'")->queryAll();
                                            
                                            $count = count($b); 
                                           echo round($percent = (($count/$Terrorist) * 100), 2);
                                           $percent
                                    ?>%</span>
                                    </label>
                                    <div class="progress progress-sm">
                                        <div class="progress-bar card-rad" role="progressbar" aria-valuenow="77"
                                            aria-valuemin="0" aria-valuemax="100"
                                            style="width: <?php echo $percent;?>%;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class=" col-lg-8 col-md-12">
                        <div class="card ">
                            <div class="card-header">
                                <h3 class="card-title">กราฟแสดง ผกร. แต่ละประเภท</h3>
                                <div class="card-options">
                                    <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i
                                            class="fe fe-chevron-up"></i></a>
                                    <a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i
                                            class="fe fe-maximize"></i></a>
                                    <a href="#" class="card-options-remove" data-toggle="card-remove"><i
                                            class="fe fe-x"></i></a>

                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="pp col-lg-6 col-md-12">
                                        <div id="chart_donut1"></div>
                                    </div>
                                    <div class="pp col-lg-6 col-md-12">
                                        <div class="table-responsive">
                                            <div class="div-scrollbar">
                                                <div class="card2">
                                                    <table
                                                        class="table table-hover table-vcenter text-nowrap card-table table_custom">

                                                        <?php
                                                 $colors= ['#e4bd51', '#e8769f', '#6c7989', '#9aa2ac','#00a65a'];
                                                $i = 0;
                                                $userAll = Yii::$app->db->createCommand("SELECT COUNT(*) FROM `eform_data` WHERE form_id = '21'")->queryScalar();
                                                $Terrorist_type = Yii::$app->db->createCommand("SELECT * FROM `Terrorist_type`")->queryAll();
                                                foreach ($Terrorist_type as $value) {
                                                    $b = Yii::$app->db->createCommand("SELECT COUNT(id) AS sum FROM `eform_data` WHERE form_id = '21' AND data_json LIKE '%\"Terrorist_type\":\"".$value['type']."%'")->queryOne();
                                                    $percent = ($b['sum']/$userAll) * 100;
                                                ?> <tr>
                                                            <td>
                                                                <div class="clearfix">
                                                                    <div class="float-left"><strong>
                                                                            <?php echo $b['sum'];?>
                                                                            คน</strong></div>
                                                                    <div class="float-right"><small
                                                                            class="text-muted">ประเภท
                                                                            <?php echo $value['type'];?></small></div>
                                                                </div>
                                                                <div class="progress progress-xs">
                                                                    <div class="progress-bar" role="progressbar"
                                                                        style="width: <?php echo $percent;?>%; background-color:<?php echo $colors[$i]; ?>;"
                                                                        aria-valuenow="42" aria-valuemin="0"
                                                                        aria-valuemax="100"></div>
                                                                </div>
                                                            </td>

                                                        </tr> <?php $i++; } ?>

                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="card-footer text-center" style="border-color: #da1539; border-width: 2px; color: #111;">
                <div class="row">
                    <div class="col-sm-3 col-xs-6">
                        <div class="description-block border-right">
                            <h4 class="description-header"><?php   
                                $boy = "หลบหนี";
                                $b = Yii::$app->db->createCommand("SELECT * FROM `eform_data` WHERE form_id = '21' AND data_json LIKE '%\"status\":\"".$boy."%'")->queryAll();
                                echo count($b); 
                            ?></h4>
                            <h6 class="description-text "> <b>หลบหนี</b> </h6>
                        </div>
                        <!-- /.description-block -->
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-3 col-xs-6">
                        <div class="description-block border-right">
                            <h4 class="description-header"> <?php   
                                $boy = "จับกุม";
                                $b = Yii::$app->db->createCommand("SELECT * FROM `eform_data` WHERE form_id = '21' AND data_json LIKE '%\"status\":\"".$boy."%'")->queryAll();
                                echo count($b); 
                            ?></h4>
                            <h6 class="description-text"> <b>จับกุม</b> </h6>
                        </div>
                        <!-- /.description-block -->
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-3 col-xs-6">
                        <div class="description-block border-right">
                            <h4 class="description-header"><?php   
                                $boy = "อยู่ระหว่างดำเนินคดี";
                                $b = Yii::$app->db->createCommand("SELECT * FROM `eform_data` WHERE form_id = '21' AND data_json LIKE '%\"status\":\"".$boy."%'")->queryAll();
                                echo count($b); 
                            ?></h4>
                            <h6 class="description-text"> <b>อยู่ระหว่างดำเนินคดี</b> </h6>
                        </div>
                        <!-- /.description-block -->
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-3 col-xs-6">
                        <div class="description-block">
                            <h4 class="description-header"><?php   
                                $boy = "ไม่ระบุ";
                                $b = Yii::$app->db->createCommand("SELECT * FROM `eform_data` WHERE form_id = '21' AND data_json LIKE '%\"status\":\"".$boy."%'")->queryAll();
                                echo count($b); 
                            ?></h4>
                            <h6 class="description-text"> <b>ไม่ระบุ</b> </h6>
                        </div>
                        <!-- /.description-block -->
                    </div>
                </div>
            </div>
        </div>


        <div class="card">
            <div class="card-header bg-aqua-active">
                <h3 class="card-title">ข้อมูลพื้นที่ปฏิบัติการ.</h3>
                <div class="card-options">
                    <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i
                            class="fe fe-chevron-up"></i></a>
                    <a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i
                            class="fe fe-maximize"></i></a>
                    <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
                </div>
            </div>
            <div class="card-body">
                <div class="row clearfix">
                    <div class=" col-lg-5 col-md-6">

                        <div class="card bg-aqua-active">
                            <div class="card-header" style="font-size: 100%;">
                                <!-- <h3 class="card-title">ข้อมูลพื้นที่ปฏิบัติการ</h3> -->
                                <div class="card-options">
                                    <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i
                                            class="fe fe-chevron-up"></i></a>
                                    <a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i
                                            class="fe fe-maximize"></i></a>
                                    <a href="#" class="card-options-remove" data-toggle="card-remove"><i
                                            class="fe fe-x"></i></a>
                                </div>
                            </div>
                            <div class="card-body" style="font-size: 100%;">
                                <div class="row text-center">
                                    <div class="pp col-sm-4 border-right pb-4 pt-4">
                                        <label class="mb-0" style="font-size: 100%;">พื้นที่ปฏิบัติการ</label>
                                        <h4 class="font-30 font-weight-bold text-col-blue counter" id="show_main1"></h4>
                                    </div>
                                    <div class="pp col-sm-4 border-right pb-4 pt-4">
                                        <label class="mb-0" style="font-size: 100%;">พื้นที่/กองร้อย</label>
                                        <h4 class="font-30 font-weight-bold text-col-blue counter" id="show_area"></h4>
                                    </div>
                                    <div class="pp col-sm-4 pb-4 pt-4">
                                        <label class="mb-0" style="font-size: 100%;">ข้อมูลโซน</label>
                                        <h4 class="font-30 font-weight-bold text-col-blue counter" id="show_zone"></h4>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <!-- <div class="pp col-md-12">
                                        <b style="font-size: 100%;">รายการอุปกรณ์ที่มีการเบิกจ่ายมากที่สุด 10 อันดับ</b>
                                    </div> -->
                                </div>

                                <!-- <div class="topten-list-main bg-gray">
                                    <div class="topten-no-main">ลำดับ</div>
                                    <div class="topten-name-main">รายการ</div>
                                    <div class="topten-count-main">จำนวน</div>
                                </div> -->
                                <style>

                                </style>
                            </div>
                        </div>
                        <div class="div-scrollbar">
                            <div class="card2">
                                <table>
                                    <tr class="text-center">
                                        <th>ลำดับ</th>
                                        <th>โซน</th>
                                        <th>พื้นที่/กองร้อย</th>
                                        <th>พื้นที่ปฏิบัติการ</th>
                                    </tr>

                                    <?php
                                                $i = 1;
                                                $operating_zone = Yii::$app->db->createCommand("SELECT * FROM `operating_zone`")->queryAll();
                                                foreach ($operating_zone as $value) {
                                                    $main = Yii::$app->db->createCommand("SELECT COUNT(id) AS sum FROM `operating_main` WHERE zone_id = '".$value['id']."'")->queryOne();
                                                    $area = Yii::$app->db->createCommand("SELECT COUNT(area_id) AS sum FROM `operating_area` WHERE zone_id = '".$value['id']."'")->queryOne();
                                                   
                                                ?>
                                    <tr>
                                        <td class="text-center"><?php echo $i;?></td>
                                        <td><?php echo  $value['zone_name'];?></td>
                                        <td class="text-center"><?php echo  $area['sum'];?></td>
                                        <td class="text-center"><?php echo  $main['sum'];?></td>

                                    </tr>
                                    <?php $i++; } ?>
                                </table>
                            </div>
                        </div>


                    </div>


                    <div class=" col-lg-7 col-md-12">
                        <div class="card ">
                            <div class="card-header">
                                <h3 class="card-title">แผนที่พื้นที่ปฏิบัติการ</h3>

                            </div>
                            <div class="card-body">
                                <div class="operating-view-map map-container">
                                    <iframe
                                        src="https://www.google.com/maps/d/u/0/embed?mid=1AxJEHXxmow-4mredyVnApKZSpUFtNtyD"
                                        width="100%" height="400" frameborder="0" scrolling="no" allowfullscreen=""
                                        marginheight="0" marginwidth="0"></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <div class="card">
            <div class="card-header bg-green-active">
                <h3 class="card-title">ข้อมูลองค์กร</h3>
                <div class="card-options">
                    <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i
                            class="fe fe-chevron-up"></i></a>
                    <a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i
                            class="fe fe-maximize"></i></a>
                    <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
                </div>
            </div>
            <div class="card-body">
                <div class="row clearfix">
                    <div class=" col-lg-6 col-md-12">
                        <div class="card " style="height: 383px;">
                            <div class="card-body">

                                <div id="echart-Gradient_shadow" style="height: 0px"></div>
                                <figure class="highcharts-figure">
                                    <div id="container1" style="height: 350px"></div>

                                </figure>
                            </div>
                        </div>
                    </div>

                    <div class=" col-lg-3 col-md-6">
                        <div class="card " style="height: 383px;">
                            <div class="card-body">
                                <figure class="highcharts-figure">
                                    <div id="container" style="height: 350px"></div>
                                </figure>

                            </div>
                        </div>
                    </div>

                    <div class=" col-lg-3 col-md-6">
                        <div class="card bg-green-active" style="height: 383px;">

                            <br><br><br>
                            <h4 class="text-center">สถิติองค์กร</h4>

                            <hr>
                            <div class="card-body">
                                <div class="row text-center">

                                    <div class="col-4 border-right pb-4 pt-4">
                                        <h4 class="font-30 font-weight-bold text-col-blue">
                                            <?php echo number_format(Organization::find()->count()); ?></h4>
                                        <label class="mb-0">องค์กรทั้งหมด</label>
                                    </div>
                                    <div class="col-4 border-right pb-4 pt-4">
                                        <h4 class="font-30 font-weight-bold text-col-blue">
                                            <?php echo number_format(OrganizationType::find()->count()); ?></h4>
                                        <label class="mb-0">ประเภท</label>
                                    </div>
                                    <div class="col-4 pb-4 pt-4">
                                        <h4 class="font-30 font-weight-bold text-col-blue">
                                            <?php echo $leadsCount = Organization::find()->groupBy(['province'])->count();?>
                                        </h4>
                                        <label class="mb-0">จังหวัด</label>
                                    </div>
                                </div>
                                <hr>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>





<script>
var url_organization_type = "index.php?r=site/json_organization&auth=<?=$auth?>&type=organization_type";
var json_organization_type = null;
var json_organization_type = $.ajax({
    url: url_organization_type,
    global: false,
    dataType: "json",
    async: false,
    success: function(msg) {
        return msg;
    }
}).responseJSON;
// console.log(json_organization_type);

var alldata = [];
$.each(json_organization_type, function(index) {
    alldata.push({
        name: json_organization_type[index].type,
        y: json_organization_type[index].sum
    });
});


//console.log(alldata);

var type_id = [];
$.each(json_organization_type, function(index) {
    type_id.push(json_organization_type[index].id);
});
//  console.log(type_name); marker_color

var pieColors = [];
// show_count.push('จำนวนการเข้าใช้งาน(ครั้ง)');   
$.each(json_organization_type, function(index) {
    pieColors.push(json_organization_type[index].marker_color);
});

// Build the chart
$(document).ready(function() {
    Highcharts.chart('container', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'กราฟประเภทองค์กร'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        accessibility: {
            point: {
                valueSuffix: '%'
            }
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                colors: pieColors,
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b> :<br>{point.percentage:.1f} %<br>จำนวน : {point.total}',
                },
                showInLegend: true
            }
        },
        series: [{
            name: 'Brands',
            colorByPoint: true,
            data: alldata
        }]
    })
});
</script>

<script>
var url_provinces = "index.php?r=site/json_organization&auth=<?=$auth?>&type=provinces";
var json_provinces = null;
var json_provinces = $.ajax({
    url: url_provinces,
    global: false,
    dataType: "json",
    async: false,
    success: function(msg) {
        return msg;
    }
}).responseJSON;


var showdetail = [];
$.each(json_provinces, function(index) {
    showdetail.push({
        name: json_provinces[index].name,
        y: json_provinces[index].sum
    });
});
// echartvalue(showdetail);
// console.log(showdetail);

var provinces = [];
$.each(json_provinces, function(index) {
    provinces.push(json_provinces[index].name);
});
//console.log(provinces);
var provinces_id = [];
$.each(json_provinces, function(index) {
    provinces_id.push(json_provinces[index].id);
});

var sum_provinces = [];
// show_count.push('จำนวนการเข้าใช้งาน(ครั้ง)');   
$.each(json_provinces, function(index) {
    sum_provinces.push(json_provinces[index].sum);
});



// Gradient shadow
$(function() {
    var dom = document.getElementById("echart-Gradient_shadow");
    var myChart = echarts.init(dom);
    var app = {};
    option = null;
    var dataAxis =
        provinces; //['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T'];
    var data =
        sum_provinces; //[220, 182, 191, 234, 290, 330, 310, 123, 442, 321, 90, 149, 210, 122, 133, 334, 198, 123, 125, 220];
    var yMax = dataShadow;
    var dataShadow = [];

    for (var i = 0; i < data.length; i++) {
        dataShadow.push(yMax);
    }

    option = {
        title: {
            text: 'จำนวนองค์กรในแต่ละจังหวัด',
            // subtext: 'Feature Sample: Gradient Color, Shadow, Click Zoom'
        },
        grid: {
            left: '5%',
            right: '5%',
            bottom: '5%',
        },
        accessibility: {
            announceNewData: {
                enabled: true
            }
        },
        xAxis: {
            data: dataAxis,
            axisLabel: {
                inside: true,
                textStyle: {
                    color: '#111'
                }
            },
            axisTick: {
                show: false,
            },
            axisLine: {
                show: false,
            },
            z: 10
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Population (millions)',
                align: 'high'
            },
            labels: {
                overflow: 'justify'
            }
        },
        dataZoom: [{
            type: 'inside'
        }],
        tooltip: {
            valueSuffix: ' millions'
        },
        plotOptions: {
            bar: {
                dataLabels: {
                    enabled: true
                }
            }
        },

        series: [{ // For shadow
                type: 'bar',
                itemStyle: {
                    normal: {
                        color: 'rgba(0,0,0,0.05)'
                    }
                },
                barGap: '-100%',
                barCategoryGap: '40%',
                data: dataShadow,
                animation: true
            },
            {
                type: 'bar',
                itemStyle: {
                    normal: {
                        color: new echarts.graphic.LinearGradient(
                            0, 0, 0, 1,
                            [{
                                    offset: 0,
                                    color: '#28a745'
                                },
                                {
                                    offset: 0.5,
                                    color: '#e4bd51'
                                },
                                {
                                    offset: 1,
                                    color: '#e4bd51'
                                }
                            ]
                        )
                    },
                    // emphasis: {
                    //     color: new echarts.graphic.LinearGradient(
                    //         0, 0, 0, 1,
                    //         [{
                    //                 offset: 0,
                    //                 color: '#1b6079'
                    //             },
                    //             {
                    //                 offset: 0.7,
                    //                 color: '#1b6079'
                    //             },
                    //             {
                    //                 offset: 1,
                    //                 color: '#e4bd51'
                    //             }
                    //         ]
                    //     )
                    // }
                },
                data: data
            }
        ]
    };
    // Enable data zoom when user click bar.
    var zoomSize = 6;
    myChart.on('click', function(params) {
        console.log(dataAxis[Math.max(params.dataIndex - zoomSize / 2, 0)]);
        myChart.dispatchAction({
            type: 'dataZoom',
            startValue: dataAxis[Math.max(params.dataIndex - zoomSize / 2, 0)],
            endValue: dataAxis[Math.min(params.dataIndex + zoomSize / 2, data.length - 1)]
        });
    });;
    if (option && typeof option === "object") {
        myChart.setOption(option, true);
    }


    // Create the chart
    Highcharts.chart('container1', {
        chart: {
            type: 'column'
        },
        colors: ['#00a65a'],
        title: {
            text: 'กราฟแสดงจำนวนองค์กรแต่ละจังหวัด'
        },
        subtitle: {
            text: ''
        },
        accessibility: {
            announceNewData: {
                enabled: true
            }
        },
        xAxis: {
            type: 'category'
        },
        yAxis: {
            title: {
                text: ''
            }

        },
        legend: {
            enabled: false
        },
        plotOptions: {
            series: {
                borderWidth: 0,
                dataLabels: {
                    enabled: true,
                    format: '{point.y} องค์กร'
                }
            }
        },

        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y} องค์กร</b><br/>'
        },

        series: [{
            name: "จังหวัด",
            colorByPoint: false,
            data: showdetail
        }],
    });

});
</script>


<script type="text/javascript">
$(document).ready(function() {

    $.ajax({
        url: "index.php?r=site/json-operating&type=view_operating_main&auth=<?php echo $auth?>",
        method: "GET",
        "dataType": "json",
        success: function(data) {
            $(".loading-alert").css("display", "block");
            setTimeout(function() {
                $(".loading-alert").css("display", "none");
                view_operating_main(data);
            }, 3000);
        }
    });

    function view_operating_main(data) {
        var dataSet = data;
        datatable = $('#show_view').DataTable({
            "language": {
                "lengthMenu": "แสดง &nbsp; _MENU_ &nbsp; จำนวน",
                "zeroRecords": "ไม่พบข้อมูล",
                "info": "แสดงข้อมูลจาก _START_ ถึง _END_ จำนวน _TOTAL_ รายการ",
                "infoEmpty": "ไม่มีรายการ",
                "search": "ค้นหา : &nbsp;",
                "searchPlaceholder": "กรอกคำค้น",
                "infoFiltered": "(ค้นหาจากทั้งหมด _MAX_ รายการ)",
                "paginate": {
                    "first": "หน้าแรก",
                    "last": "หน้าสุดท้าย",
                    "next": "ถัดไป",
                    "previous": "ก่อนหน้า"
                },
            },
            "pageLength": 10,
            "lengthMenu": [
                [15, 50, 80, 100, -1],
                [15, 50, 80, 100, "ทั้งหมด"]
            ],
            data: dataSet,
            destroy: true,
            columns: [{
                    title: "ลำดับ"
                },
                {
                    title: "รายการ"
                },
                {
                    title: "รายละเอียด"
                },
                {
                    title: "หมายเหตุ"
                },
                {
                    title: "จัดการ"
                }
            ],
            'columnDefs': [{
                    "targets": [0],
                    "data": "no",
                    "className": "text-center",
                    "width": "5%"
                },
                {
                    "targets": [1],
                    "data": "name",
                    "width": "30%"
                },
                {
                    "targets": [2],
                    "data": "detail",
                    "width": "30%"
                },
                {
                    "targets": [3],
                    "data": "remark",
                    "width": "20%"
                },
                {
                    "targets": [4],
                    "data": "link",
                    "width": "10%"
                }
            ],
            dom: 'Bfrtip',
            select: true,
            buttons: [{
                    text: 'Select all',
                    action: function() {
                        table.rows().select();
                    }
                },
                {
                    text: 'Select none',
                    action: function() {
                        table.rows().deselect();
                    }
                }
            ],
        });


    }

    $('#myInputTextField').keyup(function() {
        datatable.search($(this).val()).draw();
    });


    var url_count = "index.php?r=site/json-operating&type=operating_counts&auth=<?php echo $auth?>";

    var json_count = null;
    var json_count = $.ajax({
        url: url_count,
        global: false,
        dataType: "json",
        async: false,
        success: function(msg) {
            return msg;
        }
    }).responseJSON;

    $("#show_main").html(json_count.main);
    $("#show_main1").html(json_count.main);
    $("#show_area").html(json_count.area);
    $("#show_zone").html(json_count.zone);


});
</script>


<script>
var url_Terrorist_type = "index.php?r=site/json_organization&auth=<?=$auth?>&type=Terrorist_type";
var json_Terrorist_type = null;
var json_Terrorist_type = $.ajax({
    url: url_Terrorist_type,
    global: false,
    dataType: "json",
    async: false,
    success: function(msg) {
        return msg;
    }
}).responseJSON;
//  console.log(json_Terrorist_type); 

var c = json_Terrorist_type[0].sum;

var type_name = [];
$.each(json_Terrorist_type, function(index) {
    type_name.push(json_Terrorist_type[index].name);
});

var type_id = [];
$.each(json_Terrorist_type, function(index) {
    type_id.push(json_Terrorist_type[index].id);
});


var type_count = [];
$.each(json_Terrorist_type, function(index) {
    type_count.push(json_Terrorist_type[index].count);
});

var type_sum = [];
$.each(json_Terrorist_type, function(index) {
    type_sum.push(json_Terrorist_type[index].sum);
});


// circle chart multiple
$(document).ready(function() {

    var options = {
        chart: {
            height: 300,
            type: 'radialBar',
        },
        colors: ['#e4bd51', '#e8769f', '#6c7989', '#9aa2ac', '#00a65a'],
        plotOptions: {
            radialBar: {
                dataLabels: {
                    name: {
                        fontSize: '22px',
                    },
                    value: {
                        fontSize: '16px',
                    },
                    total: {
                        show: true,
                        label: 'Total',
                        formatter: function(w) {
                            // By default this function returns the average of all series. The below is just an example to show the use of custom formatter function
                            return c
                        }
                    }
                }
            }
        },
        series: type_count, //type_count
        labels: type_name,
    }
    var chart = new ApexCharts(
        document.querySelector("#chart_donut1"),
        options
    );
    chart.render();
});
</script>