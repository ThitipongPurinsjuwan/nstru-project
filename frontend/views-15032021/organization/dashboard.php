<?php

use yii\helpers\Html;
use app\models\Organization;
use app\models\OrganizationType;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\EquipmentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Dashboard องค์กร');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'ข้อมูลองค์กร'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$equipment = Yii::$app->db->createCommand("SELECT * FROM `equipment` WHERE id = '".$_GET['id']."'")->queryOne();
$type_qu = Yii::$app->db->createCommand("SELECT * FROM `equipment_type` WHERE id = '".$equipment['type']."'")->queryOne();
$unit = Yii::$app->db->createCommand("SELECT * FROM unit ORDER BY unit_id ASC")->queryAll();

$token = "2ffa459adcc37176dbf93a82addf61dc";
$auth = "Authenticator=>".$token."".date("Ymd");
?>


<link rel="stylesheet" href="../../html-version/assets/css/style_equipment.css" />
<script src="../../js/highcharts.js"></script>
<script src="../../js/exporting.js"></script>
<script src="../../js/export-data.js"></script>
<script src="../../js/accessibility.js"></script>

<style>
.highcharts-figure,
.highcharts-data-table table {
    min-width: 320px;
    max-width: 660px;
    margin: 1em auto;
}

.highcharts-data-table table {
    font-family: Verdana, sans-serif;
    border-collapse: collapse;
    border: 1px solid #EBEBEB;
    margin: 10px auto;
    text-align: center;
    width: 100%;
    max-width: 500px;
}

.highcharts-data-table caption {
    padding: 1em 0;
    font-size: 1.2em;
    color: #555;
}

.highcharts-data-table th {
    font-weight: 600;
    padding: 0.5em;
}

.highcharts-data-table td,
.highcharts-data-table th,
.highcharts-data-table caption {
    padding: 0.5em;
}

.highcharts-data-table thead tr,
.highcharts-data-table tr:nth-child(even) {
    background: #f8f8f8;
}

.highcharts-data-table tr:hover {
    background: #f1f7ff;
}
</style>
<h4><?= Html::encode($this->title);?></h4>
<!-- <button style="float:right;">AAA</button> -->
<div class="row clearfix">
    <div class="col-6 col-md-6 col-xl-4">
        <div class="card bg-green-gradient">
            <div class="card-body card-height ">
                <b><i class="icon-pie-chart equipment-icon equipment-icon-skyblue"></i>
                    <span>องค์กรทั้งหมด</span></b>
                <div class="equipment-dash-count"><?php echo number_format(Organization::find()->count()); ?></div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-6 col-xl-4">
        <div class="card bg-green-active">
            <div class="card-body card-height">
                <b><i class="icon-drawer equipment-icon equipment-icon-green"></i>
                    <span>ประเภทขององค์กร</span></b>
                <div class="equipment-dash-count"><?php echo number_format(OrganizationType::find()->count()); ?></div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-6 col-xl-4">
        <div class="card bg-green-gradient">
            <div class="card-body card-height">
                <b><i class="icon-equalizer equipment-icon equipment-icon-red"></i>
                    <span>จำนวนจังหวัดขององค์กร</span></b>
                <div class="equipment-dash-count">

                    <?php echo $leadsCount = Organization::find()->groupBy(['province'])->count();?>
                </div>
            </div>
        </div>
    </div>
    
</div>

<div class="row">

    <div class="col-md-6">
        <div class="card card-success" style="height: 492px;">
            <!-- <div class="card-header">
                <h3 class="card-title">ประเภทขององค์กร</h3>
            </div> -->
            <div class="card-body">
                <figure class="highcharts-figure">
                    <div id="container"></div>
                    <!-- <p class="highcharts-description">
                        This pie chart shows how the chart legend can be used to provide
                        information about the individual slices.
                    </p> -->
                </figure>
                <!-- <div id="chart-pie" style="height: 16rem"></div>
                 <div id="echart-Customized_Pie" style="height: 16rem"></div> 
                <div class="mt-12">
                    <span class="chart_3">2,5,8,3,6,9,4,5,6,3</span>
                </div>  
            </div> -->
            </div>
        </div>

    </div>
    <!-- </div>


    <div class="row"> -->
    <div class="col-md-6">
        <div class="card card-success" style="height: 492px;">


            <div class="card-body">
                <!-- <div id="chart-bar-stat" style="height: 16rem"></div> -->
                <div id="echart-Gradient_shadow" style="height: 400px"></div>

            </div>
        </div>
    </div>
</div>

<div class="card card-success" style="height: 494px;">
    <div class="card-body equipment-dash-height">
        <h5 class="">แผนที่แสดงตำแหน่งที่ตั้งองค์กร</h5>
        <div class="row">
            <div class="col-md-12">

                <link data-require="leaflet@0.7.3" data-semver="0.7.3" rel="stylesheet"
                    href="../../leaflet-0.7.3/leaflet.css" />
                <script data-require="leaflet@0.7.3" data-semver="0.7.3" src="../../leaflet-0.7.3/leaflet.js">
                </script>


                <div id="mapshow" style="border-radius: 5px; width: 100%; height: 424px; margin-top: 11px;"></div>

                <script>
                $(document).ready(function() {

                    var url_json_map = "index.php?r=site/json_organization&auth=<?=$auth?>&type=all";
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
                    // console.log(json_map);





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
                            var map1 = data[i].marker_color;
                            var res = map1.substring(1, 7);
                            L.marker([data[i].lat, data[i].lon], {
                                    icon: new L.Icon({
                                        iconAnchor: [12, 26],
                                        // iconUrl: '../../upload_file/marker/icon_marker.png',
                                        iconUrl: `https://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=%E2%80%A2|${res}&chf=a,s,ee00FFFF`,
                                    })
                                }).addTo(map)
                                .bindPopup(`
					<a href="index.php?r=organization/view&id=${data[i].id}"><b>หน่วย : ${data[i].name}</b></a>
					<br>
                    ประเภทองค์กร : ${data[i].type}<br>
				    ที่ตั้ง : ${data[i].address}<br>หมู่ที่ : ${data[i].village}<br>ตำบล : ${data[i].district}<br>อำเภอ : ${data[i].amphure}<br>จังหวัด : ${data[i].province}<br>
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
                            var url_json = "index.php?r=unit/map_marker&type=search&unitname=" +
                                name +
                                "&unitid=" + id;

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
        </div><br><br><br>
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
console.log(json_organization_type);

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
            text: 'กราฟแสดงข้อมูลองค์กรแบ่งตามประเภท'
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
                    enabled: false
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


// SIMPLE DONUT
$(document).ready(function() {
    var options = {
        chart: {
            height: 250,
            type: 'radialBar',
            toolbar: {
                show: true
            }
        },
        colors: ['#fed284'],
        plotOptions: {
            radialBar: {
                startAngle: -135,
                endAngle: 225,
                hollow: {
                    margin: 0,
                    size: '70%',
                    background: '#fff',
                    image: undefined,
                    imageOffsetX: 0,
                    imageOffsetY: 0,
                    position: 'front',

                    dropShadow: {
                        enabled: true,
                        top: 3,
                        left: 0,
                        blur: 4,
                        opacity: 0.24
                    }
                },
                track: {
                    background: '#fff',
                    strokeWidth: '67%',
                    margin: 0, // margin is in pixels
                    dropShadow: {
                        enabled: true,
                        top: -3,
                        left: 0,
                        blur: 4,
                        opacity: 0.35
                    }
                },

                dataLabels: {
                    showOn: 'always',
                    name: {
                        offsetY: -10,
                        show: true,
                        color: '#888',
                        fontSize: '17px'
                    },
                    value: {
                        formatter: function(val) {
                            return parseInt(val);
                        },
                        color: '#111',
                        fontSize: '36px',
                        show: true,
                    }
                }
            }
        },
        fill: {
            type: 'gradient',
            gradient: {
                shade: 'dark',
                type: 'horizontal',
                shadeIntensity: 0.5,
                gradientToColors: ['#1b6079'],
                inverseColors: true,
                opacityFrom: 1,
                opacityTo: 1,
                stops: [0, <?php echo number_format(Organization::find()->count()); ?> + 3]
            }
        },
        series: [<?php echo number_format(Organization::find()->count()); ?>],
        stroke: {
            lineCap: 'round'
        },
        labels: ['organization'],
    }

    var chart = new ApexCharts(
        document.querySelector("#apex-circle-gradient"),
        options
    );

    chart.render();

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
//console.log(json_provinces);

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
    var yMax = 10;
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
        xAxis: {
            data: dataAxis,
            axisLabel: {
                inside: true,
                textStyle: {
                    color: '#fff'
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
            axisLine: {
                show: false,
                color: anchor.colors["gray-100"],
            },
            axisTick: {
                show: false
            },
            axisLabel: {
                textStyle: {
                    color: anchor.colors["gray-500"],
                }
            },
        },
        dataZoom: [{
            type: 'inside'
        }],
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
                                    color: '#1b6079'
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
                    emphasis: {
                        color: new echarts.graphic.LinearGradient(
                            0, 0, 0, 1,
                            [{
                                    offset: 0,
                                    color: '#1b6079'
                                },
                                {
                                    offset: 0.7,
                                    color: '#1b6079'
                                },
                                {
                                    offset: 1,
                                    color: '#e4bd51'
                                }
                            ]
                        )
                    }
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

});
</script>