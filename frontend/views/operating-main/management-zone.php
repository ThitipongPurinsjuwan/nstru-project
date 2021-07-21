<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\OperatingMainSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'ข้อมูลโซน(Zone)');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'ข้อมูลพื้นที่ปฏิบัติการ'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$token = "2ffa459adcc37176dbf93a82addf61dc";
$auth = "Authenticator=>".$token."".date("Ymd");

?>
<link rel="stylesheet" href="../../html-version/assets/css/style_operating.css"/>
<script type="text/javascript" src="../../datatable/jquery-3.5.1.js"></script>
<script type="text/javascript" src="../../datatable/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="../../datatable/dataTables.bootstrap4.min.js"></script>
<style>
    .dataTables_paginate > ul.pagination > li {
        padding: 0px !important;
    }
    .dataTables_wrapper .dataTables_filter{
        display: none !important;
    }
</style>
<div class="operating-main-index">

    <div class="row clearfix">
        <div class="col-md-12">
            <h4><?= Html::encode($this->title) ?></h4>
        </div>
    </div>
    

    <!--  
<div class="row clearfix">
    <div class="col-md-12 col-md-4 col-xl-8 text-right">
                <a class="btn btn-success" href="index.php?r=eform-template/create"> <i class="fe fe-plus" data-toggle="tooltip" title="" data-original-title="fe fe-plus"></i> สร้างแบบฟอร์ม [ต้นแบบ]</a>
                <a class="btn btn-success" href="index.php?r=user-role"> จัดการสิทธิ์แบบฟอร์ม</a>
    </div>
</div>
-->
    
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12">
            <div class="card card-info">
                <div class="card-body">
                    <div class="row">
                        <label for="myInputTextField" class="col-md-1 col-form-label">ค้นหา :</label>
                        <div class="col-md-5">
                            <input type="text" class="form-control" id="myInputTextField" placeholder="กรอกคำค้น">
                        </div>
                        <div class="col-md-6">
                            <div class="operating-float-right">
                                <!-- <a href="index.php?r=operating-main/report-zone-all">
                                    <span class="tag operating-btn-create mb-3" style="cursor: pointer;">
                                        รายละเอียกข้อมูลโซนทั้งหมด
                                    </span>
                                </a> -->
                                <a class="btn btn-outline-primary" href="index.php?r=operating-main/report-zone-all"> <i class="fa fa-map"></i> รายละเอียดข้อมูลโซนทั้งหมด</a>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="loading-alert">
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        กำลังโหลดข้อมูล...
                    </div>
                    <div class="table-responsive">
                        <table id="show_view" class="table table-hover js-basic-example dataTable table_custom border-style spacing5">
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){

        $.ajax({
            url:"index.php?r=site/json-operating&type=view_operating_zone&auth=<?php echo $auth?>",
            method:"GET",
            "dataType": "json",
            success:function(data)
            {
                $(".loading-alert").css("display", "block");
                setTimeout(function(){
                    $(".loading-alert").css("display", "none");
                    view_operating_main(data);
                },3000);
            }
        });

        function view_operating_main(data)
        {
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
                        "first":      "หน้าแรก",
                        "last":       "หน้าสุดท้าย",
                        "next":       "ถัดไป",
                        "previous":   "ก่อนหน้า"
                    },
                },
                "pageLength": 10,
                "lengthMenu": [ [15, 50, 80, 100, -1], [15, 50, 80, 100, "ทั้งหมด"] ],
                data: dataSet,
                destroy: true,
                columns: [
                {
                    title: "ลำดับ"
                },
                {
                    title: "รายการ"
                },
                // {
                //     title: "รายละเอียด"
                // },
                {
                    title: "พื้นที่/กองร้อย"
                },
                 {
                    title: "พื้นที่ปฏิบัติการ"
                },
                // {
                //     title: "หมายเหตุ"
                // },
                {
                    title: "จัดการ"
                }
                ],
                'columnDefs': [
                {
                    "targets": [0],
                    "data" : "no",
                    "className": "text-center",
                    "width" : "2%"
                },
                {
                    "targets": [1],
                    "data" : "name",
                    "width" : "20%"
                },
                // {
                //     "targets": [2],
                //     "data" : "detail",
                //     "width" : "20%"
                // },
                {
                    "targets": [2],
                    "data" : "count_area",
                    "className": "text-center",
                    "width" : "5%"
                },
                 {
                    "targets": [3],
                    "data" : "count_main",
                    "className": "text-center",
                    "width" : "5%"
                },
                // {
                //     "targets": [5],
                //     "data" : "remark",
                //     "width" : "10%"
                // },
                {
                    "targets": [4],
                    "data" : "link",
                    "width" : "5%"
                }
                ],
                dom: 'Bfrtip',
                select: true,
                buttons: [{
                    text: 'Select all',
                    action: function () {
                        table.rows().select();
                    }
                },
                {
                    text: 'Select none',
                    action: function () {
                        table.rows().deselect();
                    }
                }
                ],
            });


        }

        $('#myInputTextField').keyup(function(){
            datatable.search($(this).val()).draw() ;
        });


        var url_count = "index.php?r=site/json-operating&type=operating_counts&auth=<?php echo $auth?>";

        var json_count = null;
        var json_count = $.ajax({
            url: url_count,
            global: false,
            dataType: "json",
            async:false,
            success: function(msg){
            return msg;
            }
  }).responseJSON;

        $("#show_main").html(json_count.main);
        $("#show_area").html(json_count.area);
        $("#show_zone").html(json_count.zone);


    });
</script>
