<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * This declares the asset files required by Gii.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class GiiAsset extends AssetBundle
{
    public $sourcePath = '@backend/gii/assets';
    public $css = [
        'css/main.css',
        'css/improve.css'
    ];
    public $js = [
        'js/bs4-native.min.js',
        'js/gii.js',
        'js/improve.js',
    ];
    public $depends = [
        'yii\web\YiiAsset'
    ];
}
