<?php
/**
 * Created by PhpStorm.
 * User: VThuan
 * Date: 6/15/2016
 * Time: 1:42 PM
 */

namespace backend\components;

use backend\helpers\Common;
use Yii;
use yii\web\Controller;

class ZController extends Controller
{
    public function beforeAction($action)
    {
        $reqUri = Yii::$app->urlManager->parseRequest(Yii::$app->request);
        if (!array_key_exists(1, $reqUri)) {
            return parent::beforeAction($action);
        }

        if (!array_key_exists('language', $reqUri[1])) {
            if (!Yii::$app->user->isGuest) {
                return $this->goHome();
            }else{
                return parent::beforeAction($action);
            }
        }

        $language = $reqUri[1]['language'];
        if (!array_key_exists($language, Yii::$app->params['language'])) {
            return $this->goHome();
        }

        if ($language!=Common::language()) {
            return $this->goHome();
        }

        return parent::beforeAction($action);
    }

    public function goHome()
    {
        Yii::$app->setHomeUrl(Yii::$app->getHomeUrl() . DIRECTORY_SEPARATOR . Common::language());
        return parent::goHome();
    }
}