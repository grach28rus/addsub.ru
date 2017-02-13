<?php

namespace frontend\controllers;

use Yii;
use common\models\Category;
use frontend\models\CategorySearch;
use frontend\components\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CategoryController implements the CRUD actions for Category model.
 */
class CategoryController extends Controller
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
                ],
            ],
        ];
    }

    /**
     * Creates a new Category model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Category();
        $this->addMessage = true;
        $this->success = true;
        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                $this->messages = Yii::t('app', 'Category has been added') . '!';
            } else {
                $this->success = false;
                $this->messages = Yii::t('app', 'Category has not been added') . '!';
            }
        }
        $categories = Category::findAll(['status' => 'active']);
        $dataForTemplate = [
            'model'        => $model,
            'categories' => $categories,
        ];

        return $this->generateResponse('create', $dataForTemplate);
    }

    /**
     * Updates an existing Category model.
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
     * Deletes an existing Category model.
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
     * Finds the Category model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Category the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Category::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
