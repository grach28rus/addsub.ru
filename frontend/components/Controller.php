<?php

namespace frontend\components;

use Yii;

class Controller extends \yii\web\Controller{

    public $addMessage;
    public $messages;
    public $success;

    public function init()
    {
        Yii::$app->language = 'En';
        parent::init();
    }

    public function generateResponse($template = null, $dataForTemplate = [])
    {
        if (Yii::$app->request->isAjax) {
            $actionTemplate = $template ? self::renderAjax($template, $dataForTemplate) : $template;
            if ($this->addMessage) {
                $actionTemplate = json_encode([
                    'actionTemplate' => $actionTemplate,
                    'success'        => $this->success ? $this->success : false,
                    'messages'       => $this->messages ? $this->messages : Yii::t('app', 'Operation has been performed!'),
                ]);
            }
        } else {
            $actionTemplate = $template ? $this->render($template, $dataForTemplate) : $template;
        }

        return $actionTemplate;
    }
}
