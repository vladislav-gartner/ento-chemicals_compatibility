<?php

namespace backend\controllers;

use Yii;
use core\entities\Entomophage\Entomophage;
use core\entities\Entomophage\EntomophageSearch;
use core\forms\Entomophage\EntomophageForm;
use core\services\entomophage\EntomophageService;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class EntomophageController extends Controller
{
    /** @var EntomophageService service */
    public $service;

    public function actions(): array
    {
        return [
            'active' => [
                'class' => \core\actions\ActiveAction::class,
            ],
            'batch' => [
                'class' => \core\actions\BatchAction::class,
                'tableName' => 'entomophage',
            ],
        ];
    }

    public function behaviors(): array
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => ['delete' => ['POST']],
            ],
        ];
    }

    /**
     * EntomophageController constructor
     * @var $id
     * @var $module
     * @var EntomophageService
     * @var array $config
     */
    public function __construct($id, $module, EntomophageService $service, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->service = $service;
    }

    /**
     * Lists all Entomophage models.
     * @return mixed
     */
    public function actionIndex(): string
    {
        $searchModel = new EntomophageSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', ['searchModel' => $searchModel, 'dataProvider' => $dataProvider]);
    }

    /**
     * Displays a single Entomophage model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id): string
    {
        return $this->render('view', ['model' => $this->findModel($id)]);
    }

    /**
     * Creates a new Entomophage model.
     * @return mixed
     */
    public function actionCreate()
    {
        $form = new EntomophageForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $entomophage = $this->service->create($form);
                return $this->redirect(['index']);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->render('create', ['model' => $form]);
    }

    /**
     * Updates an existing Entomophage model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $entomophage = $this->findModel($id);

        $form = new EntomophageForm($entomophage);
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->service->edit($entomophage->id, $form);
                return $this->redirect(['index']);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->render('update', ['model' => $form]);
    }

    /**
     * Deletes an existing Entomophage model.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id): Response
    {
        try {
            $this->service->remove($id);
        } catch (\DomainException $e) {
            Yii::$app->errorHandler->logException($e);
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        return $this->redirect(['index']);
    }

    /**
     * @return yii\web\Response
     */
    public function actionTruncate(): Response
    {
        try {
            $this->service->truncate();
            Yii::$app->session->setFlash('success', Yii::t('app', 'Data cleared'));
        } catch (\DomainException $e) {
            Yii::$app->errorHandler->logException($e);
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        return $this->redirect(['index']);
    }

    /**
     * Finds the Entomophage model based on its primary key value
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function findModel($id): Entomophage
    {
        if (($model = Entomophage::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
