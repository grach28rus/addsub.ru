<?php
namespace frontend\controllers;

use common\models\AddSub;
use Yii;

use frontend\components\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\SignupForm;


/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error', 'index', 'signup'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index', 'get-statistics'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $addSub = AddSub::getFilterList(['user_id' => \Yii::$app->user->id, 'status' => 'active']);
         if (!Yii::$app->user->isGuest) {
            return $this->render('index', [
                'addSub' => $addSub,
            ]);
        } else {
            $modelLogin = new LoginForm();
            $modelSign = new SignupForm();
            return $this->renderAjax('about', [
                'modelLogin' => $modelLogin,
                'modelSign'  => $modelSign,
            ]);
        }
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            Yii::$app->session->setFlash('success', Yii::t('app', 'Welcome') . '! ' . $model->username);
        } else {
            Yii::$app->session->setFlash('error', Yii::t('app', 'Incorrect username or password') . '!');
        }

        return $this->goHome();
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                Yii::$app->getUser()->login($user);
            } else {
                $errorsStr = '';
                foreach ($model->errors as $attributeName => $errors) {
                    foreach ($errors as $error) {
                        $errorsStr = "$error " . $errorsStr;
                    }
                }
                Yii::$app->session->setFlash('error', $errorsStr);
            }
        }

        return $this->goHome();
    }

    public function actionGetStatistics()
    {
        $statistics = AddSub::getStatistics();
        $sumAdd = '';
        $sumSub = '';
        $category = [];
        foreach ($statistics as $statistic) {
            $sumAdd = $statistic->sum_add;
            $sumSub = $statistic->sum_sub;
            $category[$statistic->category_name] = [
                'count' => $statistic->count,
                'add'   => $statistic->add,
            ];
        }

        return json_encode([
            'add'      => $sumAdd,
            'sub'      => $sumSub,
            'category' => $category,
        ]);
    }
}
