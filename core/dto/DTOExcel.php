<?php


namespace core\dto;

class DTOExcel
{
    public $reader;
    public $type;
    public $info;
    public $rows;
    public $columns;

    public function __construct($objReader, $type, $listWorksheetInfo)
    {
        $this->reader = $objReader;
        $this->type = $type;
        $this->info = $listWorksheetInfo;
        $this->setUp();
    }

    public function setUp()
    {
        $this->rows = $this->info[0]['totalRows'];
        $this->columns = $this->info[0]['totalColumns'];
    }
}