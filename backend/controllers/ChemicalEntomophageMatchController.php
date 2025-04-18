<?php

namespace backend\controllers;

use Yii;
use core\entities\Match\ChemicalEntomophageMatch;
use core\entities\Match\ChemicalEntomophageMatchSearch;
use core\forms\Match\ChemicalEntomophageMatchForm;
use core\services\match\ChemicalEntomophageMatchService;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class ChemicalEntomophageMatchController extends Controller
{
    /** @var ChemicalEntomophageMatchService service */
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
     * ChemicalEntomophageMatchController constructor
     * @var $id
     * @var $module
     * @var ChemicalEntomophageMatchService
     * @var array $config
     */
    public function __construct($id, $module, ChemicalEntomophageMatchService $service, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->service = $service;
    }

    /**
     * Lists all ChemicalEntomophageMatch models.
     * @return mixed
     */
    public function actionIndex(): string
    {
        $searchModel = new ChemicalEntomophageMatchSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', ['searchModel' => $searchModel, 'dataProvider' => $dataProvider]);
    }

    /**
     * Displays a single ChemicalEntomophageMatch model.
     * @param integer $id
     * @param integer $chemical_id
     * @param integer $entomophage_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id, $chemical_id, $entomophage_id): string
    {
        return $this->render('view', ['model' => $this->findModel($id, $chemical_id, $entomophage_id)]);
    }

    /**
     * Creates a new ChemicalEntomophageMatch model.
     * @return mixed
     */
    public function actionCreate()
    {
        $form = new ChemicalEntomophageMatchForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $chemicalEntomophageMatch = $this->service->create($form);
                return $this->redirect(['index']);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->render('create', ['model' => $form]);
    }

    /**
     * Updates an existing ChemicalEntomophageMatch model.
     * @param integer $id
     * @param integer $chemical_id
     * @param integer $entomophage_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id, $chemical_id, $entomophage_id)
    {
        $chemicalEntomophageMatch = $this->findModel($id, $chemical_id, $entomophage_id);

        $form = new ChemicalEntomophageMatchForm($chemicalEntomophageMatch);
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->service->edit($chemicalEntomophageMatch->id, $chemicalEntomophageMatch->chemical_id, $chemicalEntomophageMatch->entomophage_id, $form);
                return $this->redirect(['index']);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->render('update', ['model' => $form]);
    }

    /**
     * Deletes an existing ChemicalEntomophageMatch model.
     * @param integer $id
     * @param integer $chemical_id
     * @param integer $entomophage_id
     * @return mixed
     */
    public function actionDelete($id, $chemical_id, $entomophage_id): Response
    {
        try {
            $this->service->remove($id, $chemical_id, $entomophage_id);
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
     * Finds the ChemicalEntomophageMatch model based on its primary key value
     * @param integer $id
     * @param integer $chemical_id
     * @param integer $entomophage_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function findModel($id, $chemical_id, $entomophage_id): ChemicalEntomophageMatch
    {
        if (($model = ChemicalEntomophageMatch::findOne(['id' => $id, 'chemical_id' => $chemical_id, 'entomophage_id' => $entomophage_id])) !== null) {
            return $model;
        }
        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
