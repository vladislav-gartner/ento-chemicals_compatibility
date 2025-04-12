<?php


namespace console\controllers;

use Yii;
use yii\base\ErrorException;
use yii\base\Exception;
use yii\console\Controller;
use yii\helpers\Console;
use yii\helpers\FileHelper;

class KitController extends Controller
{
    private $_clean_directory = [
        '@backend/components/' => '/backend/components/',
        '@backend/gii/' => '/backend/gii/',
        '@backend/controllers/kit/' => '/backend/controllers/kit/',
        '@backend/views/kit/' => '/backend/views/kit/',
        '@core/entities/Kit/' => '/core/entities/Kit/',
        '@core/forms/kit/' => '/core/forms/kit/',
        '@core/services/kit/' => '/core/services/kit/',
        '@core/repositories/kit/' => '/core/repositories/kit/',
        '@core/readModels/kit/' => '/core/readModels/kit/'
    ];

    private $_only_files = [
        '@backend/components/' => '/backend/components/',
    ];

    private $_only_single_files = [
        '@core/behaviors/PropertyBehavior.php' => '/core/behaviors/PropertyBehavior.php',
        '@core/entities/Property.php' => '/core/entities/Property.php',
        '@core/forms/PropertyForm.php' => '/core/forms/PropertyForm.php',
        '@core/traits/EntityServiceTrait.php' => '/core/traits/EntityServiceTrait.php',
        '@core/traits/StatusEntityServiceTrait.php' => '/core/traits/StatusEntityServiceTrait.php',
        '@backend/config/main-local.php' => '/backend/config/main-local.php',
    ];

    /**
     * @throws ErrorException
     */
    private function cleanIncludeDirectories($path)
    {
        $directories = FileHelper::findDirectories($path, ['recursive' => false]);

        foreach ($directories as $directory){
            FileHelper::removeDirectory($directory, ['recursive' => true]);
        }

        foreach (FileHelper::findFiles($path, ['except' => ['.gitignore']]) as $file){
            FileHelper::unlink($file);
        }
    }

    /**
     * @throws ErrorException
     */
    public function actionUpdate() : void
    {
        $source_path = Yii::getAlias("@root/../sv5kit.open");

        // Очищаем все каталоги
        foreach ($this->_clean_directory as $directory => $destination){
            $path = Yii::getAlias($directory);

            try {
                $this->cleanIncludeDirectories($path);
            } catch (Exception $e) {
                echo Console::ansiFormat($e->getMessage());
            }
        }

        // Копируем только каталоги
        foreach ($this->_clean_directory as $directory => $source){
            $src = "{$source_path}{$source}";
            $dst = Yii::getAlias($directory);

            FileHelper::copyDirectory($src, $dst, ['recursive' => true]);
        }

        // Копируем только файлы в каталоге
        foreach ($this->_only_files as $directory => $source){
            $src = "{$source_path}{$source}";
            $dst = Yii::getAlias($directory);

            $files = FileHelper::findFiles($src, ['except' => ['.gitignore'], 'recursive' => false]);

            foreach ($files as $file){
                $file_name = basename($file);
                $file_dst = "{$dst}{$file_name}";

                copy($file, $file_dst);
            }
        }

        foreach ($this->_only_single_files as $file => $source){
            $src = "{$source_path}{$source}";
            $dst = Yii::getAlias($file);

            copy($src, $dst);
        }

    }

}