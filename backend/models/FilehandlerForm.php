<?php
namespace backend\models;

use Yii;
use yii\base\ErrorException;
use yii\base\Model;
//use yii\helpers\Json;
use backend\helpers\Common;
use backend\helpers\flow\Config;
use backend\helpers\flow\File;

/**
 * User form
 */
class FilehandlerForm extends Model
{

    /**
     * @inheritdoc
     */
    public function rules()
    {

    }

    /**
     * Set user avatar
     *
     * @return $avatarUrl String
     */
    public function setUserAvatar($data)
    {
        $avatarUrl = "";

        if ($data['avatarMode'] == 1) {//set your avatar with image which you crop from image are uploaded

            if (array_key_exists('cropData', $data)
                && array_key_exists('imgData', $data)
                && array_key_exists('cropBoxData', $data)
            ) {
                $cropBoxData = $data['cropBoxData'];
                $cropData = $data['cropData'];
                $imgData = $data['imgData'];

                $nimg = imagecreatetruecolor($cropBoxData['width'], $cropBoxData['height']);
                $im_src = imagecreatefromjpeg(Common::getAvatarTempPath($imgData['fileName']));
                if ($cropData['rotate'] != 0) {
                    $im_src = imagerotate($im_src, $cropData['rotate'] * -1, 0);
                }

                imagecopyresampled($nimg, $im_src, 0, 0, $cropData['x'], $cropData['y'], $imgData['width'], $imgData['height'], $imgData['naturalWidth'], $imgData['naturalHeight']);
                imagejpeg($nimg, Common::getAvatarPath($imgData['fileName']), 90);
                imagejpeg($nimg, Common::getAvatarWebPath($imgData['fileName']), 90);

                $avatarUrl = Common::getAvatarUrl($imgData['fileName']);
                unlink(Common::getAvatarTempPath($imgData['fileName']));
                if (array_key_exists('oldFileName', $imgData) && $imgData['oldFileName'] != 'default.png') {
                    unlink(Common::getAvatarWebPath($imgData['oldFileName']));
                }

                $user = new UserForm();
                $user->updateAvatar($imgData['fileName']);
            }
        } elseif ($_POST['avatarMode'] == 2) {//set your avatar with image which you choose from your image
            if (file_exists(Common::getAvatarWebPath($data['oldFileName'])))
                unlink(Common::getAvatarWebPath($data['oldFileName']));
            if (file_exists(Common::getAvatarPath($data['fileName'])))
                copy(Common::getAvatarPath($data['fileName']), Common::getAvatarWebPath($data['fileName']));

            $avatarUrl = Common::getAvatarUrl($data['fileName']);

            $user = new UserForm();
            $user->updateAvatar($data['fileName']);
        }

        return $avatarUrl;

    }

    /**
     * upload file
     *
     */
    public function uploadFile()
    {
        try {


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

                        list($width, $height) = getimagesize(Common::getAvatarTempPath($fileNames));

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
        } catch (ErrorException $ex) {
            echo $ex->getTraceAsString();
        }
    }
}
