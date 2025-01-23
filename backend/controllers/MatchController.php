<?php

namespace backend\controllers;

use Yii;
use core\entities\Match\Match;
use core\entities\Match\MatchSearch;
use core\forms\Match\MatchForm;
use core\services\match\MatchService;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class MatchController extends Controller
{
    /** @var MatchService service */
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
     * MatchController constructor
     * @var $id
     * @var $module
     * @var MatchService
     * @var array $config
     */
    public function __construct($id, $module, MatchService $service, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->service = $service;
    }

    /**
     * Lists all Match models.
     * @return mixed
     */
    public function actionIndex(): string
    {
        $searchModel = new MatchSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', ['searchModel' => $searchModel, 'dataProvider' => $dataProvider]);
    }

    /**
     * Displays a single Match model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id): string
    {
        return $this->render('view', ['model' => $this->findModel($id)]);
    }

    /**
     * Creates a new Match model.
     * @return mixed
     */
    public function actionCreate()
    {
        $form = new MatchForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $match = $this->service->create($form);
                return $this->redirect(['index']);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->render('create', ['model' => $form]);
    }

    /**
     * Updates an existing Match model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $match = $this->findModel($id);

        $form = new MatchForm($match);
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->service->edit($match->id, $form);
                return $this->redirect(['index']);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->render('update', ['model' => $form]);
    }

    /**
     * Deletes an existing Match model.
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
     * Finds the Match model based on its primary key value
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function findModel($id): Match
    {
        if (($model = Match::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
