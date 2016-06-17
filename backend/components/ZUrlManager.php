<?php
/**
 * Created by PhpStorm.
 * User: VThuan
 * Date: 6/15/2016
 * Time: 1:42 PM
 */

namespace backend\components;

use yii\web\UrlManager;
use Yii;

class ZUrlManager extends UrlManager
{
    public function createUrl($params)
    {
        if (!isset($params['language'])) {
            if (Yii::$app->session->has('language'))
                Yii::$app->language = Yii::$app->session->get('language');
            else if(isset(Yii::$app->request->cookies['language']))
                Yii::$app->language = Yii::$app->request->cookies['language']->value;
            $params['language']=Yii::$app->language;
        }
        return parent::createUrl($params);
    }
}