<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>
<div class="site-error">
    <?php if ($exception->statusCode == 404): ?>
        <div class="error-404">
            <img src="../web/icons/404.png"/>
        </div>
    <?php endif; ?>
</div>
