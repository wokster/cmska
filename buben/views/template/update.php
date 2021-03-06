<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model buben\models\Template */

$this->title = Yii::t('buben', 'Update Template: {name}', [
    'name' => $model->name,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('buben', 'Templates'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('buben', 'Update');
?>
<section class="template-update">
    <div class="row">
        <div class="col-xl-12">
            <div class="card card-default">
                <div class="card-header">
                    <div class="header-block">
                        <p class="title"><?= Html::encode($this->title) ?></p>
                    </div>
                    <div class="header-block pull-right">
                        <div class="tools">
                            <?=  Html::a(Yii::t('buben', '<i class="fa fa-plus"></i> add'), ['create'], ['class' => 'btn btn-primary-outline btn-small btn-pill-left']) ?>
                            <a class="btn btn-primary-outline btn-small btn-pill-right" data-toggle="minimize" href="#" role="button">
                                <i class="fa min-arrow"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-block">
                    <div class="card-block">
                        <?= $this->render('_form', [
                        'model' => $model,
                        ]) ?>
                    </div>
                </div>
            </div>
        </div>
</section>
