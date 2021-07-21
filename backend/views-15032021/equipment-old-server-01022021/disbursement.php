<?php

use yii\helpers\Html;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\EquipmentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'ข้อมูลการเบิกจ่ายอุปกรณ์');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'ข้อมูลอุปกรณ์'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
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
<h4><?= Html::encode($this->title) ?></h4>

<div class="row clearfix">
    <div class="col-6 col-md-4 col-xl-2">
        <div class="card">
            <div class="card-body ribbon">
                <div class="ribbon-box green">=</div>
                <a href="#" class="my_sort_cut text-muted">
                    <i class="icon-layers"></i>
                    <span>-</span>
                </a>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-4 col-xl-2">
        <div class="card">
            <div class="card-body ribbon">
                <div class="ribbon-box orange">-</div>
                <a href="#" class="my_sort_cut text-muted">
                    <i class="icon-folder-alt"></i>
                    <span>-</span>
                </a>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-4 col-xl-2">
        <div class="card">
            <div class="card-body ribbon">
                <div class="ribbon-box pink">-</div>
                <a href="#" class="my_sort_cut text-muted">
                    <i class="icon-share-alt"></i>
                    <span>-</span>
                </a>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-4 col-xl-2">
        <div class="card">
            <div class="card-body ribbon">
                <div class="ribbon-box indigo">-</div>
                <a href="#" class="my_sort_cut text-muted">
                    <i class="icon-layers"></i>
                    <span>-</span>
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
	<div class="card-body">
        <div class="row">
            <label for="myInputTextField" class="col-sm-1 col-form-label">ค้นหา :</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" id="myInputTextField" placeholder="กรอกคำค้น">
            </div>
        </div>
        <hr>

        <div class="table-responsive">
            <table id="show_view" class="table table-hover js-basic-example dataTable table_custom border-style spacing5">
            </table>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        var view_equipment_sn = [];
        $.ajax({
            url:"index.php?r=site/json_add_equipment&type=view_equipment_sn",
            method:"GET",
            "dataType": "json",
            success:function(data)
            {
                console.log(data);
                show_equipment_sn(data);
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
                {
                    title: "หมายเลขอุปกรณ์"
                }
                ],
                'columnDefs': [
                {
                    "targets": [0],
                    "data" : "no",
                    "className": "text-center",
                    "width" : "10%"
                },
                {
                    "targets": [1],
                    "data" : "equipment_main",
                    "width" : "40%"
                },
                {
                    "targets": [2],
                    "data" : "serial_number",
                    "width" : "40%"
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