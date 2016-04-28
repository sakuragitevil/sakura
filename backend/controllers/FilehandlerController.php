<?php
namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use backend\helpers\flow\Config;
use backend\helpers\flow\File;

use yii\helpers\Json;

/**
 * Filehandler controller
 */
class FilehandlerController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['upload'],
                'rules' => [
                    [
                        'actions' => ['upload'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'upload' => ['post', 'get'],
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
        ];
    }

    public function actionUpload()
    {
        $appPath = Yii::getAlias("@app");

        $config = new Config();
        $config->setTempDir($appPath . "/upload/chunks_temp_folder");

        $file = new File($config);

        if (Yii::$app->request->isGet) {
            if ($file->checkChunk()) {
                Yii::$app->response->setStatusCode(200);//OK
                Yii::$app->response->send();
            } else {
                Yii::$app->response->setStatusCode(204);//No Content
                Yii::$app->response->send();
                return;
            }
        } else {
            if ($file->validateChunk()) {
                $file->saveChunk();
            } else {
                // error, invalid chunk upload request, retry
                Yii::$app->response->setStatusCode(400);//Bad request
                Yii::$app->response->send();
                return;
            }
        }
        if ($file->validateFile() && $file->save($appPath . '/upload')) {
            // File upload was completed
            Yii::$app->response->setStatusCode(201);//Created
            Yii::$app->response->send();
        } else {
            // This is not a final chunk, continue to upload
            Yii::$app->response->setStatusCode(100);//Continue
            Yii::$app->response->send();
        }

    }


}
