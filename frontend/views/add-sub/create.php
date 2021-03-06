<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\AddSub */
/* @var $categories common\models\Category */
/* @var $type string */
/* @var $addSub \yii\data\ActiveDataProvider*/

$this->title = $type == 'add' ? 'Add' : 'Sub';
$btnType = $type == 'add' ? 'btn-primary' : 'btn-danger';
$btnValue = $type == 'add' ? 'Add' : 'Sub';
?>
<div class="ibox-content add-sub-create">
    <?= Html::submitButton($btnValue, ['class' => 'btn pull-right ' . $btnType, 'id' => 'submit-form']) ?>
    <h2><?= Html::encode($this->title) ?></h2>

    <?= $this->render('_form', [
        'model'      => $model,
        'categories' => $categories,
        'type'       => $type,
    ]) ?>

</div>
<div class="ibox-content">
    <?= $this->render('../site/tableAddSub', [
        'addSub' => $addSub
    ])?>
</div>