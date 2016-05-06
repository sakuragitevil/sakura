<?php

namespace backend\helpers;

use Yii;

class FileManager
{
    public static function getAvatarPath($fileName = '')
    {
        $path = Yii::getAlias('@app') . DIRECTORY_SEPARATOR . Yii::getAlias('@avatarPath') . DIRECTORY_SEPARATOR . Yii::$app->user->identity->web_folder;
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
        return $path . DIRECTORY_SEPARATOR . $fileName;
    }

    public static function getAvatarTempPath($fileName = '')
    {
        $path = Yii::getAlias('@app') . DIRECTORY_SEPARATOR . Yii::getAlias('@avatarTempPath');
        if ($fileName != '')
            $path .= DIRECTORY_SEPARATOR . $fileName;
        return $path;
    }

    public static function getAvatarWebPath($fileName = '')
    {
        $path = Yii::getAlias('@app') . DIRECTORY_SEPARATOR . Yii::getAlias('@avatarWebPath') . DIRECTORY_SEPARATOR . Yii::$app->user->identity->web_folder;
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
        return $path . DIRECTORY_SEPARATOR . $fileName;
    }

    public static function getAvatarUrl($fileName = '')
    {
        return Yii::getAlias("@avatarUrl") . DIRECTORY_SEPARATOR . Yii::$app->user->identity->web_folder . DIRECTORY_SEPARATOR . $fileName;
    }

    public static function getAvataTemprUrl($fileName = '')
    {
        return Yii::getAlias("@avatarTempUrl") . DIRECTORY_SEPARATOR . $fileName;
    }

    public static function getChunksTempPath()
    {
        return Yii::getAlias("@app") . DIRECTORY_SEPARATOR . Yii::getAlias('@chunksTempPath');
    }

    public static function getDocumentPath()
    {
        return Yii::getAlias("@app") . DIRECTORY_SEPARATOR . Yii::getAlias('@documentPath');
    }
}
