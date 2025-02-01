<?php


namespace core\helpers;

use yii\helpers\ArrayHelper;
use yii\helpers\Html;

class CompareHelper
{

    public static function matchLabel($match_id, $content, $prefix = 'full-width-label'): string
    {
        switch ($match_id) {
            case 1:
                $class = 'label label-success';
                break;
            case 2:
                $class = 'label label-danger';
                break;
            case 3:
                $class = 'label label-warning';
                break;

            default:
                $class = 'label label-default';
                break;
        }

        $class = "{$prefix} {$class}";

        return Html::tag('span', $content, ['class' => $class]);
    }

    static function labelDefault($value, $class = 'label label-default'): string
    {
        return Html::tag('span', "{$value}", ['class' => $class]);
    }
}