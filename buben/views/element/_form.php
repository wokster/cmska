<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model buben\models\Element */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="element-form">

    <?php $form = ActiveForm::begin(); ?>

        <div class="row">
            <div class="col-6">
                <?= $form->field($model, 'key')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-3">
                <?= $form->field($model, 'type')->radioList(\buben\models\Element::getTypeList()) ?>
            </div>
            <div class="col-3">
                <?= $form->field($model, 'cat_id')->dropDownList(\buben\models\Element::getCatList()) ?>
            </div>
        </div>

        <div class="row">
            <div class="col-6">
                <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-3">
                <?= $form->field($model, 'sort')->input('number',['min'=>0,'max'=>99]) ?>
            </div>
            <div class="col-3">
                <?= $form->field($model, 'only_webmaster')->radioList(['no','yes']) ?>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <?= $form->field($model, 'value')->widget(\buben\components\ace\AceEditor::class) ?>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <?= Html::submitButton(Yii::t('buben', 'Save'), ['class' => 'btn btn-primary']) ?>
            </div>
        </div>

    <?php ActiveForm::end(); ?>

</div>
