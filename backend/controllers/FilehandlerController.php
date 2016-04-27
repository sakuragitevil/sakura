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

        $file = new File();

        if (Yii::$app->request->isGet) {
            if ($file->checkChunk()) {
                header("HTTP/1.1 200 Ok");
//                $headers = Yii::$app->response->headers;
            } else {
                header("HTTP/1.1 204 No Content");
                return;
            }
        } else {
            if ($file->validateChunk()) {
                $file->saveChunk();
            } else {
                // error, invalid chunk upload request, retry
                header("HTTP/1.1 400 Bad Request");
                return;
            }
        }
        if ($file->validateFile() && $file->save($appPath . '/upload')) {
            // File upload was completed
        } else {
            // This is not a final chunk, continue to upload
        }

    }


}
