<?php declare(strict_types=1);

use yii\bootstrap5\ActiveForm;
use yii\helpers\Html;

/* @var yii\web\View $this */
/* @var app\models\Show $model */
/* @var yii\bootstrap5\ActiveForm $form */
?>

<div class="show-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]); ?>

    <?= $form->field($model, 'link')->textInput(['maxlength' => true]); ?>

    <?= $form->field($model, 'image')->textInput(['maxlength' => true]); ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]); ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']); ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
