<?php
namespace backend\controllers;

use backend\models\FilehandlerForm;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use backend\helpers\flow\Config;
use backend\helpers\flow\File;
use backend\helpers\Common;

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
                'only' => ['upload', 'set-avatar', 'your-photo'],
                'rules' => [
                    [
                        'actions' => ['upload', 'set-avatar', 'your-photo'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'upload' => ['post', 'get'],
                    'set-avatar' => ['post'],
                    'your-photo' => ['post'],
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
        $config = new Config();
        $config->setTempDir(Common::getChunksTempPath());

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
        $fileName = "";
        $uploadMode = $file->getMode();
        switch ($uploadMode) {
            case "avatar":
                $fileName = date('Ymdhisa') . '.' . $file->getFileExtension();
                $savePath = Common::getAvatarTempPath();
                break;
            default:
                $fileName = $file->getFileName();
                $savePath = Common::getDocumentPath();
                break;
        };

        if ($file->validateFile() && $file->save($savePath, $fileName)) {
            // File upload was completed
            switch ($uploadMode) {
                case "avatar":

                    list($width, $height) = getimagesize(Common::getAvatarTempPath($fileName));

                    $content = [
                        "width" => $width,
                        "height" => $height,
                        'fileName' => $fileName,
                        "srcPath" => Common::getAvataTemprUrl($fileName),
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

    public function actionSetAvatar()
    {
        $res = Yii::$app->params['response'];
        try {

            if (!array_key_exists('avatarMode', $_POST)) {
                $res['status'] = 'ng';
                $res['message'] = "miss data";
                goto end;
            }

            $fhForm = new FilehandlerForm();
            $res['data']['avatarUrl'] = $fhForm->setUserAvatar($_POST);

            $res['status'] = 'ok';
        } catch (Exception $e) {
            $res['status'] = 'ng';
            $res['message'] = $e->getMessage();
        }
        end:
        return Json::encode($res);
    }

    public function actionYourPhoto()
    {
        $res = Yii::$app->params['response'];
        try {
            $res['data'] = Common::getAllUserAvatar();
            $res['status'] = 'ok';
        } catch (Exception $e) {
            $res['status'] = 'ng';
            $res['message'] = $e->getMessage();
        }
        return json_encode($res);
    }
}
