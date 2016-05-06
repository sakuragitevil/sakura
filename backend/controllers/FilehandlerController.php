<?php
namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use backend\helpers\flow\Config;
use backend\helpers\flow\File;
use backend\helpers\FileManager;
use backend\models\UserForm;

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
                'only' => ['upload', 'cropimage', 'yourphoto'],
                'rules' => [
                    [
                        'actions' => ['upload', 'cropimage', 'yourphoto'],
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
                    'yourphoto' => ['post'],
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
        $config->setTempDir(FileManager::getChunksTempPath());

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
                $savePath = FileManager::getAvatarTempPath();
                break;
            default:
                $fileName = $file->getFileName();
                $savePath = FileManager::getDocumentPath();
                break;
        };

        if ($file->validateFile() && $file->save($savePath, $fileName)) {
            // File upload was completed
            switch ($uploadMode) {
                case "avatar":

                    list($width, $height) = getimagesize(FileManager::getAvatarTempPath($fileName));

                    $content = [
                        "width" => $width,
                        "height" => $height,
                        'fileName' => $fileName,
                        "srcPath" => FileManager::getAvataTemprUrl($fileName),
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
            if (array_key_exists('cropData', $_POST)
                && array_key_exists('imgData', $_POST)
                && array_key_exists('cropBoxData', $_POST)
            ) {
                $cropBoxData = $_POST['cropBoxData'];
                $cropData = $_POST['cropData'];
                $imgData = $_POST['imgData'];

                $nimg = imagecreatetruecolor($cropBoxData['width'], $cropBoxData['height']);
                $im_src = imagecreatefromjpeg(FileManager::getAvatarTempPath($imgData['fileName']));
                if ($cropData['rotate'] != 0) {
                    $im_src = imagerotate($im_src, $cropData['rotate'] * -1, 0);
                }

                imagecopyresampled($nimg, $im_src, 0, 0, $cropData['x'], $cropData['y'], $imgData['width'], $imgData['height'], $imgData['naturalWidth'], $imgData['naturalHeight']);
                imagejpeg($nimg, FileManager::getAvatarPath($imgData['fileName']), 90);
                imagejpeg($nimg, FileManager::getAvatarWebPath($imgData['fileName']), 90);

                $res['data'] = ['avatarUrl' => FileManager::getAvatarUrl($imgData['fileName'])];
                unlink(FileManager::getAvatarTempPath($imgData['fileName']));
                if (array_key_exists('oldFileName', $imgData) && $imgData['oldFileName'] != 'default.png') {
                    unlink(FileManager::getAvatarWebPath($imgData['oldFileName']));
                }

                $user = new UserForm();
                $user->updateAvatar($imgData['fileName']);
            }
            $res['status'] = 'ok';
        } catch (Exception $e) {
            $res['status'] = 'ng';
            $res['message'] = $e->getMessage();
        }

        return Json::encode($res);
    }

    public function actionYourphoto()
    {
        $res = Yii::$app->params['response'];
        try {
            $res['data'] = FileManager::getAllAvatar();
            $res['status'] = 'ok';
        } catch (Exception $e) {
            $res['status'] = 'ng';
            $res['message'] = $e->getMessage();
        }
        return json_encode($res);
    }
}
