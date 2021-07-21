<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Unit;
use app\models\Users;
use app\models\EformTemplate;
use app\models\EformData;


/* @var $this yii\web\View */
/* @var $model app\models\Undercover */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'สายข่าว', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>

<style>
.add_scrollbar {
    overflow: auto;
    height: 400px;
}

/*.feeds_widget li {
display: block !important;
}*/
.list-design {
    overflow-y: scroll;
    overflow-x: hidden;
}

.hori-timeline .events {
    border-top: 0px solid #e9ecef;
}

.events-not-action {
    border-top: 3px solid #E9ECEF;
}

.events-action {
    border-top: 3px solid #4090CB;
}

.hori-timeline .events .event-list {
    display: block;
    position: relative;
    text-align: center;
    padding-top: 70px;
    margin-right: 0;
    vertical-align: top;
}

.hori-timeline .events .event-list:before {
    content: "";
    position: absolute;
    height: 36px;
    border-right: 2px dashed #dee2e6;
    top: 0;
}

.hori-timeline .events .event-list .event-date {
    position: absolute;
    top: 38px;
    left: 0;
    right: 0;
    width: 75px;
    margin: 0 auto;
    border-radius: 4px;
    padding: 2px 4px;
}

@media (min-width: 1140px) {
    .hori-timeline .events .event-list {
        display: inline-block;
        width: <?=$width;
        ?>%;
        padding-top: 45px;
    }

    .hori-timeline .events .event-list .event-date {
        top: -12px;
    }
}

.bg-soft-primary {
    background-color: #4090CB !important;
    color: #fff !important;
}

.bg-soft-success {
    background-color: #47BD9A !important;
    color: #fff !important;
}

.bg-soft {
    background-color: #E9ECEF !important;
    color: #999 !important;
}

.card {
    border: none;
    margin-bottom: 24px;
    -webkit-box-shadow: 0 0 13px 0 rgba(236, 236, 241, .44);
    box-shadow: 0 0 13px 0 rgba(236, 236, 241, .44);
}

.text-muted {
    text-align: left;
    height: 50px;
}

.text-events-action {
    color: #4090CB;
}

.text-events-not-action {
    color: #E9ECEF;
}

#alertSuccess {
    display: none;

}

.panel-success {
    background-color: #188E49;
    color: #ffffff;
    padding: 10px;
    margin-bottom: 10px;
    border-radius: 5px;
    font-weight: 900;
}

#accept_news_success {
    background-color: #188E49;
    color: #ffffff;
    border: 1px solid #188E49;
    opacity: 1;
    display: none;
}

#accept_news_success_show {
    background-color: #188E49;
    color: #ffffff;
    border: 1px solid #188E49;
    opacity: 1;
    display: block;
}
</style>


<div class="undercover-view">

    <h4><?= Html::encode($this->title) ?></h4>
    <div class="row clearfix">
        <div class="col-xl-7 col-lg-7 col-md-7">
            <div class="card card-success">

                <div class="card-header">
                    <h3 class="card-title"><i class="fe fe-users"></i> รายละเอียดข้อมูลสายข่าว</h3>
                    <div class="card-options">
                        <a href="index.php?r=undercover/update&id=<?php echo $model->id; ?>">
                            <i class="fe fe-edit-3"></i>
                        </a>
                        <a href="index.php?r=undercover/delete&id=<?php echo $model->id; ?>"
                            data-confirm="ต้องการยกเลิกข้อมูลองค์กรนี้ใช่หรือไม่?" data-method="post">
                            <i class="fe fe-trash-2"></i>
                        </a>
                        <a href="javascript:void(0)" class="card-options-fullscreen" data-toggle="card-fullscreen"><i
                                class="fe fe-maximize"></i>
                        </a>
                    </div>
                </div>
                <div class="card-body ribbon">


                    <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
            // 'id',
            [
                'format'=>'raw',
                'attribute'=>'images',
                'value' => function($model,$index)
                {
                    if(!empty($model->images))
                    {
                        return Html::img($model->photoViewer,['class'=>'img-thumbnail','style'=>'width:200px;', "onerror"=>"this.onerror=null;this.src='img/none.png';"]);
                    }else{
                        return Html::img('@web/img/none.png',['class'=>'img-thumbnail','style'=>'width:200px;']);
                    }
                },
            ],
            'undercover_number',
            'name',
            // 'unitid',
            [
                'attribute'=>'unitid',
                'format'=>'raw',
                'value' => function($model)
                {
                    if($model->unitid != '000'){
                        $unit = Unit::find()->where(["unit_id" => $model->unitid ])->One(); //Yii::$app->db->createCommand("SELECT * FROM unit WHERE unit_id = '".$model->unitid."'")->queryOne();
                        return $unit['unit_name'];
                    } else {
                        return '-';
                    }
                },
            ],
            // 'images:ntext',
            [
                'attribute'=>'status',
                'label'=>'สิทธิ์การเข้าใช้งานระบบ',
                'format'=>'raw',
                'value' => function($model, $key)
                {

                    if ($model->status=='1') {
                        return 'ปฏิบัติงาน';
                    }else{
                        return 'หยุดปฏิบัติงาน';
                    }


                },
            ],
            'email:email',
            'address:ntext',
            'phone',
             ],
                ]) ?>

                </div>
            </div>
        </div>
        <div class="col-xl-5 col-lg-5 col-md-5">
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">
                        <dt><i class="fe fe-home"></i> ข้อมูลหน่วยงาน</dt>
                    </h3>
                    <div class="card-options">
                        <a href="index.php?r=unit/view&id=<?php echo $model->unitid; ?>">
                            <i class="fe fe-file-text"></i>
                        </a>
                        <a href="javascript:void(0)" class="card-options-fullscreen" data-toggle="card-fullscreen">
                            <i class="fe fe-maximize"></i>
                        </a>
                    </div>
                </div>

                <div class="card-body">


                    <h5 class="">
                        <dt>ชื่อหน่วยงาน : <?php  if($model->unitid != '000'){
                                                    $unit = Unit::find()->where(["unit_id" => $model->unitid ])->One(); 
                                                    echo $unit['unit_name'];
                                                } else {
                                                    echo '-';
                                                }
                                                 ?></dt>
                    </h5>
                    <div class="div-scrollbar">

                        <label for="">
                            <dt>รายละเอียดหน่วยงาน</dt>

                            <small class="d-block text-muted">
                                <?php 
                                    $unit = Unit::find()->where(["unit_id" => $model->unitid ])->One(); 
                                    echo $unit['unit_detail'];
                                    ?>
                            </small>
                        </label>

                        <!-- <label for="">
                            <dt>ผู้ดูแลหน่วยงาน</dt>

                            <small class="d-block text-muted">
                                <?php 
                                    $user = Users::find()->where(["unit_id" => $model->unitid ,"role" => '2'  ])->All(); // Yii::$app->db->createCommand("SELECT * FROM users WHERE unit_id = '".$model->unitid."' AND role = '2'")->queryAll();
                                    $show = '';
                                    foreach ($user as $value) {
                                        $show .= '<a href="#" onclick="window.open(\'index.php?r=users/view&id='.$value['id'].'\', \'blank\');">'.$value['name'].'</a>, ';
                                    }
                                    $show_all = substr_replace($show, "", -2);

                                    echo (empty($show_all)) ? 'ไม่มีผู้ดูแลหน่วย' : $show_all;
                                    ?>
                            </small>
                        </label> -->
                        <!-- <div class="row mt-2">
                            <div class="col-5 py-1"><strong>ผู้ใช้งานทั้งหมด:</strong></div>
                            <div class="col-7 py-1">
                                <a onclick="window.open('index.php?r=users/index&unitid=<?=$model->unitid;?>');"
                                    href="#"><?php echo $cusers = Users::find()->where(["unit_id" => $model->unitid])->COUNT(); //Yii::$app->db->createCommand("SELECT COUNT(*) FROM `users` WHERE unit_id = '".$model->unitid."'")->queryScalar();
				                        ?>
                                </a>
                                <span class="ml-3">คน</span>
                            </div>
                            <div class="col-5 py-1"><strong>แบบฟอร์ม:</strong></div>
                            <div class="col-7 py-1">
                                <small class="d-block text-muted">
                                    <?php
                                $eform_template =  EformTemplate::find()->where(["unit_id" => $model->unitid,"disable" => '0'])->All(); //Yii::$app->db->createCommand("SELECT * FROM eform_template WHERE unit_id LIKE '%\"".$model->unitid."\"%' AND disable = '0'")->queryAll();
                                $showeform_template = '';
                                foreach ($eform_template as $value) {
                                    $showeform_template .= '- <a href="#" onclick="window.open(\'index.php?r=site/pages&view=eform_template&form_id='.$value['id'].'\', \'blank\');">'.$value['detail'].'</a><br>';
                                }
                                $show_all_eform = substr_replace($showeform_template, "", -4);

                                echo (empty($show_all_eform)) ? 'ไม่มีแบบฟอร์มที่เข้าถึงได้' : $show_all_eform;
                                ?>
                                </small>
                            </div>
                            <div class="col-5 py-1"><strong>จำนวนข้อมูลที่บันทึกทั้งหมด:</strong></div>
                            <div class="col-7 py-1"><strong>
                                    <?php $eform_data = Yii::$app->db->createCommand("SELECT COUNT(eform_data.id) FROM eform,eform_data WHERE eform.unit_id = '".$model->unitid."' AND eform.id = eform_data.eform_id")->queryScalar(); 
                                    echo number_format($eform_data);
                                    ?> <span class="ml-3">รายการ</span>
                                </strong></div>

                            <div class="col-5 py-1"><strong>จำกัดผู้แลหน่วย:</strong></div>
                            <div class="col-7 py-1"><strong>
                                    <?php $admin_limit = Unit::find()->where(["unit_id" => $model->unitid])->One();
                                      echo number_format($admin_limit['admin_limit']);
                                    ?>
                                </strong><span class="ml-3">คน</span></div>
                            <div class="col-5 py-1"><strong>จำกัดผู้ใช้งานหน่วย:</strong></div>
                            <div class="col-7 py-1"><strong>
                                    <?php $user_limit = Unit::find(["user_limit"])->where(["unit_id" => $model->unitid])->One();
                                      echo number_format($user_limit['user_limit']);
                                    ?>
                                </strong> <span class="ml-3">คน</span></div>
                            <div class="col-5 py-1"><strong>จำกัดสายข่าวหน่วย:</strong></div>
                            <div class="col-7 py-1"><strong>
                                    <?php $undercover_limit = Unit::find(["undercover_limit"])->where(["unit_id" => $model->unitid])->One();
                                      echo number_format($undercover_limit['undercover_limit']);
                                    ?>
                                </strong> <span class="ml-3">คน</span></div>
                        </div>-->


                    </div>

                </div>

            </div>

            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">
                        <dt><i class="fe fe-award"></i> ระดับความน่าเชื่อถือ</dt>
                    </h3>
                    <div class="card-options">
                        <!-- <a href="index.php?r=unit/view&id=<?php echo $model->unitid; ?>">
                            <i class="fe fe-file-text"></i>
                        </a> -->
                        <a href="javascript:void(0)" class="card-options-fullscreen" data-toggle="card-fullscreen">
                            <i class="fe fe-maximize"></i>
                        </a>
                    </div>
                </div>

                <div class="card-body text-center">
             <h6><dt> ความน่าเชื่อถือของ : <?php echo $model->name; ?></dt> <br> <dt>อยู่ในระดับ : <?php echo $model->trust; ?></dt> </h6>
                
                    <!-- <div id="apex-stroked-gauge"></div> -->
                </div>
            </div>

            <div class="card card-collapsed card-success">
                <!-- <div class="card-status card-status-left bg-blue"></div> -->
                <div class="card-header">
                    <h3 class="card-title">
                        <dt><i class="fe fe-monitor"></i> ประวัติการส่งข่าว</dt>
                    </h3>
                    <div class="card-options">
                        <a href="#" class="card-options-collapse" data-toggle="card-collapse">
                            <i class="fe fe-chevron-up"></i>
                        </a>
                        <a href="javascript:void(0)" class="card-options-fullscreen" data-toggle="card-fullscreen">
                            <i class="fe fe-maximize"></i>
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row mt-2">
                        <div class="col-5 py-1">
                            <h6><strong>ประเภทข่าว</strong></h6>
                        </div>
                        <div class="col-7 py-1">
                            <h6><strong>ข่าวที่รายงาน</strong></h6>
                        </div>
                        <?php  $count = 0;
                                $eform_template =  EformTemplate::find()->where(["disable" => '0' ,'approve_type' => [1, 2]])->All(); // "unit_id" => $model->unitid,Yii::$app->db->createCommand("SELECT * FROM eform_template WHERE unit_id LIKE '%\"".$model->unitid."\"%' AND disable = '0'")->queryAll();
                                $showeform_template = '';
                                foreach ($eform_template as $value) {
                                    // $showeform_template .= '- <a href="#" onclick="window.open(\'index.php?r=site/pages&view=eform_template&form_id='.$value['id'].'\', \'blank\');">'.$value['detail'].'</a><br>';
                                // echo $value['detail'].' :'.'<br>';
                               
                                // $show_all_eform = substr_replace($showeform_template, "", -4);

                                // echo (empty($show_all_eform)) ? 'ไม่มีแบบฟอร์มที่เข้าถึงได้' : $show_all_eform;
                                ?>

                        <div class="col-5 py-1"><strong><?php echo $value['detail'];?> : </strong></div>
                        <div class="col-7 py-1">
                            <?php
                           
                                $eform_data =  EformData::find()->where(["eform_id" => $value['id']])->All(); // "unit_id" => $model->unitid,Yii::$app->db->createCommand("SELECT * FROM eform_template WHERE unit_id LIKE '%\"".$model->unitid."\"%' AND disable = '0'")->queryAll();
                                // $showeform_template = '';
                                foreach ($eform_data as $row) {
                                    $data_edata = @json_decode($row['data_json'],TRUE);
                                    $val_eform = $data_edata[0];
                                    // var_dump($val_eform);
                                    if ($val_eform['undercover_name'] == $model->name ) :

                                        $count+= 1;
                                ?>
                                
                            - <a
                                href="index.php?r=eform-data/view&id=<?=$row['id']?>"><?php echo  $val_eform['topic']; ?></a>
                            <br>

                            <?php 
                             else  :
                                // echo  'ไม่มีข้อมูล';
                            endif
                            ?>
                            <?php  } ?>
                        </div>

                        <?php  } ?>
                    </div>
                </div>

            </div>


        </div>
    </div>

   

</div>

<?php // echo $count;
$trust = ($model->trust*100)/10;
?>

<script>
// stroked gauge
$(document).ready(function() {
    var trust = '<?=$trust?>'; // สร้างตัวแปรมารับก่อนนะครับ
    // console.log(trust);
    var options = {
        chart: {
            height: 250,
            type: 'radialBar',
        },
        colors: ['#004660'],

        plotOptions: {
            radialBar: {
                startAngle: -135,
                endAngle: 135,
                dataLabels: {
                    name: {
                        fontSize: '16px',
                        color: undefined,
                        offsetY: 120
                    },
                    value: {
                        offsetY: 76,
                        fontSize: '22px',
                        color: undefined,
                        formatter: function(val) {
                            return val + "%";
                        }
                    }
                }
            }
        },
        fill: {
            type: 'gradient',
            gradient: {
                shade: 'dark',
                shadeIntensity: 0.15,
                inverseColors: false,
                opacityFrom: 1,
                opacityTo: 1,
                stops: [0, 50, 65, 91]
            },
        },
        stroke: {
            dashArray: 4
        },
        series: [trust],
        labels: ['ความน่าเชื่อถือของสายข่าว'],

    }

    var chart = new ApexCharts(
        document.querySelector("#apex-stroked-gauge"),
        options
    );

    chart.render();

    // window.setInterval(function () {
    //     chart.updateSeries([Math.floor(Math.random() * (100 - 1 + 1)) + 1])
    // }, 2000) 
});
</script>

<script>
 $(document).ready(function() {

// var id = <?php echo $_GET['id']; ?>;
var id = '<?php echo $model->name; ?>';
$.ajax({
        method: "GET",
        url: 'index.php?r=site/link-timeline-undercover',
        data: {
            id: id
        },
    })
    .done(function(msg) {
        $('#timeline').html(msg);
    })

});
</script>

<div id="timeline"></div>
<!-- <iframe src="index.php?r=site/link-timeline-tab" width="100%" height="500px;" 
style="border:0px solid black;"></iframe> -->