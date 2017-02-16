<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\AddSub;

/**
 * AddSubSearch represents the model behind the search form of `common\models\AddSub`.
 * @property string $create_at_from
 * @property string $create_at_to
 */

class AddSubSearch extends AddSub
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'count'], 'integer'],
            [['user_code', 'category', 'create_at', 'status', 'uodate_at', 'create_at_from', 'create_at_to', 'add'], 'safe'],
            [['add', 'sub'], 'boolean'],
        ];
    }

    public function attributes()
    {
        $parentAttributes =  parent::attributes();
        $attributes = [
            'create_at_from',
            'create_at_to',
        ];

        return array_merge($parentAttributes, $attributes);
    }

    /**
     * @param null $conditions
     * @param null $model
     * @return ActiveDataProvider
     */
    public function search($conditions = null, $model = null)
    {
        $this->load($conditions, $model);
        if ($this->validate()) {
            $paramFilterArray = self::getParamsFilterArray();
            $paramFilterArray['user_id'] = \Yii::$app->user->id;
            $paramFilterArray['status'] = 'active';
        } else {
            $paramFilterArray = [
                'user_id' => \Yii::$app->user->id,
                'status'  => 'active'
            ];
        }
        $functionOptions = [
            'scheme' => 'common',
            'functionName' => 'add_sub_filter_list',
            'type' => 'all',
            'modelClassName' => self::className(),
        ];
        $functionOptions['functionParameters'] = [
            'param_filter_array' => $paramFilterArray,
        ];
        $functionSql = self::getActiveQuery($functionOptions);
        $dataProvider = new ActiveDataProvider([
            'query' => $functionSql,
        ]);

        return $dataProvider;
    }
}
