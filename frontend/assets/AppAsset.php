<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
    ];
    public $js = [
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
    
    /** 
     * load needed js file to a webpage
     */
    public static function addJS($view, $js) {
        $view->registerJsFile($js, [AppAsset::className(), 'depends' => 'backend\assets\AppAsset']);
    }
    
    /**
     * load needed css file to a webpage
     */
    public static function addCSS($view, $css) {
        $view->registerCssFile($css, [AppAsset::className(), 'depends' => 'backend\assets\AppAsset']);
    }
}
