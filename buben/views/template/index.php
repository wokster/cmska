<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel buben\models\TemplateSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('buben', 'Templates');
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="section template-index">
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    
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
                            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
        'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                            'id',
            'name',
            'updated_at',
            'comment',
            'version',
            //'css:ntext',
            //'html:ntext',
            //'js:ntext',

                ['class' => 'yii\grid\ActionColumn'],
                ],
                ]); ?>
            
            </div>
        </div>
    </div>
</div>

    <?php Pjax::end(); ?>
</section>
