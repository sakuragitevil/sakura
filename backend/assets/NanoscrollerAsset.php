<?php
/**
 * Created by PhpStorm.
 * User: Thuan
 * Date: 4/15/2016
 * Time: 10:28 AM
 */
namespace yii\web;

use yii\web\AssetBundle;

/**
 * Asset bundle for the Twitter bootstrap css files.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class NanoscrollerAsset extends AssetBundle
{
    public $sourcePath = '@bower/nanoscroller';
    public $css = [
        'nanoscroller.css',
    ];

    public $js = [
        'jquery.nanoscroller.min.js',
    ];

    public $jsOptions = [
        'position' => View::POS_HEAD,
    ];

    public $depends = [
        'yii\web\JqueryAsset',
    ];
}