<?php

namespace frontend\controllers;

use Yii;
use common\models\AddSub;
use common\models\Category;
use frontend\models\AddSubSearch;
use frontend\components\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

/**
 * AddSubController implements the CRUD actions for AddSub model.
 */
class AddSubController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                    'create' => ['GET', 'POST'],
                ],
            ],
        ];
    }

    /**
     * @param $type
     * @return null|string
     */
    public function actionCreate($type)
    {
        $model = new AddSub();
        $isAdd = $type == 'add' ? 1 : 0;
        $categories = Category::findAll(['user_id' => Yii::$app->user->id, 'status' => 'active', 'add_or_sub' => $isAdd]);
        $categories = ArrayHelper::map($categories, 'id', 'name');
        $this->addMessage = true;
        $this->success = true;
        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                $this->messages = Yii::t('app', 'Statistics has been changed') . '!';
            } else {
                $this->success = false;
                $this->messages = Yii::t('app', 'Statistics has not been changed') . '!';
            }

        }
        $addSub = AddSub::getFilterList(['user_id' => \Yii::$app->user->id, 'status' => 'active', 'add' => $isAdd]);
        $dataForTemplate = [
            'model'      => $model,
            'categories' => $categories,
            'type'       => $type,
            'addSub'     => $addSub
        ];

        return $this->generateResponse('create', $dataForTemplate);
    }

    /**
     * Deletes an existing AddSub model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->addMessage = true;
        if ($this->findModel($id)->setStatus('delete')) {
            $this->success = true;
            $this->messages = Yii::t('app', 'Category has been delete') . '!';
        } else {
            $this->success = false;
            $this->messages = Yii::t('app', 'Category has not been delete') . '!';
        }

        return $this->generateResponse();
    }

    /**
     * Finds the AddSub model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AddSub the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AddSub::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
