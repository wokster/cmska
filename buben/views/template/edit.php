<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use \buben\components\ace\AceEditor;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model \buben\models\Template */
/* @var $build \buben\models\Build */
/* @var $names array */

$this->title = $model->isNewRecord ? 'New template' : $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('buben', 'Templates'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>

<section class="template-view">
    <div class="row">
        <div class="col-xl-12">
            <?php
            if($model->hasErrors()){
                $error_data = $model->firstErrors;
                echo \yii\widgets\DetailView::widget([
                    'model'=>$error_data,
                    'attributes'=>array_keys($error_data)
                ]);
            }
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <?php $form = ActiveForm::begin([
                'options'=>['enctype'=>'multipart/form-data']
            ]); ?>
            <div class="card card-default">
                <div class="card-header">
                    <div class="header-block">
                        <p class="title"><?= Html::encode($this->title) ?></p>
                    </div>
                    <div class="header-block pull-right">
                        <div class="tools">
                            <div class="btn-group">
                                <button type="button" class="btn btn-primary-outline btn-small btn-pill-left" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Save </button>
                                <div class="dropdown-menu" x-placement="bottom-start">
                                    <?=  Html::submitButton(Yii::t('buben',
                                        '<i class="fas fa-flag-checkered"></i>  save as new major version'),
                                        [
                                            'class' => 'dropdown-item',
                                            'name'=>Html::getInputName($model,'version_type'),
                                            'value'=>\buben\models\Template::VERSION_TYPE_MAJOR])
                                    ?>
                                    <?=  Html::submitButton(Yii::t('buben',
                                        '<i class="fas fa-flag"></i> save as new minor version'),
                                        [
                                            'class' => 'dropdown-item',
                                            'name'=>Html::getInputName($model,'version_type'),
                                            'value'=>\buben\models\Template::VERSION_TYPE_MINOR])
                                    ?>
                                    <?=  Html::submitButton(Yii::t('buben',
                                        '<i class="far fa-flag"></i>  save as patch'),
                                        [
                                            'class' => 'dropdown-item',
                                            'name'=>Html::getInputName($model,'version_type'),
                                            'value'=>\buben\models\Template::VERSION_TYPE_PATCH])
                                    ?>
                                    <?=  Html::submitButton(Yii::t('buben',
                                        '<i class="fas fa-save"></i> overwrite this version'),
                                        [
                                            'class' => 'dropdown-item',
                                            'name'=>Html::getInputName($model,'version_type'),
                                            'value'=>\buben\models\Template::VERSION_TYPE_NULL])
                                    ?>
                                    <div class="dropdown-divider"></div>
                                    <?=  Html::a(Yii::t('buben', '<i class="fas fa-question"></i> about semantic versioning'), 'https://semver.org', ['class' => 'dropdown-item', 'target'=>'_blank']) ?>
                                </div>
                            </div>
                            <a class="btn btn-primary-outline btn-small btn-pill" data-toggle="modal" data-target="#modal-build" href="#" role="button">
                                <i class="fas fa-drum"></i>
                                build
                            </a>
                            <a class="btn btn-primary-outline btn-small btn-pill-right" data-toggle="minimize" href="#" role="button">
                                <i class="fa min-arrow"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-block">
                    <?php if(!empty($names)):?>
                    <div class="row">
                        <div class="col-6">
                            <?= Html::dropDownList('names',$model->name,$names)?>
                        </div>
                        <div class="col-6">
                            <?= Html::dropDownList('versions', $model->id, $model->getIdVersionList())?>
                        </div>
                    </div>
                    <?php endif;?>
                    <div class="row">
                        <div class="col-6">
                            <?= $form->field($model,'name')?>
                        </div>
                        <div class="col-6">
                            <?= $form->field($model,'comment')->textInput([
                                'value' => ''
                            ])?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <ul class="nav nav-tabs nav-tabs-bordered">
                                <li class="nav-item">
                                    <a href="#html" class="nav-link active show" data-target="#html" data-toggle="tab" aria-controls="html" role="tab" aria-selected="false">html</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#css" class="nav-link" data-target="#css" aria-controls="css" data-toggle="tab" role="tab" aria-selected="false">css</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#js" class="nav-link" data-target="#js" aria-controls="js" data-toggle="tab" role="tab" aria-selected="false">js</a>
                                </li>
                            </ul>
                            <div class="tab-content tabs-bordered">
                                <div class="tab-pane fade in active show" id="html">
                                    <?= $form->field($model, 'html')->label(false)->widget(
                                        AceEditor::class,
                                        [
                                            'mode'=>'html',
                                            'theme' => 'tomorrow_night',
                                        ]
                                    )?>
                                </div>
                                <div class="tab-pane fade" id="css">
                                    <?= $form->field($model, 'css')->label(false)->widget(
                                        AceEditor::class,
                                        [
                                            'mode'=>'css',
                                            'theme' => 'tomorrow_night',
                                        ]
                                    )?>
                                </div>
                                <div class="tab-pane fade" id="js">
                                    <?= $form->field($model, 'js')->label(false)->widget(
                                        AceEditor::class,
                                        [
                                            'mode'=>'js',
                                            'theme' => 'tomorrow_night',
                                        ]
                                    )?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <?= DetailView::widget([
                                'model' => $model,
                                'attributes' => [
                                    'id',
                                    'name',
                                    'updated_at',
                                    'comment',
                                    'version',
                                    'css:ntext',
                                    'html:ntext',
                                    'js:ntext',
                                ],
                            ]) ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</section>
<div class="modal" id="modal-build" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Build</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                    <span class="sr-only">Close</span>
                </button>
            </div>
            <?php $buildform = ActiveForm::begin([
                'action' => ['/template/build']
            ]) ?>
            <div class="modal-body modal-tab-container">
                <?= $buildform->field($build,'name')->input(['disabled'=>true]) ?>
                <?= $buildform->field($build,'version')->dropDownList($model->getVersionList())?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Build</button>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
