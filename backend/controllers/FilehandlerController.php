<?php
namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\helpers\Json;

use backend\helpers\Common;
use backend\models\FilehandlerForm;


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
        $fhForm = new FilehandlerForm();
        $fhForm->uploadFile();
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
