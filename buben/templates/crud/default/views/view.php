<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

$urlParams = $generator->generateUrlParams();

echo "<?php\n";
?>

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model <?= ltrim($generator->modelClass, '\\') ?> */

$this->title = $model-><?= $generator->getNameAttribute() ?>;
$this->params['breadcrumbs'][] = ['label' => <?= $generator->generateString(Inflector::pluralize(Inflector::camel2words(StringHelper::basename($generator->modelClass)))) ?>, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<section class="<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-view">
    <div class="row">
        <div class="col-xl-12">
            <div class="card card-default">
                <div class="card-header">
                    <div class="header-block">
                        <p class="title"><?= "<?= " ?>Html::encode($this->title) ?></p>
                    </div>
                    <div class="header-block pull-right">
                        <div class="tools">
                            <?= "<?= " ?> Html::a(Yii::t('buben', '<i class="fa fa-plus"></i> add'), ['create'], ['class' => 'btn btn-primary-outline btn-small btn-pill-left']) ?>
                            <?= "<?= " ?> Html::a(Yii::t('buben', ' <i class="fas fa-pencil-alt"></i> edit '), ['update', <?= $urlParams ?>], ['class' => 'btn btn-primary-outline btn-small']) ?>
                            <?= "<?= " ?> Html::a(Yii::t('buben', ' <i class="fa fa-times"></i> delete '), ['update', <?= $urlParams ?>], [
                                'class' => 'btn btn-primary-outline btn-small',
                                'data' => [
                                    'confirm' => <?= $generator->generateString('Are you sure you want to delete this item?') ?>,
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
                    <?= "<?= " ?>DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                    <?php
                    if (($tableSchema = $generator->getTableSchema()) === false) {
                        foreach ($generator->getColumnNames() as $name) {
                            echo "            '" . $name . "',\n";
                        }
                    } else {
                        foreach ($generator->getTableSchema()->columns as $column) {
                            $format = $generator->generateColumnFormat($column);
                            echo "            '" . $column->name . ($format === 'text' ? "" : ":" . $format) . "',\n";
                        }
                    }
                    ?>
                    ],
                    ]) ?>
                </div>
            </div>
        </div>
    </div>
</section>
