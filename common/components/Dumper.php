<?php

namespace common\components;

use yii\helpers\Console;
use yii\helpers\VarDumper;

class Dumper extends VarDumper
{

    public static function dump($var, $depth = 10, $highlight = true)
    {
        parent::dump($var, $depth, $highlight);
        echo '<br/><br/>';
    }

    public static function dd($var, $depth = 10, $highlight = true)
    {
        ob_clean();
        parent::dump($var, $depth, $highlight);
        exit('');
    }

    public static function ddc($var)
    {
        ob_clean();
        echo Console::ansiFormat($var, [Console::FG_RED, Console::BOLD]);
        exit('');
    }

}