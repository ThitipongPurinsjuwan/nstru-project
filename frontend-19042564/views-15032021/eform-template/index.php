<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\models\EformTemplateType;
use app\models\DescModal;
use yii\helpers\ArrayHelper;
use yii\widgets\ListView;
use yii\data\ActiveDataProvider;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EformTemplateSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'แบบฟอร์มป้อนข้อมูล - จัดการ Form Template';
$this->params['breadcrumbs'][] = $this->title;
?>

<style>
.empty{
    width: 100%;
    padding: 0em 1em;
}
</style>
<div class="eform-template-index">

    <div class="row clearfix">
        <div class="col-6 col-md-4 col-xl-2">
            <div class="card card-success">
                <div class="card-body ribbon">
                    <?php $count_eform_template = Yii::$app->db->createCommand("SELECT COUNT(*) FROM eform_template ORDER BY id ASC")->queryScalar(); ?>
                    <div class="ribbon-box green"><?=$count_eform_template;?></div>
                    <a href="index.php?r=eform-template/create" class="my_sort_cut text-muted">
                        <i class="icon-layers"></i>
                        <span>สร้างแบบฟอร์ม [ต้นแบบ] </span>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-4 col-xl-2">
            <div class="card card-success">
                <div class="card-body ribbon">
                    <?php $count_user_role = Yii::$app->db->createCommand("SELECT COUNT(*) FROM user_role ORDER BY id ASC")->queryScalar(); ?>
                    <div class="ribbon-box orange"><?=$count_user_role;?></div>
                    <a href="index.php?r=user-role" class="my_sort_cut text-muted">
                        <i class="icon-user-following"></i>
                        <span>จัดการสิทธิ์แบบฟอร์ม</span>
                        <br>
                    </a>
                </div>
            </div>
        </div>
        <!--<div class="col-6 col-md-4 col-xl-2">
            <div class="card">
                <div class="card-body ribbon">
                    <div class="ribbon-box orange"><?=$count_user_group = Yii::$app->db->createCommand("SELECT COUNT(*) FROM user_group ORDER BY id ASC")->queryScalar(); ?></div>
                    <a href="index.php?r=user-group" class="my_sort_cut text-muted">
                        <i class="icon-users"></i>
                        <span>เพิ่มกลุ่มผู้ใช้งาน</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-4 col-xl-2">
            <div class="card">
                <div class="card-body ribbon">
                    <div class="ribbon-box orange"><?=$count_unit = Yii::$app->db->createCommand("SELECT COUNT(*) FROM unit ORDER BY unit_id ASC")->queryScalar(); ?>
                </div>
                <a href="index.php?r=unit" class="my_sort_cut text-muted">
                    <i class="icon-grid"></i>
                    <span>เพิ่มหน่วยงาน<br><br></span>
                </a>
            </div>
        </div>
    </div>
     <div class="col-6 col-md-4 col-xl-2">
        <div class="card">
            <div class="card-body">
                <a href="index.php?r=users/create" class="my_sort_cut text-muted">
                    <i class="icon-user-follow"></i>
                    <span>เพิ่มผู้ดูแลระบบ<br>ของหน่วยงาน</span>
                </a>
            </div>
        </div>
    </div>

    <div class="col-6 col-md-4 col-xl-2">
        <div class="card">
            <div class="card-body">
                <a href="hr-report.html" class="my_sort_cut text-muted">
                    <i class="icon-pie-chart"></i>
                    <span>รายงาน<br><br></span>
                </a>
            </div>
        </div>
    </div> -->

</div>


<!-- DropDown -->
<!--<div class="row clearfix" style="float:right;">
<div  class="btn-group" role="group" aria-label="Button group with nested dropdown">
  <div class="btn-group" role="group" >
    <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      เลือก
    </button>
    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
      <a class="dropdown-item" href="#">เพิ่มแบบฟอร์มใหม่</a>
      <a class="dropdown-item" href="#">Dropdown link</a>
    </div>
  </div>
</div>
</div>
 DropDown -->

<?php 

Pjax::begin();
?>
<div class="row clearfix">
    
    <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card card-success">
            <div class="card-header">
                <h2 class="card-title"><dt>บริหารจัดการ - แบบฟอร์ม</dt></h2>
                <div class="card-options">
                    <?php
                    //$desc_modal = Yii::$app->db->createCommand("SELECT COUNT(*) AS checkrow , id FROM `desc_modal` WHERE `id` = 1 AND status='0' ")->queryone();
                    function getDesc($id){
                        $desctopic = DescModal::find()->where(['id' => 1])->one()->topic;
                        $desc = DescModal::find()->where(['id' => 1])->one()->description;

                        return $desctopic.'<br>'. $desc;
                    }
                    ?>          
                    <?php /* if ($desc_modal['checkrow']>0): ?>
                        <a class="btn-question goDoSomething" id="desc-model" data-id-desc="<?=$desc_modal['id'];?>" data-toggle="modal" data-target=".bd-modal-manual">
                            <i class="fa fa-question" data-toggle="tooltip" data-placement="top" title="คู่มือการใช้งาน
                            "></i>
                        </a>
                    <?php endif */ ?>
                    <button type="button" class="btn btn-secondary" data-toggle="tooltip" data-html="true" title="<?=getDesc(1)?>">
                    ?
                    </button>

                </div>
            </div>
            <div class="card-body ribbon">
                <?php
                echo $this->render('_search', ['model' => $searchModel]);
                ?>
            </div>
        </div>
    </div>
</div>


<?php
$columns = 3;
$cl = 12 / $columns;

echo ListView::widget([
    'dataProvider' => $dataProvider,
    'layout'       => '{items}{pager}',
    'itemOptions'  => ['class' => "col-md-$cl"],
    'itemView'     => '_listtemplate',
    'options'      => ['class' => 'grid-list-view row' ],
    'emptyText' => '<div class="row"><div class="card p-3 col-md-12">No results.</div></div>',
    'pager' => [
      'options' =>[
        'class' => 'pagination col-md-12'],
    ],
]);

?>
<?php Pjax::end(); ?>

</div>
