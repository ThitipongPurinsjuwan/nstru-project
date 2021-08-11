<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\TypePlaceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'ประเภทสถานที่');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="type-place-index">

   <h4><?= Html::encode($this->title) ?></h4>
    <div class="row clearfix">
        <div class="col-xl-12 col-lg-12 col-md-12">
            <div class="card card-success">
                <div class="card-body ribbon">
                    <p>
                        <?= Html::a(Yii::t('app', 'เพิ่มข้อมูล'), ['create','type'=>$type], ['class' => 'btn btn-success']) ?>
                    </p>

    <?php Pjax::begin(); ?>
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            'name:ntext',
             'name_eng:ntext',
            
            //  [
            //                         'attribute'=>'status',
            //                         'format'=>'raw',    
            //                         'value' => function($model)
            //                         {
            //                             if(!empty($model->status))
            //                             {
            //                                 return ($model->status==0) ? 'ปิดใช้งาน':'เปิดใช้งาน';
            //                             }
            //                         },
            //                     ],
            // 'images:ntext',
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
            // 'date_create',
             [
                                    'attribute'=>'date_create',
                                    'format'=>'raw',    
                                    'value' => function($model)
                                    {
                                        if(!empty($model->date_create))
                                        {
                                            return DateThaiTime($model->date_create);
                                        }
                                    },
                                ],
            //'user_create',

            // ['class' => 'yii\grid\ActionColumn'],
               ['class' => 'yii\grid\ActionColumn',
                                'buttons' => [
                                    'view' => function ($url, $model, $key) {
                                        return Html::a('<i class="fas fa-eye"></i>',
                                            ['view', 'id' => $model->id],['title' => 'View','class'=>'btn btn-light']
                                        );
                                    },
                                    'update' => function ($url, $model, $key) {

                                        return Html::a('<i class="fas fa-pencil-alt"></i>',
                                            ['update', 'id' => $model->id],['title' => 'Update','class'=>'btn btn-light']
                                        );
                                    },
                                    'delete' => function ($url, $model, $key) {
                                       
                                        return  '<button type="button" class="btn btn-light deldata" data-id="'.$model->id.'"><i class="fas fa-trash"></i></button>';//Html::a('<i class="fas fa-trash"></i>','class'=>'btn btn-light']); งง
                                        

                                    },

                                ],
                                'options'=> ['style'=>'width:20%;'],
                            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>
    </div>
    </div>
    </div>
    </div>

</div>

<div class="modal fade bd-example-modal-sm" id="showselect_type" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <!-- <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">เลือกประเภทสถานที่ที่ต้องการย้ายข้อมูล</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div> -->
      <div class="modal-body">
        <select id="selectnew_type" class="form-control"></select>
        <p id="selectnewtype_error" style="font-weight:bold;color:red;"></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
        <button type="button" class="btn btn-primary savenewtype">บันทึก</button>
      </div>
    </div>
  </div>
</div>



<script>
let iddel = '';
$(document).on('click', '.deldata', function() {
    iddel = $(this).data("id");
        if (confirm("ต้องการยกเลิกประเภทสถานที่ใช่หรือไม่?")) {
            if (confirm("ต้องการลบข้อมูลทั้งหมดที่อยู่ในประเภทนี้เลยใช่หรือไม่?")) {
            var url = "index.php?r=type-place/delete-all&id="+iddel;
var form = $('<form action="' + url + '" method="post">' +'</form>');
$('body').append(form);
$(form).submit();
            
            }else{
                     $.ajax({
                        url: "index.php?r=type-place/select-type&id="+iddel,
                        method: "GET",
                        dataType: 'json',
                        success: function(data) {
                            let show_select = `<option value="">เลือกประเภทสถานที่ใหม่</option>`;
                            data.forEach(e => {
                                show_select += `<option value="${e.id}">${e.name} (${e.name_eng})</option>`;
                            });
                            $("#selectnew_type").html(show_select);
                        }
                    });

                    $('#showselect_type').modal('show');
            }
        }
    });

    $(document).on('click', '.savenewtype', function() {
        let newtype_id = $("#selectnew_type option:selected").val(); 
        if(newtype_id!=''){
            $('#showselect_type').modal('hide');
            $('#selectnewtype_error').html('');
            var url = "index.php?r=type-place/delete-and-change&id="+iddel+"&newtype="+newtype_id;
var form = $('<form action="' + url + '" method="post">' +'</form>');
$('body').append(form);
$(form).submit();

        }else{
            $('#selectnewtype_error').html('กรุณาเลือกประเภทสถานที่ที่ต้องการย้ายข้อมูล');
        }
    });
</script>
