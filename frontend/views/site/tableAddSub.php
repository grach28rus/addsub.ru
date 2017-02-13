<?
use yii\helpers\Html;

/* @var $addSub common\models\AddSub */

$iterator = 1;
?>

<div class="ibox-content">
        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <label class="control-label" for="product_name"><?=Yii::t('app', 'Add/Sub')?></label>
                    <input type="text" id="product_name" name="product_name" value="" placeholder="Project Name" class="form-control">
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                    <label class="control-label" for="price"><?=Yii::t('app', 'Count')?></label>
                    <input type="text" id="price" name="price" value="" placeholder="Name" class="form-control">
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                    <label class="control-label" for="quantity"><?=Yii::t('app', 'Category')?></label>
                    <input type="text" id="quantity" name="quantity" value="" placeholder="Company" class="form-control">
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label class="control-label" for="status"><?=Yii::t('app', 'Created At')?></label>
                    <select name="status" id="status" class="form-control">
                        <option value="1" selected="">Completed</option>
                        <option value="0">Pending</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th><?= Yii::t('app', 'Add/Sub') ?></th>
                    <th><?= Yii::t('app', 'Count') ?></th>
                    <th><?= Yii::t('app', 'Category') ?></th>
                    <th><?= Yii::t('app', 'Created At') ?></th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <? foreach ($addSub as $addSubItem) : ?>
                    <?
                        $addHtml = $addSubItem->add
                            ? "<i class='fa fa-plus' style='color: #1ab394'></i>"
                            : "<i class='fa fa-minus' style='color: #ed5565'></i>";
                    ?>
                    <tr>
                        <td style="width: 50px">
                            <?= $iterator ?>
                        </td>
                        <td style="width: 100px">
                            <?= $addHtml ?>
                        </td>
                        <td>
                            <?= $addSubItem->count . 'р.'?>
                        </td>
                        <td>
                            <?= $addSubItem->category_name?>
                        </td>
                        <td>
                            <?= substr($addSubItem->create_at, 0, 10)?>
                        </td>
                        <td style="width: 50px;">
                            <?
                            $iterator ++;
                            $icon = '<i class="fa fa-trash"></i>';
                            echo Html::button($icon, [
                                'class'           => 'btn btn-white btn-xs',
                                'id'              => 'action-delete',
                                'data-id'         => $addSubItem->id,
                                'data-controller' => Yii::$app->controller->id,
                            ]);?>
                        </td>
                    </tr>
                <? endforeach; ?>
                </tbody>
            </table>
        </div>

    </div>
