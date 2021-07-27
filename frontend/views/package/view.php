<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Package */


$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Packages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>

<style>
    .card-img {
        display: flex;
        height: auto;
        object-fit: cover;
        border-radius: 10px;
        box-shadow: 2px 3px 7px #00000096;
        width: 70vh;
        margin: auto;
    }
</style>

<div class="package-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <!-- Card item START -->
    <section class="position-relative pt-0">
        <div class="row">
            <div class="col-12">

                <div class="card">
                    <!-- Card img -->
                    <div class="position-relative">
                        <img class="card-img" src="../../themes/template/assets/images/blog/packges/c1.jpg" alt="Card image">
                        <div class="card-img-overlay d-flex align-items-start flex-column p-3">
                            <!-- Card overlay bottom -->
                        </div>
                    </div>
                </div>

                <div class="row mt-5">
                    <p class="card-text"><?= $model->details ?></>
                </div>

                <?php foreach ($modelPlace as $modelPlace) :  ?>
                    <div class="row">
                        <h4 class="mt-4"><?= $modelPlace->name ?></h4>
                    </div>

                    <div class="card">
                        <!-- Card img -->
                        <div class="position-relative">
                            <img class="card-img" src='<?= '../../images/images_upload_forform/' . $modelPlace->name_img_important ?>' alt="Card image">
                            <div class="card-img-overlay d-flex align-items-start flex-column p-3">
                                <!-- Card overlay bottom -->
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <p class="lead">
                            <?= $modelPlace->activity ?>
                        </p>
                    </div>

                    <div class="row">
                        <h4 class="lead"> ราคา : ฿
                            <?= $modelPlace->price ?>
                        </h4>
                    </div>

                    <div class="row">
                        <p class="lead"> ติดต่อ :
                            <?= $modelPlace->contact ?>
                        </p>
                    </div>

                    <div class="row">
                        <p class="lead"> เปิดทำการ :
                            <?= $modelPlace->business_day ?>
                        </p>
                    </div>
                <?php endforeach  ?>
            </div>
        </div>
    </section>
    <!-- Card item END -->

</div>