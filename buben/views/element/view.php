<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model buben\models\Element */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('buben', 'Elements'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<section class="element-view">
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
                            <?=  Html::a(Yii::t('buben', ' <i class="fas fa-pencil-alt"></i> edit '), ['update', 'id' => $model->id], ['class' => 'btn btn-primary-outline btn-small']) ?>
                            <?=  Html::a(Yii::t('buben', ' <i class="fa fa-times"></i> delete '), ['update', 'id' => $model->id], [
                                'class' => 'btn btn-primary-outline btn-small',
                                'data' => [
                                    'confirm' => Yii::t('buben', 'Are you sure you want to delete this item?'),
                                    'method' => 'post',
                                ],
                            ]) ?>
                            <a class="btn btn-primary-outline btn-small btn-pill-right" data-toggle="minimize" href="#" role="button">
                                <i class="fa min-arrow"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-block">
                    <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                                'id',
            'key',
            'cat_id',
            'title',
            'updated_at',
            'type',
            'sort',
            'only_webmaster',
            'value:ntext',
                    ],
                    ]) ?>
                </div>
            </div>
        </div>
    </div>
</section>
