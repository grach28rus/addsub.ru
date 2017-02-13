<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Category */
/* @var $categories common\models\Category */

$this->title = 'Add Category';
$iterator = 1;
?>
<div class="ibox-content category-create">

    <h2><?= Html::encode($this->title) ?></h2>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

    <h2><?= Html::encode('Categories') ?></h2>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>#</th>
            <th><?= Yii::t('app', 'Name') ?></th>
            <th><?= Yii::t('app', 'Type') ?></th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <? foreach ($categories as $category) : ?>
            <tr>
                <td style="width: 50px">
                    <?= $iterator ?>
                </td>
                <td>
                    <?= $category->name ?>
                </td>
                <td style="width: 150px">
                    <?= $category->add_or_sub ? 'Add' : 'Sub' ?>
                </td>
                <td style="width: 50px;">
                    <?
                    $iterator ++;
                    $icon = '<i class="fa fa-trash"></i>';
                    echo Html::button($icon, [
                        'class'           => 'btn btn-white btn-xs',
                        'id'              => 'action-delete',
                        'data-id'         => $category->id,
                        'data-controller' => Yii::$app->controller->id,
                    ]);?>
                </td>
            </tr>
        <? endforeach; ?>
        </tbody>
    </table>
</div>
