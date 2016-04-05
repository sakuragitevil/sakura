<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Sign in';
$this->registerJsFile(Yii::$app->request->baseUrl.'/js/sakuraLogin.js',['depends' => [\yii\web\JqueryAsset::className()]]);
?>
<div class="site-login">

    <div class="sakura-header-bar centered">
        <div class="header content">
            <h1>SAKURA</h1>
        </div>
    </div>

    <div class="banner">
        <h2>Sign in to add account </h2>
    </div>

    <div class="card card-sigin">
        <div class="circle-mask">
            <canvas id="canvas" class="circle" width="96" height="96"></canvas>
        </div>
        <img id="back-arrow" class="back-arrow" aria-label="Back" src="../web/img/arrow_back_grey600_24dp.png">
        <div class="row">
            <div class="col-lg-12">
                <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
                <div id="first-form" style="display: block">
                    <?= $form->field($model, 'email')
                        ->textInput(['autofocus' => true,'placeholder' => 'Enter your email'])
                        ->label(false)?>

                    <div class="form-group">
                        <?= Html::submitButton('Next', ['id' => 'next', 'class' => 'btn btn-primary btn-block', 'name' => 'login-button']) ?>
                    </div>
                    <a class="need-help" href="">
                        Need help?
                    </a>
                </div>
                <div id="second-form" style="display: none">

                    <div>
                        <span id="email-display"></span>
                    </div>

                    <?= $form->field($model, 'password')
                        ->textInput(['autofocus' => true, 'type' => 'password', 'placeholder' => 'Enter your password'])
                        ->label(false)?>

                    <div class="form-group">
                        <?= Html::submitButton('Sign in', ['id' => 'signIn', 'class' => 'btn btn-primary btn-block', 'name' => 'login-button']) ?>
                    </div>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    var validateEmailUrl = '<?php echo yii\helpers\Url::to(['site/login']);?>';
</script>