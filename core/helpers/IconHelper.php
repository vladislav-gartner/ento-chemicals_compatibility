<?php


namespace core\helpers;


use core\entities\User\User;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

class IconHelper
{

    public static function icon($class): string
    {
        $class = "fa-2x {$class}";

        return Html::tag('i', '', [
            'class' => $class,
        ]);
    }

}