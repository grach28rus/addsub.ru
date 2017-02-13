<?php

namespace common\models;

use yii\behaviors\TimestampBehavior;
use \yii\db\ActiveRecord;
use yii\db\Expression;
use common\traits\DataBaseHelper;

/**
 * This is the model class for table "common.add_sub".
 *
 * @property int $id
 * @property string $user_code
 * @property bool $add
 * @property bool $sub
 * @property int $count
 * @property string $category
 * @property string $create_at
 * @property string $status
 * @property string $update_at
 * @property string $category_name
 * @property string $user_id
 */
class AddSub extends ActiveRecord
{
    use DataBaseHelper;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'common.add_sub';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_code', 'category', 'status'], 'string'],
            [['add', 'sub'], 'boolean'],
            [['count'], 'default', 'value' => null],
            [['status'], 'default', 'value' => 'active'],
            [['count'], 'integer'],
            [['create_at', 'update_at'], 'safe'],
            [['add'], 'default', 'value' => function ($model, $attribute) {
                return $attribute == '1' ? true : false;
            }],
            [['user_id'], 'default', 'value' => \Yii::$app->user->id],
            [['user_code'], 'default', 'value' => ''],
        ];
    }

    public function behaviors(){
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['create_at', 'update_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['update_at'],
                ],
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_code' => 'User Code',
            'add' => 'Add',
            'sub' => 'Sub',
            'count' => 'Count',
            'category' => 'Category',
            'create_at' => 'Create At',
            'status' => 'Status',
            'update_at' => 'Uodate At',
        ];
    }

    public function attributes()
    {
        return [
            'id',
            'user_code',
            'add',
            'sub',
            'count',
            'category',
            'create_at',
            'status',
            'update_at',
            'category_name',
            'user_id',
        ];
    }

    public function setStatus($status)
    {
        $this->status = $status;

        $this->save();
    }

    public static function getFilterList($paramFilterArray)
    {
        $paramFilterArray = count($paramFilterArray) > 0 ? $paramFilterArray : null;
        $functionOptions = [
            'scheme' => 'common',
            'functionName' => 'add_sub_filter_list',
            'type' => 'all',
            'modelClassName' => self::className(),
        ];
        $functionOptions['functionParameters'] = [
            'param_filter_array' => $paramFilterArray,
        ];

        return self::callFunction($functionOptions);
    }
}
