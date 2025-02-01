<?php

namespace backend\controllers;

use Yii;
use core\entities\Chemical\ChemicalIngredientAssignment;
use core\entities\Chemical\ChemicalIngredientAssignmentSearch;
use core\forms\Chemical\ChemicalIngredientAssignmentForm;
use core\services\chemical\ChemicalIngredientAssignmentService;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class ChemicalIngredientAssignmentController extends Controller
{
    /** @var ChemicalIngredientAssignmentService service */
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
     * ChemicalIngredientAssignmentController constructor
     * @var $id
     * @var $module
     * @var ChemicalIngredientAssignmentService
     * @var array $config
     */
    public function __construct($id, $module, ChemicalIngredientAssignmentService $service, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->service = $service;
    }

    /**
     * Lists all ChemicalIngredientAssignment models.
     * @return mixed
     */
    public function actionIndex(): string
    {
        $searchModel = new ChemicalIngredientAssignmentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', ['searchModel' => $searchModel, 'dataProvider' => $dataProvider]);
    }

    /**
     * Displays a single ChemicalIngredientAssignment model.
     * @param integer $chemical_id
     * @param integer $ingredient_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($chemical_id, $ingredient_id): string
    {
        return $this->render('view', ['model' => $this->findModel($chemical_id, $ingredient_id)]);
    }

    /**
     * Creates a new ChemicalIngredientAssignment model.
     * @return mixed
     */
    public function actionCreate()
    {
        $form = new ChemicalIngredientAssignmentForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $chemicalIngredientAssignment = $this->service->create($form);
                return $this->redirect(['index']);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->render('create', ['model' => $form]);
    }

    /**
     * Updates an existing ChemicalIngredientAssignment model.
     * @param integer $chemical_id
     * @param integer $ingredient_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($chemical_id, $ingredient_id)
    {
        $chemicalIngredientAssignment = $this->findModel($chemical_id, $ingredient_id);

        $form = new ChemicalIngredientAssignmentForm($chemicalIngredientAssignment);
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->service->edit($chemicalIngredientAssignment->chemical_id, $chemicalIngredientAssignment->ingredient_id, $form);
                return $this->redirect(['index']);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->render('update', ['model' => $form]);
    }

    /**
     * Deletes an existing ChemicalIngredientAssignment model.
     * @param integer $chemical_id
     * @param integer $ingredient_id
     * @return mixed
     */
    public function actionDelete($chemical_id, $ingredient_id): Response
    {
        try {
            $this->service->remove($chemical_id, $ingredient_id);
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
     * Finds the ChemicalIngredientAssignment model based on its primary key value
     * @param integer $chemical_id
     * @param integer $ingredient_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function findModel($chemical_id, $ingredient_id): ChemicalIngredientAssignment
    {
        if (($model = ChemicalIngredientAssignment::findOne(['chemical_id' => $chemical_id, 'ingredient_id' => $ingredient_id])) !== null) {
            return $model;
        }
        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
