<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace common\widgets\sakura;

class Xhr2Upload extends \yii\bootstrap\Widget
{
    public $option = [];

    /**
     * Initializes the widget.
     */
    public function init()
    {
        parent::init();
    }

    /**
     * Renders the widget.
     */
    public function run()
    {
        echo $this->render("xhr2", []);
    }


    /**
     * Registers the needed client assets
     *
     * @return void
     */
    public function registerAssets()
    {

    }
}
