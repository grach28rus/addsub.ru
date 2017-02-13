<?php

namespace common\traits;

use Yii;
use yii\db\Exception;
use yii\helpers\ArrayHelper;
use yii\helpers\HtmlPurifier;
use yii\web\NotFoundHttpException;


/**
 * Class DBHelper
 * @package frontend\helpers
 */
trait DataBaseHelper
{
    /**
     * @param $functionOptions
     * @return array|false|mixed|null|string
     * @throws NotFoundHttpException
     */
    public static function callFunction($functionOptions)
    {
        try {

            return self::directCallFunction($functionOptions);

        } catch (Exception $ex) {

            if (isset($functionOptions['errorMessage'])) {
                $errorMessage = $functionOptions['errorMessage'];
            } else {
                $errorMessage = 'Call error function '.$functionOptions['functionName'];
            }

            Yii::$app->session->setFlash('error', Yii::t('app', $errorMessage . '!'));
            throw new NotFoundHttpException('Wrong answer from Postgres. '.$errorMessage.'. Error'. $ex->getMessage());
        }
    }

    /**
     * @param $functionOptions
     * @return array|false|mixed|null|string
     */
    public static function directCallFunction($functionOptions)
    {
        $sql = self::getSql($functionOptions);
        $models = self::className();
        switch($functionOptions['type'])
        {
            case 'key-value':
                $models = ArrayHelper::map($models::findBySql($sql)->all(), $functionOptions['keyField'], $functionOptions['valueField']);
                break;
            case 'indexing':
                $models = ArrayHelper::index($models::findBySql($sql)->all(), $functionOptions['index']);
                break;
            case 'all':
                $models = $models::findBySql($sql)->all();
                break;

            case 'one':
                $models = $models::findBySql($sql)->one();
                break;
            default:
                $models = $models::findBySql($sql)->all();
        }

        return $models;
    }

    public static function getSql(Array $functionOptions){
        $defaultOptions = [
            'select' => '*',
            'where'  => '',
            'group'  => '',
        ];
        $functionOptions = array_replace_recursive($functionOptions, $defaultOptions);
        $argumentsAndValue = self::getArgumentsAndValue($functionOptions);
        $sql = "
            SELECT "
            . $functionOptions['select'] .
            " FROM "
            . $functionOptions['scheme'] . "." . $functionOptions['functionName'] . "(
                ".implode(",\n", $argumentsAndValue['arguments']) .
            ")" . ($functionOptions['where'] ? ' WHERE ' . $functionOptions['where'] : '')
            . ($functionOptions['group'] ? ' GROUP BY ' . $functionOptions['group'] : '')
        ;

        $command = Yii::$app->db->createCommand($sql);
        $command->bindValues($argumentsAndValue['values']);

        return $command->rawSql;
    }

    private static function getStringForOptionsFunction(Array $functionOptions)
    {
        $functionOptionsString = [];
        foreach ($functionOptions as $key => $value) {
            $value = HtmlPurifier::process(trim($value));

            if (is_array($value)) {
                $functionOptionsString[] = self::getStringForOptionsFunction($value);
            } else {
                $value = str_replace('"', '\\"', $value);
                if (! is_numeric($value)) {
                    $value = '"' . $value . '"';
                }
                $functionOptionsString[] = '{'.$key.', '.$value.'}';
            }
        }

        return '{' . implode(",", $functionOptionsString) . '}';
    }

    private static function getArgumentsAndValue($functionOptions)
    {
        $arguments = [];
        $values = [];

        foreach($functionOptions['functionParameters'] as $name => $value) {
            if (is_array($value)) {
                $value = self::getStringForOptionsFunction($value);
            }
            $arguments[] = ":{$name}";
            $values[$name] = $value;
        }

        return [
            'arguments' => $arguments,
            'values'    => $values
        ];
    }

    public static function getActiveQuery(Array $functionOptions)
    {
        $sql = self::getSql($functionOptions);
        $models = self::className();

        return $models::findBySql($sql);
    }

    public static function getParamsFilterArray()
    {
        $attributes = self::getAttributes();
        $paramsFilterArray = [];
        foreach ($attributes as $key => $value) {
            if ($value) {
                $paramsFilterArray[$key] = $value;
            }
        }

        return $paramsFilterArray;
    }
}
