<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use common\widgets\Alert;
use common\widgets\sakura\Xhr2UploadAsset;
use common\widgets\sakura\Xhr2Upload;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <link href="../web/icons/sakura.ico" rel="shortcut icon" type="image/x-icon"/>
    <link href="../web/css/icon.css" rel="stylesheet" type="text/css">
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php if (!\Yii::$app->user->isGuest): ?>
        <div class="g-Ue-ad">
            <div class="g-Qx">
                <div class="g-Qx-eb X5yjGb">
                    <div class="kFx1Ae-xdwExf-eb-m">
                        <img id=":0.la" class="kFx1Ae-xdwExf-eb"
                             src="https://lh3.googleusercontent.com/4zsirp7PvHet1HV-6JWjLsTbzNkAFOJo9coBYcLXgt5WK7A-2zo3ShS4zDs-OKElEDgsgv_IdJNWRmk=w1920-h1080-p-k-nd-no">
                    </div>
                </div>
                <div class="g-Qx-n5VRYe"></div>
            </div>
        </div>
        <div class="clearboth"></div>
        <?php echo $this->render('@app/views/layouts/header') ?>
    <?php endif; ?>
    <div class="container-fluid">
        <?php echo Alert::widget() ?>
        <?php echo Xhr2Upload::widget();?>
        <?php echo $content ?>
    </div>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
