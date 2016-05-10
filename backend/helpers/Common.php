<?php

namespace backend\helpers;

use Yii;

class Common
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

    /**
     * get user's avatar.
     *
     * @return user avatar url
     */
    public static function getUserAvatar()
    {
        $path = Yii::getAlias("@avatarUrl") . DIRECTORY_SEPARATOR . "default.png";
        $webPath = Yii::getAlias("@app") . DIRECTORY_SEPARATOR . Yii::getAlias("@avatarWebPath");
        $webUserPath = $webPath . DIRECTORY_SEPARATOR . Yii::$app->user->identity->web_folder;
        if (file_exists($webUserPath . DIRECTORY_SEPARATOR . Yii::$app->user->identity->avatar)) {
            $path = Yii::getAlias("@avatarUrl") . DIRECTORY_SEPARATOR . Yii::$app->user->identity->web_folder . DIRECTORY_SEPARATOR . Yii::$app->user->identity->avatar;
        }
        return $path;
    }

    /**
     * get all user's avatar.
     *
     * @return array url user's avatar
     */
    public static function getAllUserAvatar()
    {
        $files = [];
        $path = Yii::getAlias("@app") . DIRECTORY_SEPARATOR . Yii::getAlias("@avatarPath") . DIRECTORY_SEPARATOR . Yii::$app->user->identity->web_folder;
        if (file_exists($path)) {
            $yourUrl = Yii::getAlias("@yourUrl") . DIRECTORY_SEPARATOR . Yii::$app->user->identity->web_folder;
            $files = array_diff(scandir($path, SCANDIR_SORT_DESCENDING), ['..', '.']);
            foreach ($files as $key => $file) {
                $files[$key] = $yourUrl . DIRECTORY_SEPARATOR . $file;
            }
        }
        return $files;
    }
}
