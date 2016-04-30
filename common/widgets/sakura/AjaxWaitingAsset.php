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
class AjaxWaitingAsset extends AssetBundle
{
    public $sourcePath = '@common/widgets/sakura/assets';
    public $css = [
        'css/ajax.waiting.css',
    ];

    public $js = [
        'js/ajax.waiting.js',
    ];

    public $jsOptions = [
        'position' => View::POS_END,
    ];

    public $depends = [
        'yii\web\JqueryAsset'
    ];
}
