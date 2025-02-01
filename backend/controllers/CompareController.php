<?php

namespace backend\controllers;

use Yii;
use core\entities\Compare\Compare;
use core\entities\Compare\CompareSearch;
use core\forms\Compare\CompareForm;
use core\services\compare\CompareService;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class CompareController extends Controller
{
    /** @var CompareService service */
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
     * CompareController constructor
     * @var $id
     * @var $module
     * @var CompareService
     * @var array $config
     */
    public function __construct($id, $module, CompareService $service, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->service = $service;
    }

    /**
     * Lists all Compare models.
     * @return mixed
     */
    public function actionIndex(): string
    {
        $searchModel = new CompareSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', ['searchModel' => $searchModel, 'dataProvider' => $dataProvider]);
    }

    /**
     * Displays a single Compare model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id): string
    {
        return $this->render('view', ['model' => $this->findModel($id)]);
    }

    /**
     * Creates a new Compare model.
     * @return mixed
     */
    public function actionCreate()
    {
        $form = new CompareForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $compare = $this->service->create($form);
                return $this->redirect(['index']);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->render('create', ['model' => $form]);
    }

    /**
     * Updates an existing Compare model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $compare = $this->findModel($id);

        $form = new CompareForm($compare);
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->service->edit($compare->id, $form);
                return $this->redirect(['index']);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->render('update', ['model' => $form]);
    }

    /**
     * Deletes an existing Compare model.
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
     * Finds the Compare model based on its primary key value
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function findModel($id): Compare
    {
        if (($model = Compare::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
