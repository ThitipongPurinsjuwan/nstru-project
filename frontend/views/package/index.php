<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PackageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Packages');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="package-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php foreach ($model as $model) :  ?>
        <section class="position-relative pt-0">
            <div class="row">
                <div class="col-12">
                    <div class="row gy-4">
                        <!-- Card item START -->
                        <div class="col-sm-6 col-lg-4">
                            <div class="card">
                                <!-- Card img -->
                                <div class="position-relative">
                                    <img class="card-img" src="../../themes/template/assets/images/blog/packges/c1.jpg" alt="Card image">
                                    <div class="card-img-overlay d-flex align-items-start flex-column p-3">
                                        <!-- Card overlay bottom -->
                                        <div class="w-100 mt-auto">
                                            <!-- Card category -->
                                            <a href="#" class="badge bg-warning mb-2"><i class="fas fa-circle me-2 small fw-bold"></i>Khiriwong</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- Card img -->

                                <div class="card-body px-0 pt-3">
                                    <h4 class="card-title"><a href="<?= \Yii::$app->getUrlManager()->createUrl(['package/view', 'id' => $model->id]) ?>" class="btn-link text-reset fw-bold"><?= $model->name ?></a></h4>
                                    <p class="card-text"><?= $model->details ?></>
                                        <!-- Card info -->
                                    <ul class="nav nav-divider align-items-center d-none d-sm-inline-block">
                                        <li class="nav-item">
                                            <div class="nav-link">
                                                <div class="d-flex align-items-center position-relative">
                                                    <div class="avatar avatar-xs">
                                                        <img class="avatar-img rounded-circle" src="../../themes/template/assets/images/avatar/01.jpg" alt="avatar">
                                                    </div>
                                                    <span class="ms-3">by <a href="#" class="stretched-link text-reset btn-link">Samuel</a></span>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="nav-item"><?= $model->date_create ?></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
        </section>
        <!-- Card item END -->
    <?php endforeach  ?>
</div>