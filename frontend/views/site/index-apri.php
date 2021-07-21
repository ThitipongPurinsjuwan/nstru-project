<?php
use app\models\Setting;
use app\models\FileUploadList;
use frontend\models\MenuMain;
use frontend\models\MenuSub;

$token = "2ffa459adcc37176dbf93a82addf61dc";
$auth = "Authenticator=>".$token."".date("Ymd");

//$this->title = 'วันนี้คุณต้องการทำอะไร?';
// $this->params['breadcrumbs'][] = $this->title;
?>
<link rel="stylesheet" href="../../html-version/assets/css/style_equipment.css" />
<?php

/* @var $this yii\web\View */

$this->title = 'TextX';
?>



<style>
    .avatar-xl {
        width: 3rem;
        height: 3rem;
        line-height: 4rem;
        font-size: 1.75rem;
        margin-top: 5px;
    }

    .top_counter .icon i {
        color: #fff;
        margin-top: 14px;
    }

    #sortable-row {
        list-style: none;
    }

    #sortable-row li {
        margin-bottom: 4px;
        padding: 10px;
        background-color: #e3e3e3;
        cursor: move;
        color: #212121;
        width: 100%;
        border-radius: 3px;
        border: #ccc 1px solid
    }

    #sortable-row li.ui-state-highlight {
        height: 2.5em;
        background-color: #F0F0F0;
        border: #ccc 2px dotted;
    }

    /*#manage_sort{ display: none; }*/
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
    }
</style>

<!-- <button class="button-new">ข้อมูลเพิ่มเติม</button > -->


<div class="section-body">
    <div class="container-fluid">
        <div class="row clearfix">

        <div class="row clearfix">
            <div class="col-md-12">
                <div class="mb-4 mt-3">
                    <h4>Welcome # <?=$_SESSION['user_name']?> วันนี้คุณต้องการทำอะไร?</h4>
                </div>
            </div>
        </div>
        <div class="pp col-xl-12 col-lg-12 col-md-12">
                                    <div class="card card-warning">
                                        <div class="card-header">
                                            <h3 class="card-title">กราฟแสดงสถิติการเข้าใช้งานระบบ(แยกตามเดือน) ประจำปี
                                                <?=(date("Y")+543);?></h3>
                                            </div>
                                            <div class="card-body">
                                                <div id="apex-chart-line-column"></div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="card card-warning">
                                        <div class="card-header">
                                            <h3 class="card-title">กราฟแสดงสถิติการเข้าใช้งานระบบ(แยกตามเดือน) ประจำปี
                                                <?=(date("Y")+543);?></h3>
                                            </div>
                                            <div class="card-body">
                                                <div id="apex-chart-line-column"></div>
                                            </div>
                                        </div>

                                    </div>
        </div>

</div>
</div>
</div>
                    


<div class="section-body">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="pp col-lg-3 col-md-6 col-sm-12">
                <div class="card bg-aqua">
                    <div class="card-body">
                        <div class="widgets2">
                            <div class="state">
                                <h6>ฐานข้อมูล</h6>
                                <h2><?php  echo number_format($dataAll = Yii::$app->db->createCommand("SELECT COUNT(*) FROM information_schema.tables WHERE table_schema='textx'")->queryScalar());?>
                            </h2>
                        </div>
                        <div class="icon">
                            <i class="fa fa-database"></i>
                        </div>
                    </div>
                    <div class="progress progress-sm">
                        <div class="progress-bar bg-gray-light" role="progressbar" aria-valuenow="62"
                        aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                    </div>
                    <span class="text-small">Total Database</span>
                </div>
            </div>
        </div>
        <div class="pp col-lg-3 col-md-6 col-sm-12">
            <div class="card bg-green">
                <div class="card-body">
                    <div class="widgets2">
                        <div class="state">
                            <h6>ผูใช้งาน</h6>
                            <h2>
                                <?php
                                if(isset($_GET['unitid'])){
                                    echo number_format($userAll = Yii::$app->db->createCommand("SELECT COUNT(*) FROM users WHERE unit_id = '".$_GET['unitid']."' AND  role IN ('1','2','3')")->queryScalar());
                                }else{
                                    echo number_format($userAll = Yii::$app->db->createCommand("SELECT COUNT(*) FROM users WHERE role IN ('1','2','3') ")->queryScalar());
                                }
                                ?>
                            </h2>
                        </div>
                        <div class="icon">
                            <i class="fa fa-users"></i>
                        </div>
                    </div>
                    <div class="progress progress-sm">
                        <div class="progress-bar bg-gray-light" role="progressbar" aria-valuenow="78"
                        aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                    </div>
                    <span class="text-small small-box-footer">Total Users</span>
                </div>
            </div>
        </div>
        <div class="pp col-lg-3 col-md-6 col-sm-12">
            <div class="card bg-yellow">
                <div class="card-body">
                    <div class="widgets2">
                        <div class="state">
                            <h6>หน่วยงาน</h6>
                            <h2>
                                <?php echo number_format($have_active = Yii::$app->db->createCommand("SELECT COUNT(*) FROM unit WHERE have_active = '1'")->queryScalar());
                                        // echo number_format($have_active);
                                ?>
                            </h2>
                        </div>
                        <div class="icon">
                            <i class="fa fa-building"></i>
                        </div>
                    </div>
                    <div class="progress progress-sm">
                        <div class="progress-bar bg-gray-light" role="progressbar" aria-valuenow="31"
                        aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                    </div>
                    <span class="text-small">Total Unit</span>
                </div>
            </div>
        </div>
        <div class="pp col-lg-3 col-md-6 col-sm-12">
            <div class="card bg-red">
                <div class="card-body">
                    <div class="widgets2">
                        <div class="state">
                            <h6>อุปกรณ์</h6>
                            <h2> <?php echo number_format($count_equipment = Yii::$app->db->createCommand("SELECT COUNT(*) FROM equipment ORDER BY id ASC")->queryScalar()); ?>
                        </h2>
                    </div>
                    <div class="icon">
                        <i class="fas fa-mobile-alt"></i>
                    </div>
                </div>
                <div class="progress progress-sm">
                    <div class="progress-bar bg-gray-light" role="progressbar" aria-valuenow="20"
                    aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                </div>
                <span class="text-small">Total Equipment </span>
            </div>
        </div>
    </div>
</div>
<div class="row clearfix">
    <div class="pp col-lg-3 col-md-6">
        <div class="card">
            <div class="card-body top_counter">
                <div class="icon bg-blue-active"><i class="far fa-folder-open"></i> </div>
                <div class="content">
                    <span>ไฟล์</span>
                    <h5 class="number mb-0">
                        <?php echo number_format($count_file = Yii::$app->db->createCommand("SELECT COUNT(*) FROM file_upload_list ORDER BY id ASC")->queryScalar()); ?>
                    </h5>
                </div>
            </div>
        </div>
    </div>
    <div class="pp col-lg-3 col-md-6">
        <div class="card">
            <div class="card-body top_counter">
                <div class="icon bg-teal-active"><i class="fas fa-sitemap"></i> </div>
                <div class="content">
                    <span>องค์กร</span>
                    <h5 class="number mb-0">
                        <?php echo number_format($count_organization = Yii::$app->db->createCommand("SELECT COUNT(*) FROM organization ORDER BY id ASC")->queryScalar()); ?>
                    </h5>
                </div>
            </div>
        </div>
    </div>
    <div class="pp col-lg-3 col-md-6">
        <div class="card">
            <div class="card-body top_counter">
                <div class="icon bg-olive-active"><i class="fa fa-male"></i> </div>
                <div class="content">
                    <span>ข้อมูล ผกร.</span>
                    <h5 class="number mb-0">
                        <?php echo number_format($count_zdi = Yii::$app->db->createCommand("SELECT COUNT(*) FROM eform_data WHERE form_id = '21' ORDER BY id ASC")->queryScalar()); ?>
                    </h5>
                </div>
            </div>
        </div>
    </div>
    <div class="pp col-lg-3 col-md-6">
        <div class="card">
            <div class="card-body top_counter">
                <div class="icon bg-purple-active"><i class="far fa-newspaper"></i> </div>
                <div class="content">
                    <span>สายข่าว</span>
                    <h5 class="number mb-0">
                        <?php echo number_format($undercover = Yii::$app->db->createCommand("SELECT COUNT(*) FROM undercover ORDER BY id ASC")->queryScalar()); ?>
                    </h5>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row clearfix">
    <div class="pp col-lg-3 col-md-6">
        <div class="card card-danger">
            <div class="card-body">
                <div class="card-value float-right text-warning"><i class="icon-user text-gray-pd font-30"></i>
                </div>
                <h3 class="mb-1">
                    <?php echo number_format($unit_admin = Yii::$app->db->createCommand("SELECT COUNT(unit.unit_id) FROM unit,users WHERE unit.unit_id = users.unit_id AND users.role = '2'")->queryScalar()); ?>
                </h3>
                <div>ผู้ดูแลหน่วยงาน</div>
            </div>
        </div>
        <div class="card bg-teal-pd" style="height: 459px">
            <div class="card-header">
                <h3 class="card-title">ข้อมูลการเบิกจ่ายอุปกรณ์</h3>
                <div class="card-options">
                    <!-- <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i
                        class="fe fe-chevron-up"></i></a> -->
                        <a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i
                            class="fe fe-maximize"></i></a>
                            <!-- <a href="#" class="card-options-remove" data-toggle="card-remove"><i
                                class="fe fe-x"></i></a> -->
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row text-center">
                                <div class="col-sm-4 border-right pb-4 pt-4">
                                    <label class="mb-0">การเบิกจ่าย</label>
                                    <h4 class="font-30 font-weight-bold text-col-blue counter">
                                        <?php echo number_format($disbursement = Yii::$app->db->createCommand("SELECT COUNT(*) FROM `equipment_disbursement` WHERE date_time !=''")->queryScalar());?>
                                    </h4>
                                </div>
                                <div class="col-sm-4 border-right pb-4 pt-4">
                                    <label class="mb-0">ยังไม่ส่งคืน</label>
                                    <h4 class="font-30 font-weight-bold text-col-blue counter">
                                        <?php echo number_format($not_repatriate = Yii::$app->db->createCommand("SELECT COUNT(*) FROM `equipment_disbursement` WHERE date_time_repatriate IS NULL ")->queryScalar());?>
                                    </h4>
                                </div>
                                <div class="col-sm-4 pb-4 pt-4">
                                    <label class="mb-0">ส่งคืนแล้ว</label>
                                    <h4 class="font-30 font-weight-bold text-col-blue counter">
                                        <?php echo number_format($repatriate = Yii::$app->db->createCommand("SELECT COUNT(*) FROM `equipment_disbursement` WHERE date_time_repatriate IS NOT NULL ")->queryScalar());?>
                                    </h4>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <b>รายการอุปกรณ์ที่มีการเบิกจ่ายมากที่สุด 10 อันดับ</b>
                                </div>
                            </div>
                            <div class="topten-list-main bg-gray">
                                <div class="topten-no-main">ลำดับ</div>
                                <div class="topten-name-main">รายการ</div>
                                <div class="topten-count-main">จำนวน(ครั้ง)</div>
                            </div>
                            <div class="div-scrollbar">
                                <div class="card3">
                                    <div id="show_toptenunit"></div>
                                </div>
                            </div>
                        </div>

                        <script>
                            toptenunit();

                            function toptenunit() {
                                var show_toptenunit = [];
                                $.ajax({
                                    url: "index.php?r=site/json_stat_equipment&type=topten-unit",
                                    method: "GET",
                                    dataType: "json",
                                    contentType: "application/json; charset=utf-8",
                                    success: function(data) {
                                        $.each(data, function(i) {
                                            show_toptenunit.push(`<div class="topten-list">
                                             <div class="topten-no">${data[i].no}</div>
                                             <div class="topten-name">${data[i].name}</div>
                                             <div class="topten-count">${data[i].sum}</div>
                                             </div>`);
                                        });
                                        $("#show_toptenunit").html(show_toptenunit.join(""));
                                    }
                                });
                            }
                        </script>


                    </div>
                
            </div>
            <div class="pp col-lg-3 col-md-6">
                <div class="card card-warning">
                    <div class="card-body">
                        <div class="card-value float-right text-warning"><i
                            class="icon-bar-chart text-gray-pd font-30"></i></div>
                            <h3 class="mb-1">
                                <?php $day_now = date('Y-m-d'); ?>
                                <?php echo number_format($users = Yii::$app->db->createCommand("SELECT COUNT(*) FROM `user_log_usaged`,`users` WHERE user_log_usaged.username = users.id AND users.role = '2' AND  user_log_usaged.create_date = '".$day_now."'")->queryScalar());?>
                            </h3>
                            <div>ผู้ดูแลหน่วยที่เข้าใช้งานวันนี้</div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">กราฟวงกลมประเภทผู้ใช้งาน</h3>
                            <div class="card-options">
                                
                                    <a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i
                                        class="fe fe-maximize"></i></a>
                                    

                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div id="chart-donut" style="height: 400px"></div>
                                    </div>
                                </div>
                                <script>
                                    $(document).ready(function() {

                                        var url_users = "index.php?r=site/json_stat_sadmin&auth=<?=$auth?>&type=countusers";
                                        var url_users = "index.php?r=site/json_stat_sadmin&auth=<?=$auth?>&type=countusers";

                                        var json_users = null;
                                        var json_users = $.ajax({
                                            url: url_users,
                                            global: false,
                                            dataType: "json",
                                            async: false,
                                            success: function(msg) {
                                                return msg;
                                            }
                                        }).responseJSON;
                                        $(".show_userall").html(json_users.userall);
                                        $(".show_sadmin").html(json_users.sadmin);
                                        $(".show_per_sadmin").html(json_users.per_sadmin);
                                        $(".show_admin").html(json_users.admin);
                                        $(".show_per_admin").html(json_users.per_admin);
                                        $(".show_users").html(json_users.users);
                                        $(".show_per_users").html(json_users.per_users);

                                        var chart = c3.generate({
                        bindto: '#chart-donut', // id of chart wrapper
                        data: {
                            columns: [
                                // each columns data
                                ['data1', json_users.sadmin],
                                ['data2', json_users.admin],
                                ['data3', json_users.users]
                                ],
                            type: 'donut', // default type of chart
                            colors: {
                                'data1': '#7cabd3',
                                'data2': '#92b9db',
                                'data3': '#a7c7e2'
                            },
                            names: {
                                // name of each serie
                                'data1': 'ผู้ดูแลระบบ',
                                'data2': 'ผู้ดูแลหน่วยงาน',
                                'data3': 'ผู้ใช้งานทั่วไป'
                            }
                        },
                        axis: {},
                        legend: {
                            show: true, //hide legend
                        },
                        padding: {
                            bottom: 0,
                            top: 0
                        },
                    });
                                    });
                                </script>
                
            </div>
            <div class="pp col-lg-6 col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">แผนที่แสดงที่ตั้งหน่วยงาน</h3>
                        <div class="card-options">
                          
                                <a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i
                                    class="fe fe-maximize"></i></a>
                                   
                        </div>
                    </div>
                    <div class="card-body">
                        <link data-require="leaflet@0.7.3" data-semver="0.7.3" rel="stylesheet"
                        href="../../leaflet-0.7.3/leaflet.css" />
                        <script data-require="leaflet@0.7.3" data-semver="0.7.3" src="../../leaflet-0.7.3/leaflet.js">
                        </script>


                        <div id="mapshow" style="border-radius: 5px;
                        width: 100%;
                        height: 490px;
                        margin-top: 11px;"></div>
                        <script>
                            $(document).ready(function() {

                                var map = null;

                                var url_json_map = "index.php?r=unit/map_marker&type=all";

                                var json_map = null;
                                var json_map = $.ajax({
                                    url: url_json_map,
                                    global: false,
                                    dataType: "json",
                                    async: false,
                                    success: function(msg) {
                                        return msg;
                                    }
                                }).responseJSON;

                                loadmap(json_map);

                                function loadmap(data) {

                                    map = L.map('mapshow').setView([data[0].lat, data[0].lon], 6);

                                    L.tileLayer(
                                        'https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
                                            maxZoom: 18,
                                            minZoom: 5,
                                            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
                                            '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
                                            'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
                                            id: 'mapbox/streets-v11',
                                            tileSize: 512,
                                            zoomOffset: -1
                                        }).addTo(map);

                                    for (i in data) {
                                        L.marker([data[i].lat, data[i].lon], {
                                            icon: new L.Icon({
                                                iconAnchor: [12, 26],
                                                iconUrl: '../../upload_file/marker/icon_marker.png',
                                            })
                                        }).addTo(map)
                                        .bindPopup(`
                                           <a href="index.php?r=unit/view&id=${data[i].unit_id}"><b>หน่วย : ${data[i].unit_name}</b></a>
                                           <br>
                                           ที่ตั้ง : ${data[i].address}<br>จังหวัด : ${data[i].province}<br>
                                           <b>พิกัด (${data[i].lat}, ${data[i].lon})</b>`);
                                    }
                                    var popup = L.popup();
                                }


                                $(document).on('click', '.loadmapsearch', function() {
                                    var unitname = $("#unitsearch-unit_name").val();
                                    var vv = unitname.replace(/ /g, '_');
                                    var unitid = $("#unitsearch-unit_detail").val();
                                    map.remove();
                                    $("#mapshow").html("");
                                    $("#preMap").empty();
                                    $("<div id=\"mapshow\" style=\"height: 500px;\"></div>").appendTo(
                                        "#preMap");
                                    loaddata_search(vv, unitid);

                                    function loaddata_search(name, id) {
                                        var url_json =
                                        "index.php?r=unit/map_marker&type=search&unitname=" +
                                        name + "&unitid=" + id;

                                        var json_map = null;
                                        var json_map = $.ajax({
                                            url: url_json,
                                            global: false,
                                            dataType: "json",
                                            async: false,
                                            success: function(msg) {
                                                return msg;
                                            }
                                        }).responseJSON;
                                        loadmap(json_map);
                                    }
                                });


                            });
                        </script>
                    </div>
                </div>
                
                
            </div>
        </div>
    </div>
</div>







<div class="section-body mt-3">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="pp col-lg-12">
                <div class="row clearfix">

 



                        <?php  if($_SESSION['user_role'] == "1"){ // <h1>supper_admin</h1> <br>  ?>
                            <!--  -->
                            <div class="pp col-lg-8 col-md-12">
                                <div class="card card1 card-success">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-12">
                                                <h2 class="card-title">
                                                    ข้อมูลประจำวัน
                                                </h2>
                                        <!-- <div class="card-header bg-secondary text-white">
                                            <dt>ตั้งค่าแบบฟอร์ม - ข้อมูลทั่วไป</dt>
                                        </div> -->
                                        <div class="div-scrollbar">
                                            <div class="card1">
                                                <ul class="list-group list-group-flush">
                                                    <li class="list-group-item">
                                                        <div class="menu-slot-left">จัดการแบบฟอร์ม</div>
                                                        <div class="menu-slot-right">
                                                            <a href="index.php?r=eform-template">
                                                                <span class="glyphicon glyphicon-pencil"></span>
                                                            </a>
                                                        </div>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <div class="menu-slot-left">จัดการหน่วยงาน</div>
                                                        <div class="menu-slot-right">
                                                            <a href="index.php?r=unit">
                                                                <span class="glyphicon glyphicon-pencil"></span>
                                                            </a>
                                                        </div>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <div class="menu-slot-left">จัดการผู้ใช้งาน</div>
                                                        <div class="menu-slot-right">
                                                            <a href="index.php?r=users">
                                                                <span class="glyphicon glyphicon-pencil"></span>
                                                            </a>
                                                        </div>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <div class="menu-slot-left">จัดการการเข้าถึงเมนู</div>
                                                        <div class="menu-slot-right">
                                                            <a href="index.php?r=menu-main">
                                                                <span class="glyphicon glyphicon-pencil"></span>
                                                            </a>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-12">
                                        <h2 class="card-title">
                                            ข้อมูลส่วนตัว
                                        </h2>
                                        <div class="div-scrollbar">
                                            <div class="row card1 card-profile ">

                                                <div class="col-lg-12 col-md-12">
                                                    <div class="card-body text-center">
                                                        <?php
                                                        $user = Yii::$app->db->createCommand("SELECT * FROM `users` WHERE id = '".$_SESSION['user_id']."'")->queryAll();
                                                        foreach ($user as $u) {
                                                            $role = Yii::$app->db->createCommand("SELECT * FROM `user_role` WHERE id = '".$u['role']."'")->queryOne();
                                                            $group = Yii::$app->db->createCommand("SELECT * FROM `user_group` WHERE id = '".$u['user_group']."'")->queryOne();
                                                            $unit = Yii::$app->db->createCommand("SELECT * FROM `unit` WHERE unit_id = '".$u['unit_id']."'")->queryOne();
                                                            ?>

                                                            <img class=" avatar avatar-xl "
                                                            src="../../frontend/web/uploads/<?php echo $u['images']; ?>"
                                                            alt="" />
                                                            <h5 class="mb-3"><?=$u['name'];?></h5>

                                                            <p class=""> <b>ชื่อผู้ใช้ : </b> <?=$u['username'];?>
                                                            <b>ประเภทผู้ใช้ : </b> <?=$role['role'];?>
                                                        </p>

                                                        <p class="mb-4"> <b>อีเมล : </b> <?=$u['email'];?></p>
                                                        <a href="index.php?r=users%2Fupdate&id=<?php echo $u['id']; ?>"
                                                            class="btn btn-outline-primary btn-sm"><span
                                                            class="fa fa-pencil"></span> แก้ไขข้อมูล</a>
                                                        </div>


                                                    </div>

                                                </div>

                                            <?php } ?>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>

                    <div class=" pp col-lg-4 col-md-12">
                        <div class="card card1 bg-green-pd">
                            <div class="card-header">
                                <h2 class="card-title">
                                    สถิติการเข้าใช้งาน
                                </h2>
                            </div>
                            <div class="card-body">
                                <div class="row text-center">
                                    <div class="col-sm-4 border-right pb-4 pt-4">
                                        <label class="mb-0">เข้าใช้งานวันนี้</label>
                                        <h4 class="font-30 font-weight-bold text-col-blue counter show_sadmin"></h4>
                                    </div>
                                    <div class="col-sm-4 border-right pb-4 pt-4">
                                        <label class="mb-0">เข้าใช้งานเดือนนี้</label>
                                        <h4 class="font-30 font-weight-bold text-col-blue counter show_admin"></h4>
                                    </div>
                                    <div class="col-sm-4 pb-4 pt-4">
                                        <label class="mb-0">เข้าใช้งานปีนี้</label>
                                        <h4 class="font-30 font-weight-bold text-col-blue counter show_user"></h4>
                                    </div>
                                </div>
                                <hr><br>
                                <center> <a href="index.php?r=users/view&id=<?=$_SESSION['user_id']?>"
                                    class="btn btn-outline-primary btn-sm text-center text-white">
                                    <span class="fa fa-signal"></span> ข้อมูลเพิ่มเติม</a></center>
                                </div>


                            </div>
                        </div>
                    </div>
                    <div class="row clearfix row-deck">
                        <div class="pp col-xl-12 col-lg-12 col-md-12">
                            <div class="card card-warning">
                                <div class="card-header">
                                    <h3 class="card-title">กราฟแสดงสถิติการเข้าใช้งานระบบ(แยกตามเดือน) ประจำปี
                                        <?=(date("Y")+543);?></h3>
                                    </div>
                                    <div class="card-body">
                                        <div id="apex-chart-line-column"></div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    <?php } ?>
                    <!-- sadmin -->


                    <?php  if($_SESSION['user_role'] == "2"){ // <h1>admin</h1> <br>  ?>
                        <!--  -->
                        <div class="pp col-lg-8 col-md-12">
                            <div class="card card1 card-success">
                                <?php
                                $user = Yii::$app->db->createCommand("SELECT * FROM `users` WHERE id = '".$_SESSION['user_id']."'")->queryAll();
                                foreach ($user as $u) {
                                  $role = Yii::$app->db->createCommand("SELECT * FROM `user_role` WHERE id = '".$u['role']."'")->queryOne();
                                  $group = Yii::$app->db->createCommand("SELECT * FROM `user_group` WHERE id = '".$u['user_group']."'")->queryOne();
                                  $unit = Yii::$app->db->createCommand("SELECT * FROM `unit` WHERE unit_id = '".$u['unit_id']."'")->queryOne();
                                  ?>
                                  <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-12">
                                            <h2 class="card-title">
                                                ข้อมูลประจำวัน
                                            </h2>
                                            <div class="div-scrollbar">
                                                <div class="card1">
                                                    <ul class="list-group list-group-flush">
                                                        <li class="list-group-item">
                                                            <div class="menu-slot-left">จัดการแบบฟอร์ม</div>
                                                            <div class="menu-slot-right">
                                                                <a href="index.php?r=eform/create">
                                                                    <span class="glyphicon glyphicon-pencil"></span>
                                                                </a>
                                                            </div>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <div class="menu-slot-left">จัดการผู้ใช้ในหน่วยงาน</div>
                                                            <div class="menu-slot-right">
                                                                <a href="index.php?r=users/index&unitid=<?=$unit['unit_id'];?>">
                                                                    <span class="glyphicon glyphicon-pencil"></span>
                                                                </a>
                                                            </div>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <div class="menu-slot-left">ปรับปรุงข้อมูลหน่วยงาน</div>
                                                            <div class="menu-slot-right">
                                                                <a href="index.php?r=unit/update&id=<?=$unit['unit_id'];?>">
                                                                    <span class="glyphicon glyphicon-pencil"></span>
                                                                </a>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12">
                                            <h2 class="card-title">
                                                ข้อมูลส่วนตัว
                                            </h2>
                                            <div class="div-scrollbar">
                                                <div class="row card1 card-profile">

                                                    <div class="col-lg-12 col-md-12">
                                                        <div class="card-body text-center">
                                                            <img class=" avatar avatar-xl "
                                                            src="../../frontend/web/uploads/<?php echo $u['images']; ?>"
                                                            alt="" />
                                                            <h6 class="mb-3"><?=$u['name'];?></h6>

                                                            <p class="text-left"> <b>ชื่อผู้ใช้ : </b> <?=$u['username'];?>
                                                            <b>ประเภทผู้ใช้ : </b> <?=$role['role'];?>
                                                        </p>
                                                        <p class="text-left"> <b>หน่วยงาน : </b> <?=$unit['unit_name'];?>
                                                        <b>กลุ่มผู้ใช้ : </b> <?=$group['name'];?>
                                                        (<?=$group['description'];?> )
                                                    </p>
                                                    <p class="text-left"> <b>อีเมล : </b> <?=$u['email'];?></p>
                                                    <p class="text-left">
                                                        <b>ที่ตั้งหน่วยงาน : </b>
                                                        <?=$unit['address'];?> จังหวัด <?=$unit['province'];?>
                                                    </p>
                                                    <a href="index.php?r=users%2Fupdate&id=<?php echo $u['id']; ?>"
                                                        class="btn btn-outline-primary btn-sm"><span
                                                        class="fa fa-pencil"></span> แก้ไขข้อมูล</a>
                                                        </div> <?php } ?>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="pp col-lg-4 col-md-12">
                            <div class="card card1 bg-green-gradient">
                                <div class="card-header">
                                    <h2 class="card-title">
                                        สถิติการเข้าใช้งาน
                                    </h2>
                                </div>
                                <div class="card-body">
                                    <div class="row text-center">
                                        <div class="col-sm-4 border-right pb-4 pt-4">
                                            <label class="mb-0">เข้าใช้งานวันนี้</label>
                                            <h4 class="font-30 font-weight-bold text-col-blue counter show_sadmin"></h4>
                                        </div>
                                        <div class="col-sm-4 border-right pb-4 pt-4">
                                            <label class="mb-0">เข้าใช้งานเดือนนี้</label>
                                            <h4 class="font-30 font-weight-bold text-col-blue counter show_admin"></h4>
                                        </div>
                                        <div class="col-sm-4 pb-4 pt-4">
                                            <label class="mb-0">เข้าใช้งานปีนี้</label>
                                            <h4 class="font-30 font-weight-bold text-col-blue counter show_user"></h4>
                                        </div>
                                    </div>
                                    <hr><br>
                                    <center> <a href="index.php?r=users/view&id=<?=$_SESSION['user_id']?>"
                                        class="btn btn-outline-primary btn-sm text-center text-white">
                                        <span class="fa fa-signal"></span> ข้อมูลเพิ่มเติม</a></center>
                                    </div>
                                </div>
                            </div>

                            <div class="pp col-xl-12 col-lg-12 col-md-12">
                                <div class="card card-warning">
                                    <div class="card-header">
                                        <h3 class="card-title">กราฟแสดงสถิติการเข้าใช้งานระบบ(แยกตามเดือน) ประจำปี
                                            <?=(date("Y")+543);?></h3>
                                        </div>
                                        <div class="card-body">
                                            <div id="apex-chart-line-column"></div>
                                        </div>
                                    </div>

                                </div>

                            <?php } ?>
                            <!-- admin -->


                            <?php  if($_SESSION['user_role'] == "3"){ // <h1>supper_admin</h1> <br>  ?>
                                <!--  -->
                                <div class="pp col-lg-8 col-md-12">
                                    <div class="card card1 card-success">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-lg-6 col-md-12">
                                                    <h2 class="card-title">
                                                        ข้อมูลประจำวัน
                                                    </h2>
                                                    <!-- <p><b>รายชื่อแบบฟอร์ม</b></p>  -->
                                                    <div class="div-scrollbar">
                                                        <div class="card2">
                                                            <?php
                                                            $sql = "SELECT form_id as id, detail FROM `eform` WHERE unit_id = '".$_SESSION['unit_id']."' AND active = '1' GROUP BY form_id ORDER BY detail ASC";
                                                            $eform_template = Yii::$app->db->createCommand($sql)->queryAll();
                                                            foreach($eform_template as $ef){
                                                              ?>

                                                              <ul class="list-group list-group-flush">
                                                                <li class="list-group-item">
                                                                    <div class="menu-slot-left"><?=$ef['detail']?> </div>
                                                                    <div class="menu-slot-right">
                                                                        <a
                                                                        href="index.php?r=site/pages&view=eform_information&form_id=<?=$ef['id']?>">
                                                                        <i class="fas fa-folder-plus"></i> เพิ่มข้อมูล
                                                                    </a>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12">
                                            <h2 class="card-title">
                                                ข้อมูลส่วนตัว
                                            </h2>
                                            <div class="div-scrollbar">
                                                <div class="row card1 card-profile">

                                                    <div class="col-lg-12 col-md-12">
                                                        <div class="card-body text-center">
                                                            <?php
                                                            $user = Yii::$app->db->createCommand("SELECT * FROM `users` WHERE id = '".$_SESSION['user_id']."'")->queryAll();
                                                            foreach ($user as $u) {
                                                              $role = Yii::$app->db->createCommand("SELECT * FROM `user_role` WHERE id = '".$u['role']."'")->queryOne();
                                                              $group = Yii::$app->db->createCommand("SELECT * FROM `user_group` WHERE id = '".$u['user_group']."'")->queryOne();
                                                              $unit = Yii::$app->db->createCommand("SELECT * FROM `unit` WHERE unit_id = '".$u['unit_id']."'")->queryOne();
                                                              ?>

                                                              <img class=" avatar avatar-xl "
                                                              src="../../frontend/web/uploads/<?php echo $u['images']; ?>"
                                                              alt="" />
                                                              <h5 class="mb-3"><?=$u['name'];?></h5>

                                                              <p class="text-left"> <b>ชื่อผู้ใช้ : </b> <?=$u['username'];?>
                                                              <b>ประเภทผู้ใช้ : </b> <?=$role['role'];?>
                                                          </p>
                                                          <p class="text-left"> <b>หน่วยงาน : </b> <?=$unit['unit_name'];?>
                                                          <b>กลุ่มผู้ใช้ : </b> <?=$group['name'];?>
                                                          (<?=$group['description'];?> )
                                                      </p>
                                                      <p class="text-left"> <b>อีเมล : </b> <?=$u['email'];?></p>
                                                      <p class="text-left">
                                                        <b>ที่ตั้งหน่วยงาน : </b>
                                                        <?=$unit['address'];?> จังหวัด <?=$unit['province'];?>
                                                    </p>
                                                    <a href="index.php?r=users%2Fupdate&id=<?php echo $u['id']; ?>"
                                                        class="btn btn-outline-primary btn-sm"><span
                                                        class="fa fa-pencil"></span> แก้ไขข้อมูล</a>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="pp col-lg-4 col-md-12">
                    <div class="card card1 bg-green-gradient">
                        <div class="card-header">
                            <h2 class="card-title">
                                สถิติการเข้าใช้งาน
                            </h2>
                        </div>
                        <hr>
                        <div class="card-body">
                            <div class="row text-center">
                                <div class="col-sm-4 border-right pb-4 pt-4">
                                    <label class="mb-0">เข้าใช้งานวันนี้</label>
                                    <h4 class="font-30 font-weight-bold text-col-blue counter show_sadmin"></h4>
                                </div>
                                <div class="col-sm-4 border-right pb-4 pt-4">
                                    <label class="mb-0">เข้าใช้งานเดือนนี้</label>
                                    <h4 class="font-30 font-weight-bold text-col-blue counter show_admin"></h4>
                                </div>
                                <div class="col-sm-4 pb-4 pt-4">
                                    <label class="mb-0">เข้าใช้งานปีนี้</label>
                                    <h4 class="font-30 font-weight-bold text-col-blue counter show_user"></h4>
                                </div>
                            </div>
                            <hr><br>
                            <center> <a href="index.php?r=users/view&id=<?=$_SESSION['user_id']?>"
                                class="btn btn-outline-primary btn-sm text-center text-white">
                                <span class="fa fa-signal"></span> ข้อมูลเพิ่มเติม</a></center>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row clearfix row-deck">
                    <div class="pp col-xl-12 col-lg-12 col-md-12">
                        <div class="card card-warning">
                            <div class="card-header">
                                <h3 class="card-title">กราฟแสดงสถิติการเข้าใช้งานระบบ(แยกตามเดือน) ประจำปี
                                    <?=(date("Y")+543);?></h3>
                                </div>
                                <div class="card-body">
                                    <div id="apex-chart-line-column"></div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <?php // } ?>
                    <!-- user -->



                </div>
            </div>
        </div>
    </div>
</div>





<div class="row">
    <!-- Card -->


    <? //=$_SESSION['user_role']?>





    <?php // if($_SESSION['user_role'] == "2"){ // <h1>admin</h1><br> ?>


        <?php //} ?>
        <?php // if($_SESSION['user_role'] == "3"){ // <h1>user_general</h1> ?>



        </div>





<?php } ?>

<!---->



<script>
    var url = "index.php?r=site/json_stst_index_user&auth=<?=$auth?>&type=graphweek&id=<?= $_GET['id'];?>";

    var json = null;
    var json = $.ajax({
        url: url,
        global: false,
        dataType: "json",
        async: false,
        success: function(msg) {
            return msg;
        }
    }).responseJSON;

    var showlog_date = [];
    $.each(json, function(index) {
        showlog_date.push(json[index].log_date);
    });

    var showsum = [];
    $.each(json, function(index) {
        showsum.push(json[index].sum);
    });

    $(document).ready(function() {
        var options = {
            chart: {
                height: 300,
                type: 'area',
                toolbar: {
                    show: false,
                },
            },
            colors: ['#17A2BC'],
            series: [{
                name: 'จำนวนการเข้าใช้งาน',
                type: 'area',
                data: showsum
            }],
            stroke: {
                width: [4]
            },
            labels: showlog_date,

        }
        var chart = new ApexCharts(
            document.querySelector("#apex-chart-line-column"),
            options
            );

        chart.render();
    });
</script>


<script>
    $(document).ready(function() {

        var url_users =
        "index.php?r=site/json_stst_index_user&auth=<?=$auth?>&type=countusers&id=<?= $_GET['id'];?>";

        var json_users = null;
        var json_users = $.ajax({
            url: url_users,
            global: false,
            dataType: "json",
            async: false,
            success: function(msg) {
                return msg;
            }
        }).responseJSON;
        $(".show_user_ues_all").html(json_users.useAll);
        $(".show_sadmin").html(json_users.useday);
        $(".show_per_sadmin").html(json_users.per_useday);
        $(".show_admin").html(json_users.usemonths);
        $(".show_per_admin").html(json_users.per_usemonths);
        $(".show_user").html(json_users.useyear);
        $(".show_per_users").html(json_users.per_useyear);



    });
// });
</script> 