<?php


namespace backend\controllers;

use core\repositories\NotFoundException;
use core\services\import\ImportService;
use Yii;
use yii\base\DynamicModel;
use yii\web\Controller;
use yii\web\UploadedFile;

set_time_limit(0);

class ImportController extends Controller
{

    /**
     * @var ImportService
     */
    private $service;

    /**
     * @var yii\web\UploadedFile
     */
    protected $_file;

    public function __construct($id, $module, ImportService $importService, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->service = $importService;
    }

    public function actionIndex(): string
    {
        return $this->render('index');
    }

    public function actionUpload()
    {

        $model = new DynamicModel(['file']);
        $model->setAttributeLabels([
            'file' => Yii::t('app','File')
        ]);

        $model->addRule(['file'], 'file', ['extensions' => 'xls, xlsx', 'skipOnEmpty' => true]);

        if (Yii::$app->request->isPost) {

            if ($model->load(Yii::$app->request->post()) && $model->validate()) {

                $this->_file = UploadedFile::getInstance($model, 'file');
                $model->file = $this->_file->name;

                $extension = $this->_file->getExtension();

                switch ($extension) {

                    case 'xlsx';
                    case 'xls';

                        try {
                            $this->service->importByUpload($this->_file);
                            return $this->redirect(['import/upload']);
                        } catch (NotFoundException $e) {
                            Yii::$app->errorHandler->logException($e);
                            Yii::$app->session->setFlash('error', $e->getMessage());
                        }

                        break;

                }

            }

        }

        return $this->render('upload', [
            'model' => $model,
        ]);

    }


}