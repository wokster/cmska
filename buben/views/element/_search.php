<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model buben\models\ElementSearch */
/* @var $form yii\widgets\ActiveForm */
?>
<?php $form = ActiveForm::begin([
'action' => ['index'],
'method' => 'get',
    'options' => [
    'data-pjax' => 1
    ],
]); ?>
<div class="row">
    <div class="col-xl-12">
        <div class="card card-default minimize">
            <div class="card-header">
                <div class="header-block">
                    <p class="title"><?=  Yii::t('buben','Filters')?></p>
                </div>
                <div class="header-block pull-right">
                    <div class="tools">
                        <a class="btn btn-primary-outline btn-small btn-oval" data-toggle="minimize" href="#" role="button">
                            <i class="fa min-arrow"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-block">

                    <?= $form->field($model, 'id') ?>

				    <?= $form->field($model, 'key') ?>

				    <?= $form->field($model, 'cat_id') ?>

				    <?= $form->field($model, 'title') ?>

				    <?= $form->field($model, 'updated_at') ?>

				    <?php // echo $form->field($model, 'type') ?>

				    <?php // echo $form->field($model, 'sort') ?>

				    <?php // echo $form->field($model, 'only_webmaster') ?>

				    <?php // echo $form->field($model, 'value') ?>

				
            </div>
            <div class="card-footer">
                <?= Html::submitButton(Yii::t('buben', 'Search'), ['class' => 'btn btn-primary']) ?>
                <?= Html::resetButton(Yii::t('buben', 'Reset'), ['class' => 'btn btn-default']) ?>
            </div>
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>
