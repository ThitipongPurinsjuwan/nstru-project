<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\OrganizationPositionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'ข้อมูลตำแหน่งภายในองค์กร';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="organization-position-index">

    <h4><?= Html::encode($this->title) ?></h4>
    <div class="row clearfix">
        <div class="col-xl-12 col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body ribbon">

                    <p>
                        <button type="button" class="btn btn-success btn-sm" id="organization-position-create" data-toggle="modal" data-target="#organization-position-modal" data-pjax="0">เพิ่มตำแหน่ง</button>
                    </p>

                    <?php Pjax::begin(['id'=>'organization-position_pjax_id','timeout'=>10000,'enablePushState' => true,'enableReplaceState' => true]); ?>
                    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                            // ['class' => 'yii\grid\SerialColumn'],

                            'position_id',
                            'position_name',

                            ['class' => 'yii\grid\ActionColumn',
                            'buttons' => [
                                'view' => function ($url, $model, $key) {
                                    return Html::a('<span class="glyphicon glyphicon-eye-open"></span>','#', [
                                        'class' => 'organization-position-view-link',
                                        'title' => 'ตำแหน่ง',
                                        'data-toggle' => 'modal',
                                        'data-target' => '#organization-position-modal',
                                        'data-id' => $key,
                                        'data-pjax' => '0',

                                    ]);
                                },
                                'update' => function ($url, $model, $key) {
                                    if ($_SESSION['user_role']=='1' || $_SESSION['user_id']==$model->user_create) {
                                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>','#', [
                                        'class' => 'organization-position-update-link',
                                        'title' => 'แก้ไขตำแหน่ง',
                                        'data-toggle' => 'modal',
                                        'data-target' => '#organization-position-modal',
                                        'data-id' => $key,
                                        'data-pjax' => '0',

                                        ]);
                                    }
                                },
                                'delete' => function ($url, $model, $key) {
                                    if ($_SESSION['user_role']=='1' || $_SESSION['user_id']==$model->user_create) {
                                        return '<a href="index.php?r=organization-position%2Fdelete&amp;id='.$model->position_id .'" data-confirm=" ต้องยกเลิกข้อมูลใช่หรือไม่?" data-method="post" data-title="Delete">
                                                        <span class="glyphicon glyphicon-trash"></span>
                                                    </a>';
                                    }
                                }

                            ],
                            'contentOptions' => ['class' => 'text-center','style' => 'width:50px;'],
                            'headerOptions' => ['class' => 'text-center','style' => 'width:50px;'],
                        ],
                    ],
                ]); ?>

                <?php Pjax::end(); ?>

            </div>
        </div>
    </div>
</div>
</div>

<!-- The Modal -->
<div class="modal" id="organization-position-modal">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
            <dt><h5 class="modal-title"></h5></dt>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">

      </div>

      <!-- Modal footer -->
      <!--   <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">ปิด</button>
      </div> -->

  </div>
</div>
</div>

<?php 

$this->registerJs('
    function init_click_handlers(){
      $("#organization-position-create").click(function(e) {
        $.get(
        "index.php?r=organization-position/create",
        function (data)
        {
            $("#organization-position-modal").find(".modal-body").html(data);
            $(".modal-body").html(data);
            $(".modal-title").html("เพิ่มตำแหน่ง");
            $("#organization-position-modal").modal("show");
        }
        );
        });

        $(".organization-position-view-link").click(function(e) {
            var fID = $(this).data("id");
            $.get(
            "index.php?r=organization-position/view&id="+fID,
            {
                id: fID
                },
                function (data)
                {
                    $("#organization-position-modal").find(".modal-body").html(data);
                    $(".modal-body").html(data);
                    $(".modal-title").html("ตำแหน่ง");
                    $("#organization-position-modal").modal("show");
                }
                );
                });


                $(".organization-position-update-link").click(function(e) {
                    var fID = $(this).closest("tr").data("key");
                    $.get(
                    "index.php?r=organization-position/update&id"+fID,
                    {
                        id: fID
                        },
                        function (data)
                        {
                            $("#organization-position-modal").find(".modal-body").html(data);
                            $(".modal-body").html(data);
                            $(".modal-title").html("แก้ไขตำแหน่ง");
                            $("#organization-position-modal").modal("show");
                        }
                        );
                        });
                    }
                    init_click_handlers();
                    $("#organization-position_pjax_id").on("pjax:success", function() {
                      init_click_handlers(); 
                      });
                      ');


                      ?>


