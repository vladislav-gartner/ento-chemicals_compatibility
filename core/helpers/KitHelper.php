<?php


namespace core\helpers;


use core\entities\Kit\EntityFieldGroup;
use Yii;
use yii\db\Connection;
use yii\db\TableSchema;
use yii\helpers\FileHelper;
use yii\helpers\Inflector;
use yii\helpers\StringHelper;

class KitHelper
{
    /**
     * @var Connection
     */
    private static $db;

    /**
     * @var TableSchema
     */
    private static $schema;

    /**
     * @var string[]
     */
    private static $tables;

    /**
     * @param $excluded string[]
     * @return array|string[]
     */
    public static function tableList(array $excluded): array
    {
        self::$db = Yii::$app->db;
        self::$schema = self::$db->schema;
        self::$tables = self::$schema->getTableNames();

        $result = [];
        foreach (self::$tables as $table){
            if(array_key_exists($table, $excluded)){
                continue;
            }
            $result[$table] = $table;
        }

        if (env('HOST') == 'sv5kit.open'){
            $kitTableNames = Yii::$app->kit->schema->getTableNames();
            foreach ($kitTableNames as $table){
                if(array_key_exists($table, $excluded)){
                    continue;
                }
                $result[$table] = $table;
            }
        }

        return $result;
    }

    /**
     * @param $excluded string[]
     * @return array
     */
    public static function entityList(array $excluded): array
    {
        $result = [];
        foreach (self::tableList($excluded) as $tableName){
            $className = Inflector::classify($tableName);
            if (StringHelper::startsWith($className, 'Kit')){
                $className = str_replace('Kit', '', $className);
            }

            $result[$className] = $className;
        }

        return $result;
    }

    /**
     * @return array
     */
    public static function entitySubdirectoryList() : array
    {
        $root = Yii::getAlias('@core/entities');
        $result = [];
        foreach (FileHelper::findDirectories($root) as $directory){
            $directory = str_replace(['\\', '/'], '', str_replace($root, '', $directory));
            $result[$directory] = $directory;
        }

        return $result;
    }

    /**
     * @return array
     */
    public static function controllerSubdirectoryList() : array
    {
        $root = Yii::getAlias('@backend/controllers');
        $result = [];
        foreach (FileHelper::findDirectories($root) as $directory){
            $directory = str_replace(['\\', '/'], '', str_replace($root, '', $directory));
            $result[$directory] = $directory;
        }

        return $result;
    }

    /**
     * @param string|array $mix
     * @param string[] $prefix
     */
    public static function cleanKitPrefix(&$mix, $prefix = ['kit_', 'Kit'])
    {
        if ( gettype($mix) == 'string' ){
            $mix = str_replace($prefix, '', $mix);
        }elseif (gettype($mix) == 'array'){

            $result = [];
            foreach ($mix as $key => $value) {

                if (gettype($value) == 'string'){
                    $result[$key] = str_replace($prefix, '', $value);
                }elseif (gettype($value) == 'array'){

                    foreach ($value as $key1 => $value1) {

                        if (gettype($value1) == 'string'){
                            $result[$key][$key1] = str_replace($prefix, '', $value1);
                        }elseif (gettype($value1) == 'boolean'){
                            $result[$key][$key1] = $value1;
                        }

                    }

                }

            }

            $mix = $result;
        }
    }

    public static function databaseList(array $excluded = []): array
    {
        self::$db = Yii::$app->db;

        $databaseList = self::$db
            ->createCommand("SHOW DATABASES WHERE `Database` NOT IN ('information_schema', 'mysql', 'performance_schema')")
            ->queryColumn();

        $result = [];
        foreach ($databaseList as $database){
            if(array_key_exists($database, array_flip($excluded))){
                continue;
            }
            $result[$database] = $database;
        }

        return $result;
    }

    public static function entityGroupList(): array
    {
        return \yii\helpers\ArrayHelper::map(EntityFieldGroup::find()->all(), 'name', 'name');
    }
}