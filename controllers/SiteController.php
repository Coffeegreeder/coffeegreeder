<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\web\UploadedFile;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\modules\admin\models\Requests;

class SiteController extends Controller
{
  public $layout = 'board';

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
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

    public function actionIndex()
    {
        // передача данных из модели "Requests" во view
        $requests = Requests::find()->orderBy('created_at DESC')->all();
        $counter =  Requests::find()->where(['is_solved' => '1'])->count();
        return $this->render('index',
        [
          'requests' => $requests,
          'counter' => $counter,
        ]);
    }

    public function actionCreate()
    {
        $model = new Requests();
        if ($model->load(Yii::$app->request->post())) {
            $model->img_upload = UploadedFile::getInstance($model, 'img_upload');
            $model->img_update = UploadedFile::getInstance($model, 'img_update');

            if ($model->upload()) {
                $model->save(false);
                return $this->redirect(['index']);
            }
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->redirect('/web/admin/request');
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect('/web/admin/request');
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }


    public function actionAbout()
    {
        return $this->render('about');
    }
}
