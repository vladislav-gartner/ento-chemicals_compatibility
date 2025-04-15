<?php

namespace backend\controllers;

use Yii;
use core\entities\EntomophagePopup\EntomophagePopup;
use core\entities\EntomophagePopup\EntomophagePopupSearch;
use core\forms\EntomophagePopup\EntomophagePopupForm;
use core\services\entomophagepopup\EntomophagePopupService;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class EntomophagePopupController extends Controller
{
    /** @var EntomophagePopupService service */
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
     * EntomophagePopupController constructor
     * @var $id
     * @var $module
     * @var EntomophagePopupService
     * @var array $config
     */
    public function __construct($id, $module, EntomophagePopupService $service, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->service = $service;
    }

    /**
     * Lists all EntomophagePopup models.
     * @return mixed
     */
    public function actionIndex(): string
    {
        $searchModel = new EntomophagePopupSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', ['searchModel' => $searchModel, 'dataProvider' => $dataProvider]);
    }

    /**
     * Displays a single EntomophagePopup model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id): string
    {
        return $this->render('view', ['model' => $this->findModel($id)]);
    }

    /**
     * Creates a new EntomophagePopup model.
     * @return mixed
     */
    public function actionCreate()
    {
        $form = new EntomophagePopupForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $entomophagePopup = $this->service->create($form);
                return $this->redirect(['index']);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->render('create', ['model' => $form]);
    }

    /**
     * Updates an existing EntomophagePopup model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $entomophagePopup = $this->findModel($id);

        $form = new EntomophagePopupForm($entomophagePopup);
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->service->edit($entomophagePopup->id, $form);
                return $this->redirect(['index']);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->render('update', ['model' => $form]);
    }

    /**
     * Deletes an existing EntomophagePopup model.
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
     * Finds the EntomophagePopup model based on its primary key value
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function findModel($id): EntomophagePopup
    {
        if (($model = EntomophagePopup::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
