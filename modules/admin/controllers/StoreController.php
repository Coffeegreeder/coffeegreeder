<?php

namespace app\modules\admin\controllers;

use Yii;
use app\modules\admin\models\Store;
use app\modules\admin\models\StoreRequest;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

class StoreController extends Controller {

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

    public function actionIndex()
    {
        $StoreRequest = new StoreRequest();
        $dataProvider = $StoreRequest->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'StoreRequest' => $StoreRequest,
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
        $model = new Store();
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

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);

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
        if (($model = Store::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('Страница по данному запросу не найдена');
    }
}
