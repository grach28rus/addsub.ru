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
     * Creates a new AddSub model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($type)
    {
        $model = new AddSub();
        $categories = Category::findAll(['user_id' => Yii::$app->user->id, 'status' => 'active']);
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
        $dataForTemplate = [
            'model' => $model,
            'categories' => $categories
        ];

        return $this->generateResponse('create', $dataForTemplate);
    }

    /**
     * Updates an existing AddSub model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing AddSub model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
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
