<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\helpers\Common;
use backend\assets\AppAsset;
use backend\assets\CommonAsset;
use yii\helpers\Html;
use common\widgets\Alert;
use common\widgets\sakura\Xhr2Upload;
use common\widgets\sakura\Xhr2UploadAsset;
use common\widgets\sakura\AjaxWaiting;
use common\widgets\sakura\AjaxWaitingAsset;

AppAsset::register($this);
CommonAsset::register($this);
Xhr2UploadAsset::register($this);
AjaxWaitingAsset::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?php echo Common::language(); ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <link href="<?php echo Yii::$app->request->baseUrl ?>/icons/sakura.ico" rel="shortcut icon" type="image/x-icon"/>
    <link href="<?php echo Yii::$app->request->baseUrl ?>/css/icon.css" rel="stylesheet" type="text/css">
    <?php $this->head() ?>
    <script>
        var sakuraAngular = angular.module("sakuraAngular", []);
    </script>
</head>
<body ng-app="sakuraAngular">
<?php $this->beginBody() ?>
<?php echo AjaxWaiting::widget(); ?>
<div class="wrap">
    <div class="container-fluid">
        <?php if (!\Yii::$app->user->isGuest): ?>
            <div class="g-Ue-ad">
                <div class="g-Qx">
                    <div class="g-Qx-eb X5yjGb">
                        <div class="kFx1Ae-xdwExf-eb-m">
                            <img class="kFx1Ae-xdwExf-eb"
                                 src="https://lh3.googleusercontent.com/4zsirp7PvHet1HV-6JWjLsTbzNkAFOJo9coBYcLXgt5WK7A-2zo3ShS4zDs-OKElEDgsgv_IdJNWRmk=w1920-h1080-p-k-nd-no">
                        </div>
                    </div>
                    <div class="g-Qx-n5VRYe"></div>
                </div>
            </div>
            <div class="clearboth"></div>
            <?php echo $this->render('@app/views/layouts/header') ?>
            <?php echo Xhr2Upload::widget(['options' => [
                'id' => 'profileIcon',
                'uploadMode' => 'avatar',
            ]]); ?>
        <?php endif; ?>
        <?php echo Alert::widget() ?>
        <?php echo $content ?>
    </div>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
