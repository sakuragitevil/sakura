<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

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
    <link href="../web/img/sakura.ico" rel="shortcut icon" type="image/x-icon"/>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
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
    <div class="container-fluid">
        <?= Alert::widget() ?>
        <?= $this->render('@app/views/layouts/header') ?>
        <?= $content ?>
    </div>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
