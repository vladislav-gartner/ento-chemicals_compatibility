<?php


namespace core\useCases;


use core\dto\DTOExcel;
use PHPExcel_CachedObjectStorageFactory;
use PHPExcel_IOFactory;
use PHPExcel_Reader_Exception;
use PHPExcel_Settings;
use Yii;
use yii\base\Exception;


class BaseService
{
    /**
     * @param string $filename
     * @return DTOExcel
     * @throws PHPExcel_Reader_Exception
     */
    public function getDTOExcel(string $filename) : DTOExcel
    {

        $cacheMethod = PHPExcel_CachedObjectStorageFactory::cache_in_memory_gzip;
        $cacheSettings = ['memoryCacheSize' => '256MB'];
        PHPExcel_Settings::setCacheStorageMethod($cacheMethod, $cacheSettings);

        $type = PHPExcel_IOFactory::identify($filename);
        $objReader = PHPExcel_IOFactory::createReader($type);
        $objReader->setReadDataOnly(true);

        $info = $objReader->listWorksheetInfo($filename);

        return new DTOExcel($objReader, $type, $info);
    }

    protected function readFileXLSX($filename): array
    {
        try {

            $DTOExcel = $this->getDTOExcel($filename);

            $objPHPExcel = @$DTOExcel->reader->load($filename);
            return $objPHPExcel->getActiveSheet()->toArray();
        } catch (PHPExcel_Reader_Exception $e) {
            return [];
        }
    }
}