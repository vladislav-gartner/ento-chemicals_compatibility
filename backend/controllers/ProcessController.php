<?php


namespace backend\controllers;

use core\repositories\bundle\BundleRepository;
use core\repositories\column\ColumnBundleRepository;
use core\useCases\ProcessService;
use yii\web\Controller;


class ProcessController extends Controller
{

    public function __construct(
        $id,
        $module,
        ProcessService $service,
        $config = []
    )
    {
        parent::__construct($id, $module, $config);
        $this->service = $service;
    }



}