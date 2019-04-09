<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

echo "<?php\n";
?>

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model <?= ltrim($generator->searchModelClass, '\\') ?> */
/* @var $form yii\widgets\ActiveForm */
?>
<?= "<?php " ?>$form = ActiveForm::begin([
'action' => ['index'],
'method' => 'get',
<?php if ($generator->enablePjax): ?>
    'options' => [
    'data-pjax' => 1
    ],
<?php endif; ?>
]); ?>
<div class="row">
    <div class="col-xl-12">
        <div class="card card-default minimize">
            <div class="card-header">
                <div class="header-block">
                    <p class="title"><?= "<?= " ?> Yii::t('buben','Filters')?></p>
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

                <?php
                $count = 0;
                foreach ($generator->getColumnNames() as $attribute) {
                    if (++$count < 6) {

                        echo "    <?= " . $generator->generateActiveSearchField($attribute) . " ?>\n\n\t\t\t\t";
                    } else {

                        echo "    <?php // echo " . $generator->generateActiveSearchField($attribute) . " ?>\n\n\t\t\t\t";
                    }
                }
?>

            </div>
            <div class="card-footer">
                <?= "<?= " ?>Html::submitButton(<?= $generator->generateString('Search') ?>, ['class' => 'btn btn-primary']) ?>
                <?= "<?= " ?>Html::resetButton(<?= $generator->generateString('Reset') ?>, ['class' => 'btn btn-default']) ?>
            </div>
        </div>
    </div>
</div>
<?= "<?php " ?>ActiveForm::end(); ?>
