<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Sign in';
$backArrowDisplay = "none";
$secondFormDisplay = "none";
$firstFormDisplay = "block";
if ($model->email != "" && $model->getErrors($model->email) == []) {
    $secondFormDisplay = "block";
    $backArrowDisplay = "block";
    $firstFormDisplay = "none";
}
$this->registerCssFile(Yii::$app->request->baseUrl . '/css/login.css');
$this->registerJsFile(Yii::$app->request->baseUrl . '/js/sakuraLogin.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
?>
<div class="site-login">

    <div class="site-login-hDr site-login-cTr">
        <div class="site-login-cTn">
            <h1>SAKURA</h1>
        </div>
    </div>
    <div class="site-login-cRd site-login-cs">
        <div class="site-login-cIrM">
            <canvas id="canvas" class="circle" width="96" height="96"></canvas>
        </div>
        <img id="back-arrow" class="site-login-bR" style="display: <?php echo $backArrowDisplay; ?>" aria-label="Back"
             src="<?php echo Yii::$app->request->baseUrl;?>/icons/navigation/1x_web/ic_arrow_back_grey_24dp.png">

        <div class="row">
            <div class="col-lg-12">
                <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
                <div id="first-form" style="display: <?php echo $firstFormDisplay; ?>">
                    <?php echo $form->field($model, 'email')
                        ->textInput(['autofocus' => true, 'placeholder' => 'Enter your email'])
                        ->label(false) ?>

                    <div class="form-group">
                        <?php echo Html::submitButton('Next', ['id' => 'next', 'class' => 'btn btn-primary btn-block', 'name' => 'login-button']) ?>
                    </div>
                    <a class="site-login-hlF" href="">
                        Need help?
                    </a>
                </div>
                <div id="second-form" style="display: <?php echo $secondFormDisplay; ?>">

                    <div>
                        <span id="site-login-emDpl"></span>
                    </div>

                    <?php echo $form->field($model, 'password')
                        ->textInput(['autofocus' => true, 'type' => 'password', 'placeholder' => 'Enter your password'])
                        ->label(false) ?>

                    <div class="form-group">
                        <?php echo Html::submitButton('Sign in', ['id' => 'signIn', 'class' => 'btn btn-primary btn-block', 'name' => 'login-button']) ?>
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