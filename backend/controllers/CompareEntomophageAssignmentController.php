<?php

namespace backend\controllers;

use Yii;
use core\entities\Compare\CompareEntomophageAssignment;
use core\entities\Compare\CompareEntomophageAssignmentSearch;
use core\forms\Compare\CompareEntomophageAssignmentForm;
use core\services\compare\CompareEntomophageAssignmentService;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class CompareEntomophageAssignmentController extends Controller
{
    /** @var CompareEntomophageAssignmentService service */
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
     * CompareEntomophageAssignmentController constructor
     * @var $id
     * @var $module
     * @var CompareEntomophageAssignmentService
     * @var array $config
     */
    public function __construct($id, $module, CompareEntomophageAssignmentService $service, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->service = $service;
    }

    /**
     * Lists all CompareEntomophageAssignment models.
     * @return mixed
     */
    public function actionIndex(): string
    {
        $searchModel = new CompareEntomophageAssignmentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', ['searchModel' => $searchModel, 'dataProvider' => $dataProvider]);
    }

    /**
     * Displays a single CompareEntomophageAssignment model.
     * @param integer $compare_id
     * @param integer $entomophage_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($compare_id, $entomophage_id): string
    {
        return $this->render('view', ['model' => $this->findModel($compare_id, $entomophage_id)]);
    }

    /**
     * Creates a new CompareEntomophageAssignment model.
     * @return mixed
     */
    public function actionCreate()
    {
        $form = new CompareEntomophageAssignmentForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $compareEntomophageAssignment = $this->service->create($form);
                return $this->redirect(['index']);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->render('create', ['model' => $form]);
    }

    /**
     * Updates an existing CompareEntomophageAssignment model.
     * @param integer $compare_id
     * @param integer $entomophage_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($compare_id, $entomophage_id)
    {
        $compareEntomophageAssignment = $this->findModel($compare_id, $entomophage_id);

        $form = new CompareEntomophageAssignmentForm($compareEntomophageAssignment);
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->service->edit($compareEntomophageAssignment->compare_id, $compareEntomophageAssignment->entomophage_id, $form);
                return $this->redirect(['index']);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->render('update', ['model' => $form]);
    }

    /**
     * Deletes an existing CompareEntomophageAssignment model.
     * @param integer $compare_id
     * @param integer $entomophage_id
     * @return mixed
     */
    public function actionDelete($compare_id, $entomophage_id): Response
    {
        try {
            $this->service->remove($compare_id, $entomophage_id);
        } catch (\DomainException $e) {
            Yii::$app->errorHandler->logException($e);
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        return $this->redirect(['index']);
    }

    /**
     * Finds the CompareEntomophageAssignment model based on its primary key value
     * @param integer $compare_id
     * @param integer $entomophage_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function findModel($compare_id, $entomophage_id): CompareEntomophageAssignment
    {
        if (($model = CompareEntomophageAssignment::findOne(['compare_id' => $compare_id, 'entomophage_id' => $entomophage_id])) !== null) {
            return $model;
        }
        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
