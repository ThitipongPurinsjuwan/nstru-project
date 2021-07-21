<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\OperatingMainSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'ข้อมูลพื้นที่ปฏิบัติการ');
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

    <div class="row clearfix">
        <div class="col-lg-3 col-md-6">
        <a href="index.php?r=operating-main" class="operating-cursor text-muted">
            <div class="card">
                <div class="card-body w_sparkline operating-card-height">
                    <div class="details">
                        <span>ข้อมูลพื้นที่ปฏิบัติการ</span>
                        <h3 class="mb-0 counter" id="show_main"></h3> รายการ
                    </div>
                    <div class="operating-icon">
                        <i class="fe fe-map-pin operating-font-blue"></i>
                    </div>
                </div>
            </div>
        </a>    
        </div>
        <div class="col-lg-3 col-md-6">
        <a href="index.php?r=operating-main" class="operating-cursor text-muted">
            <div class="card">
                <div class="card-body w_sparkline operating-card-height">
                   <div class="details">
                    <span>ข้อมูลพื้นที่/กองร้อย</span>
                    <h3 class="mb-0 counter" id="show_area"></h3> รายการ
                </div>
                <div class="operating-icon">
                   <i class="fe fe-home operating-font-green"></i>
                </div>
           </div>
       
       </div> 
       </a> 
   </div>
   <div class="col-lg-3 col-md-6">
    <a href="index.php?r=operating-main/management-zone" class="operating-cursor text-muted">
        <div class="card">
            <div class="card-body w_sparkline operating-card-height">
                <div class="details">
                    <span>ข้อมูลโซน</span>
                    <h3 class="mb-0 counter" id="show_zone"></h3> รายการ
                </div>
                <div class="operating-icon">
                    <i class="fe fe-flag operating-font-red"></i>
                </div>
            </div>
        </div>
    </a>
</div>
<div class="col-lg-3 col-md-6">
    <a href="index.php?r=organization/report" class="operating-cursor text-muted">
        <div class="card">
            <div class="card-body w_sparkline operating-card-height">
                <div class="details">
                    <span>Dashboard</span>
                    <h6 class="mb-0">สถิติข้อมูลพื้นที่ปฏิบัติการ</h6><br>
                </div>
                <div class="operating-icon">
                    <i class="fe fe-pie-chart operating-font-yellow"></i>
                </div>
            </div>
        </div>
    </a>
</div>
</div>
<div class="row clearfix">
    <div class="col-md-12">
        <div class="card card-info">
            <div class="card-body">
                <div class="row">
                    <label for="myInputTextField" class="col-md-1 col-form-label">ค้นหา :</label>
                    <div class="col-md-5">
                        <input type="text" class="form-control" id="myInputTextField" placeholder="กรอกคำค้น">
                    </div>
                    <div class="col-md-6">
                        <div class="operating-float-right">
                            <a href="index.php?r=operating-main/create">
                                <span class="tag operating-btn-create mb-3" style="cursor: pointer;">
                                    <i class="fe fe-plus-square"></i> เพิ่มข้อมูลพื้นที่ปฏิบัติการ
                                </span>
                            </a>
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
            url:"index.php?r=site/json-operating&type=view_operating_main&auth=<?php echo $auth?>",
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
                    title: "พื้นที่ปฏิบัติการ"
                },
                // {
                //     title: "รายละเอียด"
                // },
                {
                    title: "หมายเหตุ"
                },
                {
                    title: "จัดการ"
                }
                ],
                'columnDefs': [
                {
                    "targets": [0],
                    "data" : "no",
                    "className": "text-center",
                    "width" : "5%"
                },
                {
                    "targets": [1],
                    "data" : "name",
                    "width" : "20%"
                },
                // {
                //     "targets": [2],
                //     "data" : "detail",
                //     "width" : "30%"
                // },
                {
                    "targets": [2],
                    "data" : "remark",
                    "width" : "30%"
                },
                {
                    "targets": [3],
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
