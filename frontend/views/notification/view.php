<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use app\models\NotificationType; 
use app\models\Notification; 

/* @var $this yii\web\View */
/* @var $model app\models\Notification */

$this->title = $model->topic;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'การแจ้งเตือน'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>

<style>
.button {
    background-color: #4CAF50;
    /* Green */
    border: none;
    color: white;
    padding: 16px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    transition-duration: 0.4s;
    cursor: pointer;
}

.button1 {
    background-color: white;
    color: black;
    border: 2px solid #4CAF50;
}

.button1:hover {
    background-color: #4CAF50;
    color: white;
}
</style>


<div class="notification-view">

    <h4><?= Html::encode($this->title) ?></h4>
    <div class="row clearfix">
        <div class="col-xl-12 col-lg-12 col-md-12">
            <div class="card  card-primary ">
                <div class="card-body ribbon">

                    <p>
                        <?#= Html::a(Yii::t('app', 'แก้ไข'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                        <?#= Html::a(Yii::t('app', 'ล้างค่า'), ['delete', 'id' => $model->id], [
        //     'class' => 'btn btn-danger',
        //     'data' => [
        //         'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
        //         'method' => 'post',
        //     ],
        // ]) ?>
                    </p>

                    <div class="row clearfix">
                        <div class="col-xl-8 col-lg-8 col-md-8">

                            <?= DetailView::widget([
                                    'model' => $model,
                                    'attributes' => [
                                        // 'id',
                                        [
                                            'attribute'=>'notification_type',
                                            'format'=>'raw',    
                                            'value' => function($model, $key)
                                                    {
                                                        if(!empty($model->notification_type))
                                                        {
                                                            $query = NotificationType::find()->where("id = ".$model->notification_type)->one();
                                        
                                                            return $query->type;
                                                        }
                                                    },
                                        ],
                                        'topic',
                                        'content',
                                        'date_time',
                                        [
                                            'attribute' => 'user',
                                            'format' => 'raw',
                                            'value' => function ($model, $key) {
                                                if ($_SESSION['user_role']=='1'){
                                                if (!empty($model->user)) {
                                                    $user = str_replace('"',"'",$model->user);
                                                    $user_name =  Yii::$app->db->createCommand("SELECT * FROM users WHERE id IN (".$user.")")->queryAll();
                                                    $valla_show = array(); 
                                                        foreach ($user_name as $row_villa){
                                                            $valla_show[] = $row_villa['name'];
                                                        }
                                                        $vs = implode(", ",$valla_show);
                                                    
                                                    return $vs;
                                            }
                                        }else{
                                                 
                                            $count = Yii::$app->db->createCommand("SELECT * FROM users WHERE id = ".$_SESSION['user_id']." ")->queryOne();
                                            return $count['name'];
            
                                        }
                                            },
                                        ],
                                        // 'user_accept',
                                        [
                                            'attribute' => 'read_news',
                                            'format' => 'raw',
                                            'value' => function ($model, $key) {
                                                if (!empty($model->read_news)) {
                                                    if ($_SESSION['user_role']=='1'){
                                                
                                                    $user = str_replace('"',"'",$model->read_news);
                                                    $user_name =  Yii::$app->db->createCommand("SELECT * FROM users WHERE id IN (".$user.")")->queryAll();
                                                    $valla_show = array(); 
                                                        foreach ($user_name as $row_villa){
                                                            $valla_show[] = $row_villa['name'];
                                                        }
                                                        $vs = implode(", ",$valla_show);
                                                    
                                                    return $vs;
                                               

                                             }else{
                                                 
                                                    $count1 = Notification::find()->where(['LIKE', 'read_news', '"'.$_SESSION['user_id'].'"'])->andWhere([ 'id' => $model->id])->One();
    
                                                    if ($count1 == 0) {
                                                        return '<span class="text-red">ยังไม่ได้อ่าน</span>';
                                                   } else {
                                                       return '<span class="text-green">อ่านแล้ว</span>';
                                                   }
                                             
                                                }
                                             }
                                            },
                                        ],

                                        [
                                            'attribute' => 'user_accept',
                                            'format' => 'raw',
                                            'value' => function ($model, $key) {
                                                if (!empty($model->user_accept)) {
                                                    if ($_SESSION['user_role']=='1'){
                                                
                                                    $user = str_replace('"',"'",$model->user_accept);
                                                    $user_name =  Yii::$app->db->createCommand("SELECT * FROM users WHERE id IN (".$user.")")->queryAll();
                                                    $valla_show = array(); 
                                                        foreach ($user_name as $row_villa){
                                                            $valla_show[] = $row_villa['name'];
                                                        }
                                                        $vs = implode(", ",$valla_show);
                                                    
                                                    return $vs;
                                               

                                             }else{
                                                 
                                                    $count = Notification::find()->where(['LIKE', 'user_accept', '"'.$_SESSION['user_id'].'"'])->andWhere([ 'id' => $model->id])->count();
    
                                                    if ($count == 0) {
                                                        return '<span class="text-red">ยังไม่ได้รับทราบ</span>';
                                                   } else {
                                                    return '<span class="text-green">รับทราบแล้ว</span>';
                                                   }
                                             
                                            }
                                        }
                                            },
                                        ],
                                        // 'read_news',
                                        
                                        'link',
                                        'notification_by',
                                    ],
                                ]) ?>

                        </div>

                        <div class="col-xl-4 col-lg-4 col-md-4">

                            <div class="col-md-12 text-center"><br><br><br>

                                <?php  $count = Notification::find()->where(['LIKE', 'user_accept', '"'.$_SESSION['user_id'].'"'])->andWhere([ 'id' => $model->id])->count();
    
                                 if ($count == 0) {?>
                                <button type="submit" class="button button1" id="user_accept"
                                    value="<?php echo $_SESSION['user_id'] ;?>">รับทราบข่าว</button>
                                <!-- <input type="checkbox" class="form-check-input" id="select-user_accept"
                                        name="select-user_accept" value="<?php echo $_SESSION['user_id'] ;?>">
                                    <label for="user_accept">รับทราบข่าว</label> -->
                                <?php } else {?>
                                <div class="card">

                                    <div class="card-alert alert alert-success mb-0">
                                        รับทราบแล้ว
                                    </div>

                                </div>

                                <?php } ?>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> -->
<script>
$(document).ready(function() {

    <?php if((!$model->isNewRecord)):?>
    var dd = '<?php echo $model->user_accept;?>';
    var ddd = dd.replaceAll('"', "");
    var res = ddd.split(",");
    var villa = res;
    console.log(ddd);
    console.log(res);
    <?php else:?>
    var villa = [];
    <?php endif;?>

    $(document).on('click', '#user_accept', function() {

        var id = $(this).val();
        villa.push(id);
        var user_accept = villa.join('","');
        var user_accept1 = ('"' + user_accept + '"');
        console.log(user_accept);
        var ids = '<?php echo $model->id;?>';
        $.ajax({
            url: "index.php?r=site/json-notification&type=add1", //ทำงานกับไฟล์นี้
            data: {
                nid: ids,
                user_accept: user_accept1,
            }, //ส่งตัวแปร
            type: "POST",
            async: false,
            success: function(data, status) {
                $(".showwater").html(data);

            },

        });

    });

});
</script>

<script type="text/javascript">
$(document).ready(function() {

    <?php if((!$model->isNewRecord)):?>
    var dd1 = '<?php echo $model->read_news;?>';
    var ddd1 = dd1.replaceAll('"', "");
    var res1 = ddd1.split(",");
    var villa1 = res1;
    <?php else:?>
    var villa1 = [];
    <?php endif;?>


    var id = '<?php echo $_SESSION['user_id'] ;?> ';

    villa1.push(id);

    var use_array = villa1.join('","');
    var use_array1 = ('"' + use_array + '"');
    var ids = '<?php echo $model->id;?>';
    var user_accept = '<?php echo $model->user_accept;?>';
    console.log(use_array1);

    $.ajax({
        url: "index.php?r=site/json-notification&type=add", //ทำงานกับไฟล์นี้
        data: {
            nid: ids,
            user_accept: user_accept,
            read_news: use_array1
        }, //ส่งตัวแปร
        type: "POST",
        async: false,
        success: function(data, status) {
            $(".showwater").html(data);

        },

    });

});
</script>