<?php

namespace app\modules\admin\controllers;

use Yii;
use app\modules\admin\models\Requests;
use app\modules\admin\models\RequestsFinder;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\UploadedFile;
use yii\widgets\Pjax;

class RequestController extends Controller {

  public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
              'class' => AccessControl::className(),
              'rules' => [
                    [
                        'allow' => false,
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ]
                  ]
            ]
        ];
    }

    public function actionIndex()
    {
        $RequestsFinder = new RequestsFinder();
        $dataProvider = $RequestsFinder->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'RequestsFinder' => $RequestsFinder,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    // __________________ Экшен создания новой записи
    public function actionCreate()
    {
        $model = new Requests();
        if ($model->load(Yii::$app->request->post())) {
            $model->img_upload = UploadedFile::getInstance($model, 'img_upload');
            $model->img_update = UploadedFile::getInstance($model, 'img_update');

            if ($model->upload()) {
                $model->save(false);
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    // __________________ Экшен обновления существующей записи
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
          $model->img_upload = UploadedFile::getInstance($model, 'img_upload');
          $model->img_update = UploadedFile::getInstance($model, 'img_update');
          ($model->is_solved ? $model->category_id = 2 : $model->category_id = 3);
           if ($model->upload()) {
               $model->save(false);
               return $this->redirect(['view', 'id' => $model->id]);
           }

        }
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    // __________________ Экшен удаления записи
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = Requests::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('Страница по данному запросу не найдена');
    }
}
