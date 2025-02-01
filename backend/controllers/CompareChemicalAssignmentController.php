<?php

namespace backend\controllers;

use Yii;
use core\entities\Compare\CompareChemicalAssignment;
use core\entities\Compare\CompareChemicalAssignmentSearch;
use core\forms\Compare\CompareChemicalAssignmentForm;
use core\services\compare\CompareChemicalAssignmentService;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class CompareChemicalAssignmentController extends Controller
{
    /** @var CompareChemicalAssignmentService service */
    public $service;

    public function actions(): array
    {
        return [
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
     * CompareChemicalAssignmentController constructor
     * @var $id
     * @var $module
     * @var CompareChemicalAssignmentService
     * @var array $config
     */
    public function __construct($id, $module, CompareChemicalAssignmentService $service, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->service = $service;
    }

    /**
     * Lists all CompareChemicalAssignment models.
     * @return mixed
     */
    public function actionIndex(): string
    {
        $searchModel = new CompareChemicalAssignmentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', ['searchModel' => $searchModel, 'dataProvider' => $dataProvider]);
    }

    /**
     * Displays a single CompareChemicalAssignment model.
     * @param integer $compare_id
     * @param integer $chemical_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($compare_id, $chemical_id): string
    {
        return $this->render('view', ['model' => $this->findModel($compare_id, $chemical_id)]);
    }

    /**
     * Creates a new CompareChemicalAssignment model.
     * @return mixed
     */
    public function actionCreate()
    {
        $form = new CompareChemicalAssignmentForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $compareChemicalAssignment = $this->service->create($form);
                return $this->redirect(['index']);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->render('create', ['model' => $form]);
    }

    /**
     * Updates an existing CompareChemicalAssignment model.
     * @param integer $compare_id
     * @param integer $chemical_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($compare_id, $chemical_id)
    {
        $compareChemicalAssignment = $this->findModel($compare_id, $chemical_id);

        $form = new CompareChemicalAssignmentForm($compareChemicalAssignment);
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->service->edit($compareChemicalAssignment->compare_id, $compareChemicalAssignment->chemical_id, $form);
                return $this->redirect(['index']);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->render('update', ['model' => $form]);
    }

    /**
     * Deletes an existing CompareChemicalAssignment model.
     * @param integer $compare_id
     * @param integer $chemical_id
     * @return mixed
     */
    public function actionDelete($compare_id, $chemical_id): Response
    {
        try {
            $this->service->remove($compare_id, $chemical_id);
        } catch (\DomainException $e) {
            Yii::$app->errorHandler->logException($e);
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        return $this->redirect(['index']);
    }

    /**
     * Finds the CompareChemicalAssignment model based on its primary key value
     * @param integer $compare_id
     * @param integer $chemical_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function findModel($compare_id, $chemical_id): CompareChemicalAssignment
    {
        if (($model = CompareChemicalAssignment::findOne(['compare_id' => $compare_id, 'chemical_id' => $chemical_id])) !== null) {
            return $model;
        }
        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
