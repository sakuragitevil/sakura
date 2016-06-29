<?php
namespace backend\controllers;

use backend\helpers\Common;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use common\models\LoginForm;
use yii\filters\VerbFilter;
use yii\helpers\Json;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error', 'language'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
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

    public function actionError()
    {
        $exception = Yii::$app->errorHandler->exception;
        if ($exception !== null) {
            return $this->render('error', ['exception' => $exception]);
        }
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        $post = Yii::$app->request->post();

        //Validate email action
        if (array_key_exists('action', $post) &&
            $post['action'] == 'validateEmail' &&
            Yii::$app->request->isAjax
        ) {

            $res = Yii::$app->params['response'];
            if ($model->load($post) && $model->validateEmail($model->email)) {

                $user = $model->userProfile();

                $res['status'] = 'ok';
                $res['data']['profileName'] = $user->firstname . ' ' . $user->lastname;
                $res['data']['profileAvatar'] = Common::getAvatarOf($user);

            } else {
                $res['status'] = 'ng';
                $res['message'] = $model->getErrors($model->email);
            }

            return Json::encode($res);
        }

        //Login action
        if ($model->load($post) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        $language = Yii::$app->session->get('language');
        Yii::$app->user->logout();

        Yii::$app->session->set('language', $language);
        Yii::$app->language = $language;
        return $this->goHome();
    }

    public function actionLanguage()
    {
        $res = Yii::$app->params['response'];

        $post = Yii::$app->request->post();
        if (!array_key_exists('language', $post)) {
            $res['status'] = 'ng';
            $res['message'] = "Incorrect language";
            return Json::encode($res);
        }

        $language = Yii::$app->params['language'];
        if (!array_key_exists($post['language'], $language)) {
            $res['status'] = 'ng';
            $res['message'] = "The system does not support " . strtoupper($post['language']) . " language";
            return Json::encode($res);
        }

        $res['status'] = 'ok';
        Yii::$app->session->set('language', $post['language']);
        Yii::$app->language = $post['language'];
        return Json::encode($res);
    }
}
