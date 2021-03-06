<?php

namespace common\models;

use yii\behaviors\TimestampBehavior;
use \yii\db\ActiveRecord;
use yii\db\Expression;
use common\traits\DataBaseHelper;
use Yii;

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
 * @property string $comment
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
            [['user_code', 'status', 'comment'], 'string'],
            [['category', 'count', 'add'], 'required'],
            [['add', 'sub'], 'boolean'],
            [['count'], 'default', 'value' => null],
            [['status'], 'default', 'value' => 'active'],
            [['count'], 'integer'],
            [['create_at', 'update_at', 'status'], 'safe'],
            [['add'], 'default', 'value' => function ($model, $attribute) {
                return $attribute == '1' ? true : false;
            }],
            [['user_id'], 'default', 'value' => \Yii::$app->user->id],
            [['user_code'], 'default', 'value' => ''],
        ];
    }

    public function behaviors()
    {
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
            'id' => Yii::t('app', 'ID'),
            'user_code' => Yii::t('app', 'User Code'),
            'add' => Yii::t('app', 'Add'),
            'sub' => Yii::t('app', 'Sub'),
            'count' => Yii::t('app', 'Count'),
            'category' => Yii::t('app', 'Category'),
            'create_at' => Yii::t('app', 'Create At'),
            'status' => Yii::t('app', 'Status'),
            'update_at' => Yii::t('app', 'Update At'),
            'comment' => Yii::t('app', 'Comment'),
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
            'sum_add',
            'sum_sub',
            'comment',
        ];
    }

    public function setStatus($status)
    {
        $this->status = $status;

        return $this->save();
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

    public static function getSumAdd()
    {
        $sumAdd = self::find()->select(['SUM(count) as count'])->where([
            'user_id' => \Yii::$app->user->id,
            'add' => true,
            'status' => 'active'
        ])->groupBy('user_id')->one();

        return $sumAdd->count;
    }

    public static function getSumSub()
    {
        $sumSub = self::find()->select(['SUM(count) as count'])->where([
            'user_id' => \Yii::$app->user->id,
            'add' => false,
            'status' => 'active'
        ])->groupBy('user_id')->one();

        return $sumSub->count;
    }

    public static function getStatistics()
    {
        $functionOptions = [
            'scheme' => 'common',
            'functionName' => 'get_statistics_add_sub',
            'type' => 'all',
            'modelClassName' => self::className(),
        ];
        $functionOptions['functionParameters'] = [
            'param_user_id' => \Yii::$app->user->id,
        ];

        return self::callFunction($functionOptions);
    }
}
