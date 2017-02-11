<?php

namespace common\models;

use yii\behaviors\TimestampBehavior;
use \yii\db\ActiveRecord;
use yii\db\Expression;

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
 * @property string $uodate_at
 */
class AddSub extends ActiveRecord
{
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
            [['count'], 'integer'],
            [['create_at', 'uodate_at'], 'safe'],
        ];
    }

    public function behaviors(){
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
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
            'uodate_at' => 'Uodate At',
        ];
    }
}
