<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

/* @var $model \yii\db\ActiveRecord */
$model = new $generator->modelClass();
$safeAttributes = $model->safeAttributes();
if (empty($safeAttributes)) {
    $safeAttributes = $model->attributes();
}

echo "<?php\n";
?>

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model <?= ltrim($generator->modelClass, '\\') ?> */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-form">

    <?= "<?php " ?>$form = ActiveForm::begin(); ?>

<?php foreach ($generator->getColumnNames() as $attribute):?>
<?php if (in_array($attribute, $safeAttributes)): ?>
        <div class="row">
            <div class="col-6">
                <?php echo "<?= " . $generator->generateActiveField($attribute) . " ?>\n"; ?>
            </div>
        </div>
<?php endif; ?>
<?php endforeach; ?>

        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <?= "<?= " ?>Html::submitButton(<?= $generator->generateString('Save') ?>, ['class' => 'btn btn-primary']) ?>
                </div>
            </div>
        </div>

    <?= "<?php " ?>ActiveForm::end(); ?>

</div>
