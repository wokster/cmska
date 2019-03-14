<?php

/* @var $this yii\web\View */
/* @var $form \yii\widgets\ActiveForm */
/* @var $model \buben\models\LoginForm */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <div class="row">
        <div class="col-lg-5">
            <div class="card card-block sameheight-item">
                <div class="title-block">
                    <h3 class="title"><?= Html::encode($this->title) ?></h3>
                    <p>Please fill out the following fields to login:</p>
                </div>
            <?php $form = ActiveForm::begin(['id' => 'login-form',]); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

                <?= $form->field($model, 'rememberMe')->checkbox() ?>

                <div class="form-group">
                    <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
