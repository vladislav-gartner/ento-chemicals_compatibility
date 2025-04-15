<?php

namespace backend\controllers;

use Yii;
use core\entities\ChemicalPopup\ChemicalPopup;
use core\entities\ChemicalPopup\ChemicalPopupSearch;
use core\forms\ChemicalPopup\ChemicalPopupForm;
use core\services\chemicalpopup\ChemicalPopupService;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class ChemicalPopupController extends Controller
{
    /** @var ChemicalPopupService service */
    public $service;

    public function actions(): array
    {
        return [
            'active' => [
                'class' => \core\actions\ActiveAction::class,
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
     * ChemicalPopupController constructor
     * @var $id
     * @var $module
     * @var ChemicalPopupService
     * @var array $config
     */
    public function __construct($id, $module, ChemicalPopupService $service, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->service = $service;
    }

    /**
     * Lists all ChemicalPopup models.
     * @return mixed
     */
    public function actionIndex(): string
    {
        $searchModel = new ChemicalPopupSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', ['searchModel' => $searchModel, 'dataProvider' => $dataProvider]);
    }

    /**
     * Displays a single ChemicalPopup model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id): string
    {
        return $this->render('view', ['model' => $this->findModel($id)]);
    }

    /**
     * Creates a new ChemicalPopup model.
     * @return mixed
     */
    public function actionCreate()
    {
        $form = new ChemicalPopupForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $chemicalPopup = $this->service->create($form);
                return $this->redirect(['index']);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->render('create', ['model' => $form]);
    }

    /**
     * Updates an existing ChemicalPopup model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $chemicalPopup = $this->findModel($id);

        $form = new ChemicalPopupForm($chemicalPopup);
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->service->edit($chemicalPopup->id, $form);
                return $this->redirect(['index']);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->render('update', ['model' => $form]);
    }

    /**
     * Deletes an existing ChemicalPopup model.
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
     * Finds the ChemicalPopup model based on its primary key value
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function findModel($id): ChemicalPopup
    {
        if (($model = ChemicalPopup::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
