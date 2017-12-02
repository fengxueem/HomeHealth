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
        'css/site/site.css',
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
        $view->registerJsFile($js, ['depends' => 'frontend\assets\AppAsset']);
    }
    
    /**
     * load needed css file to a webpage
     */
    public static function addCSS($view, $css) {
        // the 'depends' option mean that this css file will be added after the css file from 
        // frontend\assets\AppAsset, which is declared in $css.
        $view->registerCssFile($css, ['depends' => 'frontend\assets\AppAsset']);
    }
}
