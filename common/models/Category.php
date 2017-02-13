<?php

namespace common\models;

use yii\behaviors\TimestampBehavior;
use \yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "common.category".
 *
 * @property int $id
 * @property string $name
 * @property bool $add_or_sub
 * @property string $create_at
 * @property string $update_at
 * @property string $status
 * @property string $user_id
 */
class Category extends ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'common.category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'status'], 'string'],
            ['status', 'default', 'value' => 'active'],
            [['add_or_sub'], 'default', 'value' => function ($model, $attribute) {
                return $attribute == '1' ? true : false;
            }],
            ['user_id', 'default', 'value' => \Yii::$app->user->id],
            [['add_or_sub'], 'boolean'],
            [['create_at', 'update_at'], 'safe'],
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
            'name' => 'Name',
            'add_or_sub' => 'Add Or Sub',
            'create_at' => 'Create At',
            'update_at' => 'Update At',
            'status' => 'Status',
        ];
    }

    public function setStatus($status)
    {
        $this->status = $status;

        return $this->save();
    }

}
