<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model buben\models\Template */

$this->title = Yii::t('buben', 'Create Template');
$this->params['breadcrumbs'][] = ['label' => Yii::t('buben', 'Templates'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="template-create">
    <div class="row">
        <div class="col-xl-12">
            <div class="card card-default">
                <div class="card-header">
                    <div class="header-block">
                        <p class="title"><?= Html::encode($this->title) ?></p>
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
                    <?= $this->render('_form', [
                    'model' => $model,
                    ]) ?>
                </div>
            </div>
        </div>
    </div>
</section>
