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

    public function actionCreate()
    {
        $model = new Store();


          // if(Yii::$app->request->isPost){
          //   $model->load(Yii::$app->request->post());
          //   $model->img_before = UploadedFile::getInstance($model, 'img_before');
          //   $model->img_before->saveAs("images/{$model->img_before->baseName}.{$model->img_before->extension}");
          //   $model->img_after = UploadedFile::getInstance($model, 'img_after');
          //   $model->img_after->saveAs("images/{$model->img_after->baseName}.{$model->img_after->extension}");
          //   $model->save(false);
          //   return $this->redirect(['view', 'id' => $model->id]);
          // }


        if ($model->load(Yii::$app->request->post())) {
            $model->img_upload = UploadedFile::getInstance($model, 'img_upload');
            $model->img_update = UploadedFile::getInstance($model, 'img_update');

            if ($model->upload()) {
                // file is uploaded successfully
                $model->save(false);
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

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
