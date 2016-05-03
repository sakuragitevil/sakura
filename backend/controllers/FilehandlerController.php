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
                'only' => ['upload', 'cropimage'],
                'rules' => [
                    [
                        'actions' => ['upload', 'cropimage'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'upload' => ['post', 'get'],
                    'cropimage' => ['post'],
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
        $savePath = "";
        $fileMode = $file->getMode();
        switch ($fileMode) {
            case "avatar":
                $savePath = $appPath . '/upload/avatars/avatar_temp_folder';
                break;
            default:
                $savePath = $appPath . '/upload/documents';
                break;
        };
        if ($file->validateFile() && $file->save($savePath)) {
            // File upload was completed
            switch ($fileMode) {
                case "avatar":

                    list($width, $height) = getimagesize($savePath . DIRECTORY_SEPARATOR . $file->getFileName());

                    $content = [
                        "width" => $width,
                        "height" => $height,
                        'filename' => $file->getFileName(),
                        "srcPath" => Yii::getAlias("@avatarTempUrl") . DIRECTORY_SEPARATOR . $file->getFileName(),
                    ];

                    Yii::$app->response->format = "html";
                    Yii::$app->response->headers->set("conten-type", "text/html; charset=UTF-8");
                    Yii::$app->response->content = Json::encode($content);
                    Yii::$app->response->setStatusCode(201);//Created
                    break;
                default:
                    Yii::$app->response->setStatusCode(201);//Created
                    break;
            };
            Yii::$app->response->send();
        } else {
            // This is not a final chunk, continue to upload
            Yii::$app->response->setStatusCode(100);//Continue
            Yii::$app->response->send();
        }

    }

    public function actionCropimage()
    {
        $res = Yii::$app->params['response'];

        try {
            if (array_key_exists('cropdata', $_POST) && array_key_exists('imgdata', $_POST) && array_key_exists('cropboxdata', $_POST)) {

                $appPath = Yii::getAlias("@app");

                $cropdata = $_POST['cropdata'];
                $imgdata = $_POST['imgdata'];
                $cropBoxData = $_POST['cropboxdata'];

                $nimg = imagecreatetruecolor($cropBoxData['width'], $cropBoxData['height']);
                $im_src = imagecreatefromjpeg($appPath . '/upload/avatars/avatar_temp_folder/' . $imgdata['filename']);
                if ($cropdata['rotate'] != 0) {
                    $im_src = imagerotate($im_src, $cropdata['rotate'] * -1, 0);
                }

                imagecopyresampled($nimg, $im_src, 0, 0, $cropdata['x'], $cropdata['y'], $imgdata['width'], $imgdata['height'], $imgdata['naturalWidth'], $imgdata['naturalHeight']);
                imagejpeg($nimg, $appPath . '/upload/avatars/' . $imgdata['filename'], 90);
            }
            $res['status'] = 'ok';
        } catch (Exception $e) {
            $res['status'] = 'ng';
            $res['message'] = $e->getMessage();
        }

        return Json::encode($res);
    }
}
