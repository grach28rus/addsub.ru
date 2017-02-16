<?
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $addSub common\models\AddSub */
?>



<?= GridView::widget([
    'dataProvider' => $addSub,
    'tableOptions' => [
        'class' => 'table table-striped'
    ],
    'columns' => [
        [
            'class' => 'yii\grid\SerialColumn',
            'contentOptions' =>['style' => 'width: 50px;'],
        ],
        [
            'attribute' => 'add',
            'header' => Yii::t('app', 'Add/Sub'),
            'contentOptions' =>['style' => 'width: 100px;'],
            'content' => function ($model) {
                $addHtml = $model->add
                    ? "<i class='fa fa-plus' style='color: #1ab394'></i>"
                    : "<i class='fa fa-minus' style='color: #ed5565'></i>";

                return $addHtml;
            },
        ],
        [
            'attribute' => 'count',
            'header' => Yii::t('app', 'Count'),
            'contentOptions' =>['style' => 'width: 100px;'],
            'content' => function ($model) {
                return $model->count . 'p';
            },
        ],
        [
            'attribute' => 'category_name',
            'header' => Yii::t('app', 'Category'),
            'content' => function ($model) {
                return $model->category_name;
            },
        ],


        [
            'attribute' => 'create_at',
            'contentOptions' =>['style' => 'width: 100px;'],
            'header' => Yii::t('app', 'Create At'),
            'content' => function ($model) {
                return substr($model->create_at, 0, 10);
            },
        ],
        [
            'contentOptions' =>['style' => 'width: 30px;'],
            'content' => function ($model) {
                $icon = '<i class="fa fa-trash" style="font-size: 12pt"></i>';
                $button = '';
                if (Yii::$app->controller->id != 'site') {
                    $button = Html::button($icon, [
                        'class'   => 'btn btn-white btn-xs',
                        'id'      => 'action-delete',
                        'data-id' => $model->id,
                        'data-controller' => Yii::$app->controller->id,
                    ]);
                }
                return $button;
            },
        ]
    ],
]); ?>
