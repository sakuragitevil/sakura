<?php

namespace backend\helpers\flow;

use Yii;
use backend\helpers\flow\File;
use backend\helpers\flow\ConfigInterface;
use backend\helpers\flow\RequestInterface;
/**
 * Class Basic
 *
 * Example for handling basic uploads
 *
 * @package Flow
 */
class Basic
{
    /**
     * @param  string                 $destination where to save file
     * @param  string|ConfigInterface $config
     * @param  RequestInterface       $request     optional
     * @return bool
     */
    public static function save($destination, $config, RequestInterface $request = null)
    {
        if (!$config instanceof ConfigInterface) {
            $config = new Config(array(
                'tempDir' => $config,
            ));
        }

        $file = new File($config, $request);

        if (Yii::$app->request->isGet) {
            if ($file->checkChunk()) {
                Yii::$app->response->setStatusCode(200);
                Yii::$app->response->send();
            } else {
                Yii::$app->response->setStatusCode(204);
                Yii::$app->response->send();
                return false;
            }
        } else {
            if ($file->validateChunk()) {
                $file->saveChunk();
            } else {
                // error, invalid chunk upload request, retry
                Yii::$app->response->setStatusCode(400);
                Yii::$app->response->send();
                return false;
            }
        }

        if ($file->validateFile() && $file->save($destination)) {
            return true;
        }

        return false;
    }
}
