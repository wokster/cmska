<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

echo "<?php\n";
?>

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model <?= ltrim($generator->modelClass, '\\') ?> */

$this->title = <?= $generator->generateString('Create ' . Inflector::camel2words(StringHelper::basename($generator->modelClass))) ?>;
$this->params['breadcrumbs'][] = ['label' => <?= $generator->generateString(Inflector::pluralize(Inflector::camel2words(StringHelper::basename($generator->modelClass)))) ?>, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-create">
    <div class="row">
        <div class="col-xl-12">
            <div class="card card-default">
                <div class="card-header">
                    <div class="header-block">
                        <p class="title"><?= "<?= " ?>Html::encode($this->title) ?></p>
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
                    <?= "<?= " ?>$this->render('_form', [
                    'model' => $model,
                    ]) ?>
                </div>
            </div>
        </div>
    </div>
</section>
