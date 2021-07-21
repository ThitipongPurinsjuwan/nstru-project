<?php

use yii\helpers\Html;
use app\models\Unit;
use app\models\Undercover;
use app\models\Users;
use app\models\EformTemplate;
use app\models\EformData;


/* @var $this yii\web\View */
/* @var $searchModel frontend\models\EquipmentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Dashboard สายข่าว');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'ข้อมูลสายข่าว'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$Undercover = Undercover::find()->COUNT();
$UndercoverY = Undercover::find()->where(["status" => '1' ])->COUNT();
$UndercoverN = Undercover::find()->where(["status" => '0' ])->COUNT();
$type_qu = Yii::$app->db->createCommand("SELECT * FROM `equipment_type` WHERE id = '".$equipment['type']."'")->queryOne();
$unit = Yii::$app->db->createCommand("SELECT * FROM unit ORDER BY unit_id ASC")->queryAll();

?>
<link rel="stylesheet" href="../../html-version/assets/css/style_equipment.css" />
<h4><?= Html::encode($this->title);?></h4>
<div class="row clearfix">
    <div class="col-6 col-md-6 col-xl-4">
        <div class="card card-success ">
            <div class="card-body card-height">
                <b><i class="icon-pie-chart equipment-icon equipment-icon-skyblue"></i>
                    <span>สายข่าวทั้งหมด</span></b>
                <div class="equipment-dash-count"><?php echo $Undercover; ?> </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-6 col-xl-4">
        <div class="card card-success ">
            <div class="card-body card-height">
                <b><i class="icon-drawer equipment-icon equipment-icon-green"></i>
                    <span>สายข่าวที่ปฏิบัติหน้าที่</span></b>
                <div class="equipment-dash-count"><?php echo $UndercoverY; ?> </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-6 col-xl-4">
        <div class="card card-success ">
            <div class="card-body card-height">
                <b><i class="icon-equalizer equipment-icon equipment-icon-red"></i>
                    <span>สายข่าวที่หยุดปฏิบัติหน้าที่</span></b>
                <div class="equipment-dash-count">
                    <?php 
                    if ($UndercoverN == '') {
                       echo '0';
                    } else {
                        echo $UndercoverN; 
                    }
                   ?>
                </div>
            </div>
        </div>
    </div>
    <!-- <div class="col-6 col-md-6 col-xl-3">
        <div class="card card-primary ">
            <div class="card-body card-height">
                <b><i class="icon-folder equipment-icon equipment-icon-yellow"></i>
                    <span>สถิติภาพรวม</span></b>
                <div class="equipment-list-title">เบิกจ่าย
                    <div class="equipment-list-count equipment-list-count-one" id="disbursement"></div>
                </div>
                <div class="equipment-list-title">ยังไม่ส่งคืน
                    <div class="equipment-list-count equipment-list-count-two" id="not_repatriate"></div>
                </div>
                <div class="equipment-list-title">ส่งคืนแล้ว
                    <div class="equipment-list-count equipment-list-count-three" id="repatriate"></div>
                </div>
            </div>
        </div>
    </div> -->
</div>

<div class="row">
    <!-- <div class="col-md-6">
        <div class="card card-primary ">
            <div class="card-status card-status-left bg-aqua"></div>
            <div class="card-body equipment-dash-height">
                <div class="row">
                    <div class="col-md-12">
                        <b>กราฟวงกลมแสดงข้อมูลอุปกรณ์แบ่งตามประเภท</b>
                    </div>
                    <div class="col-md-12">
                        <div id="echart-Customized_Pie" style="height: 200px;width: auto;overflow-x: auto;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card card-primary ">
            <div class="card-status card-status-left bg-aqua"></div>
            <div class="card-body equipment-dash-height">
                <div class="row">
                    <div class="col-md-12">
                        <b>สถิติข้อมูลอุปกรณ์</b>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="stat-card card-primary ">
                                    <div>ทั้งหมด(รายการ)</div>
                                    <div id="equipment_sn"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="stat-card card-primary ">
                                    <div>อยู่ระหว่างเบิกจ่าย(รายการ)</div>
                                    <div id="equipment_dis"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="stat-card card-primary ">
                                    <div>ชำรุด/เสียหาย(รายการ)</div>
                                    <div id="equipment_damaged"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="stat-card card-primary ">
                                    <div>ส่งซ่อม(รายการ)</div>
                                    <div id="equipment_repair"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card card-success ">
            <div class="card-status card-status-left bg-green"></div>
            <div class="card-body equipment-dash-height-topten">
                <div class="row">
                    <div class="col-md-12">
                        <b>สายข่าวที่ส่งข่าวมากที่สุด 10 อันดับ</b>
                    </div>
                </div>
                <div class="topten-list-main">
                    <div class="topten-no-main">ลำดับ</div>
                    <div class="topten-name-main">ชื่อ</div>
                    <div class="topten-count-main">จำนวน(รายการ)</div>
                </div>
                <div id="show_toptenequipment"></div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card card-success ">
            <div class="card-status card-status-left bg-green"></div>
            <div class="card-body equipment-dash-height-topten">
                <div class="row">
                    <div class="col-md-12">
                        <b>สายข่าวที่มีระดับความน่าเชื่อถือมากที่สุด 10 อันดับ</b>
                    </div>
                </div>
                <div class="topten-list-main">
                    <div class="topten-no-main">ลำดับ</div>
                    <div class="topten-name-main">ชื่อ</div>
                    <div class="topten-count-main">ระดับความน่าเชื่อถือ</div>
                </div>
                <div id="show_toptenunit"></div>
            </div>
        </div>
    </div>
</div>

<!-- <div class="card card-primary ">
    <div class="card-body equipment-dash-height-topten">
        <div class="row">
            <div class="col-md-12">
                <b>กราฟเส้นแสดงข้อมูลจำนวนสายข่าวแต่ละหน่วยงาน</b>
            </div>
            <div id="chart-area" style="height: 16rem"></div>
        </div>
    </div>
</div> -->

<script>
$(document).ready(function() {
    coutertype();

    function coutertype() {
        $.ajax({
            url: "index.php?r=site/json_stat_undercover&type=card-stat",
            method: "GET",
            dataType: "json",
            contentType: "application/json; charset=utf-8",
            success: function(data) {
                $("#equipment_all").html(data.equipment_all);
                $("#equipment_type").html(data.equipment_type);
                $("#equipment_disbursement").html(data.equipment_disbursement);
                $("#disbursement").html(data.disbursement);
                $("#not_repatriate").html(data.not_repatriate);
                $("#repatriate").html(data.repatriate);
            }
        });
    }

    equipmentstat();

    function equipmentstat() {
        $.ajax({
            url: "index.php?r=site/json_stat_undercover&type=equipment-stat",
            method: "GET",
            dataType: "json",
            contentType: "application/json; charset=utf-8",
            success: function(data) {
                $("#equipment_sn").html(data.equipment_all);
                $("#equipment_dis").html(data.equipment_dis);
                $("#equipment_damaged").html(data.equipment_damaged);
                $("#equipment_repair").html(data.equipment_repair);
            }
        });
    }

    toptenequipment();

    function toptenequipment() {
        var show_toptenequipment = [];
        $.ajax({
            url: "index.php?r=site/json_stat_undercover&type=topten-equipment",
            method: "GET",
            dataType: "json",
            contentType: "application/json; charset=utf-8",
            success: function(data) {
                console.log(data);
                $.each(data, function(i) {
                    show_toptenequipment.push(`<div class="topten-list">
											<div class="topten-no">${data[i].no}</div>
											<div class="topten-name">${data[i].equipment_name}</div>
											<div class="topten-count">${data[i].sum}</div>
											</div>`);
                });
                $("#show_toptenequipment").html(show_toptenequipment.join(""));
            }
            
        });
    }

    toptenunit();

    function toptenunit() {
        var show_toptenunit = [];
        $.ajax({
            url: "index.php?r=site/json_stat_undercover&type=topten-unit",
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

    var url_count_months = "index.php?r=site/json_stat_undercover&type=count-year";

    var json_count_months = null;
    var json_count_months = $.ajax({
        url: url_count_months,
        global: false,
        dataType: "json",
        async: false,
        success: function(msg) {
            return msg;
        }
    }).responseJSON;

    var show_months = [];
    $.each(json_count_months, function(index) {
        show_months.push(json_count_months[index].months);
    });

    var show_count = [];
    show_count.push('จำนวนการเข้าใช้งาน(ครั้ง)');
    $.each(json_count_months, function(index) {
        show_count.push(json_count_months[index].sum);
    });

    var chart = c3.generate({
        bindto: '#chart-area',
        data: {
            columns: [
                show_count,
            ],
            type: 'line',
            colors: ['#ffc107'],

            names: ['จำนวนการเข้าใช้งาน(ครั้ง)'],
        },
        axis: {
            x: {
                type: 'category',
                categories: show_months,
            },

        },
        legend: {},
        padding: {
            bottom: 0,
            top: 0
        },

    });

    var showdetail = [];
    var echart = null;
    var echart = $.ajax({
        url: "index.php?r=site/json_stat_undercover&type=type",
        method: "GET",
        dataType: "json",
        contentType: "application/json; charset=utf-8",
        success: function(data) {
            $.each(data, function(i) {
                showdetail.push({
                    value: data[i].value,
                    name: data[i].name,
                });
            });
            echartvalue(showdetail);
        }
    });

    function echartvalue(showdetail) {
        var data_type = showdetail;

        var dom = document.getElementById("echart-Customized_Pie");
        var myChart = echarts.init(dom);
        var app = {};
        option = null;
        option = {
            //backgroundColor: '#fffff',
            title: {
                left: 'center',
                top: 20,
                textStyle: {
                    color: anchor.colors["gray-200"],
                }
            },
            tooltip: {
                trigger: 'item',
                formatter: "{a} <br/>{b} : {c} รายการ ({d}%)"
            },

            visualMap: {
                show: false,
                min: 80,
                max: 600,
                inRange: {
                    // colorLightness: [0, 1]
                    color: ['#E4BD51']
                }
            },
            series: [{
                name: 'ข้อมูลรายการ',
                type: 'pie',
                radius: '55%',
                center: ['50%', '50%'],
                data: data_type.sort(function(a, b) {
                    return a.value - b.value;
                }),
                roseType: 'radius',
                label: {
                    normal: {
                        textStyle: {
                            color: '#1b6079',
                        }
                    }
                },
                labelLine: {
                    normal: {
                        lineStyle: {
                            color: '#1b6079',
                        },
                        smooth: 0.2,
                        length: 10,
                        length2: 20
                    }
                },
                itemStyle: {
                    normal: {
                        color: '#fed284',
                        shadowBlur: 200,
                        shadowColor: 'rgba(0, 0, 0, 0)'
                    }
                },

                animationType: 'scale',
                animationEasing: 'elasticOut',
                animationDelay: function(idx) {
                    return Math.random() * 200;
                }
            }]
        };
        if (option && typeof option === "object") {
            myChart.setOption(option, true);
        }
    }

});
</script>