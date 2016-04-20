<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace common\widgets\sakura;

use yii\web\AssetBundle;
use yii\web\View;

/**
 * @author Thuan <vuvanthuan081288@gmail.com>
 * @since 2.0
 */
class Xhr2UploadAsset extends AssetBundle
{
    public $sourcePath = '@common/widgets/sakura/assets';
    public $css = [
        'css/xhr2.css',
    ];

    public $js = [
        'js/jquery.xhr2.js',
    ];

    public $jsOptions = [
        'position' => View::POS_END,
    ];

    public $depends = [
        'yii\bootstrap\BootstrapPluginAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\web\JqueryAsset'
    ];
}
