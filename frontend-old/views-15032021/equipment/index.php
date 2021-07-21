<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\EquipmentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'ข้อมูลอุปกรณ์');
$this->params['breadcrumbs'][] = $this->title;

$equipment = Yii::$app->db->createCommand("SELECT * FROM equipment ORDER BY id ASC")->queryAll();

?>
<link rel="stylesheet" href="../../html-version/assets/css/style_equipment.css"/>
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
<div class="equipment-index">

    <h4><?= Html::encode($this->title) ?></h4>

    <div class="row clearfix">
        <div class="col-6 col-md-4 col-xl-2">
            <div class="card">
            <div class="card-status card-status-left bg-aqua"></div>
                <div class="card-body card-height ribbon">
                    <?php $count_equipment = Yii::$app->db->createCommand("SELECT COUNT(*) FROM equipment ORDER BY id ASC")->queryScalar(); ?>
                    <div class="ribbon-box green">
                        <?=$count_equipment;?>
                    </div>
                    <a href="index.php?r=equipment%2Fcreate" class="my_sort_cut text-muted">
                        <i class="icon-layers"></i>
                        <span>เพิ่มข้อมูลอุปกรณ์</span><br>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-4 col-xl-2">
            <div class="card">
            <div class="card-status card-status-left bg-aqua"></div>
                <div class="card-body card-height ribbon">
                    <?php $count_equipment_sn = Yii::$app->db->createCommand("SELECT COUNT(*) FROM equipment_sn ORDER BY id ASC")->queryScalar(); ?>
                    <div class="ribbon-box orange"><?=$count_equipment_sn;?></div>
                    <a href="javascript:void(0)" class="my_sort_cut text-muted" data-toggle="modal" data-target="#addprosn">
                        <i class="icon-folder-alt"></i>
                        <span>เพิ่มข้อมูล<br>หมายเลขอุปกรณ์</span>
                    </a>
                </div>
            </div>
        </div>
       
        <div class="col-6 col-md-4 col-xl-2">
            <div class="card">
            <div class="card-status card-status-left bg-aqua"></div>
                <div class="card-body card-height">
                    <a href="index.php?r=equipment/equipment-approve" class="my_sort_cut text-muted">
                        <i class="icon-list"></i>
                        <span>ตรวจสอบ<br>การเบิกจ่าย</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-4 col-xl-2">
            <div class="card">
            <div class="card-status card-status-left bg-aqua"></div>
                <div class="card-body card-height">
                    <a href="index.php?r=equipment/equipment-report" class="my_sort_cut text-muted">
                        <i class="icon-note"></i>
                        <span>รายงานการเบิกจ่ายประจำวัน</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-4 col-xl-2">
            <div class="card">
            <div class="card-status card-status-left bg-aqua"></div>
                <div class="card-body card-height">
                    <a href="index.php?r=equipment/equipment-report-disbursement" class="my_sort_cut text-muted">
                        <i class="icon-bar-chart"></i>
                        <span>รายงาน<br>การเบิกจ่าย</span>
                    </a>
                </div>
            </div>
        </div>
         <div class="col-6 col-md-4 col-xl-2">
            <div class="card">
            <div class="card-status card-status-left bg-aqua"></div>
                <div class="card-body card-height">
                    <a href="index.php?r=equipment/equipment-dashboard" class="my_sort_cut text-muted">
                        <i class="icon-pie-chart"></i>
                        <span>Dashboard<br>ข้อมูลสถิติอุปกรณ์</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="card card-primary">
        <div class="card-body">
            <div class="row">
                <label for="myInputTextField" class="col-sm-1 col-form-label">ค้นหา :</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" id="myInputTextField" placeholder="กรอกคำค้น">
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

<div class="modal fade" id="addprosn" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-aqua">
                <h5 class="modal-title" id="exampleModalLabel">เพิ่มข้อมูลหมายเลขอุปกรณ์</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 multiselect_div">
                        <label for="">รายการ</label>
                        <select class="form-control multiselect multiselect-custom" id="equipment_id">
                            <?php foreach ($equipment as $eq) { ?>
                                <option value="<?php echo $eq['id']?>"><?php echo $eq['name']?></option>
                            <?php } ?>
                        </select>
                        <br>
                        <label for="">หมายเลขอุปกรณ์(Serial Number)</label>
                        <input type="text" class="form-control" id="serial_number">
                    </div>
                    <div class="col-md-12">
                        <div class="label-main label-success">บันทึกข้อมูลสำเร็จ!!</div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                <button type="button" id="add-equipment-serial-number" class="btn btn-primary">บันทึก</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $(document).on('click', '#add-equipment-serial-number', function(){
            var equipment_id = $('#equipment_id').val();
            var serial_number = $('#serial_number').val();
            $.ajax({
                url:"index.php?r=site/json_add_equipment&type=serialnumber",
                method:"GET",
                dataType:"json",
                data:{ equipment_id: equipment_id,serial_number:serial_number},
                contentType: "application/json; charset=utf-8",
                success: function(){
                    if (status == 1) {
                        console.log('false');
                    }else{
                        console.log('success');
                        $(".label-main").css("display", "block");
                        setTimeout(function(){
                            $(".label-main").css("display", "none");
                            location.reload();
                        },2000);
                        
                    }
                    
                }
            });
        });

        var view_equipment_sn = [];
        $.ajax({
            url:"index.php?r=site/json_add_equipment&type=view_equipment",
            method:"GET",
            "dataType": "json",
            success:function(data)
            {
                console.log(data);
                // show_equipment_sn(data);
                $(".loading-alert").css("display", "block");
                setTimeout(function(){
                    $(".loading-alert").css("display", "none");
                    show_equipment_sn(data);
                },3000);
            }
        });

        function show_equipment_sn(data)
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
                "pageLength": 100,
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
                {
                    title: "ประเภท"
                },
                {
                    title: "ยี่ห้อ"
                },
                {
                    title: "รุ่น"
                },
                // {
                //     title: "รายละเอียด"
                // },
                {
                    title: "จำนวนทั้งหมด"
                },
                {
                    title: "จำนวนที่เบิกจ่าย"
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
                    "width" : "3%"
                },
                {
                    "targets": [1],
                    "data" : "name",
                    "width" : "9%"
                },
                {
                    "targets": [2],
                    "data" : "type",
                    "width" : "10%"
                },
                {
                    "targets": [3],
                    "data" : "brand",
                    "width" : "10%"
                },
                {
                    "targets": [4],
                    "data" : "model",
                    "width" : "10%"
                },
                // {
                //     "targets": [5],
                //     "data" : "detail",
                //     "width" : "10%"
                // },
                {
                    "targets": [5],
                    "data" : "count",
                    "width" : "6%"
                },
                {
                    "targets": [6],
                    "data" : "dis",
                    "width" : "6%"
                },
                {
                    "targets": [7],
                    "data" : "link",
                    "width" : "9%"
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
        })

    });
</script>
