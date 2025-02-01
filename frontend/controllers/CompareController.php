<?php

namespace frontend\controllers;

use core\entities\Compare\Compare;
use core\entities\Compare\CompareSearch;
use core\entities\Match\ChemicalEntomophageMatch;
use core\entities\User\User;
use core\forms\Compare\CompareForm;
use core\readModels\match\ChemicalEntomophageMatchReadRepository;
use core\services\compare\CompareService;
use OAuth2\Storage\DynamoDBTest;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use Yii\web\Session;

class CompareController extends Controller
{
    /** @var CompareService service */
    public $service;

    /** @var User */
    protected $currentUser;

    /**
     * @var Session
     */
    protected $session;

    /**
     * @var ChemicalEntomophageMatchReadRepository
     */
    protected $matchReadRepository;

    public function behaviors(): array
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => ['delete' => ['POST']],
            ],
        ];
    }

    public function __construct(
        $id,
        $module,
        CompareService $service,
        ChemicalEntomophageMatchReadRepository $matchReadRepository,
        $config = []
    )
    {
        parent::__construct($id, $module, $config);
        $this->service = $service;
        $this->matchReadRepository = $matchReadRepository;

        $this->session = Yii::$app->session;

        if (!Yii::$app->user->isGuest){
            $this->currentUser = Yii::$app->user->identity->getUser();
        }
    }

    /**
     * @return Compare|null
     */
    private function getCurrentCompare(): ?Compare
    {
        return $this->service->getOrInsert($this->currentUser->id, time());
    }

    public function actionIndex(): string
    {
        $compare = $this->getCurrentCompare();

        $form = new CompareForm($compare);
        $form->user_id = $this->currentUser->id;
        $form->created_at = time();

        $post = $this->getPost();

        if (Yii::$app->request->isPost){
            $loaded = $form->load($post);
            $validate = $form->validate();
        }

        if ($form->load($post, null, true) && $form->validate()) {
            try {
                $this->service->edit($compare->id, $form);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }

        $entomophages = $compare->getEntomophages()->all();
        $chemicals = $compare->getChemicals()->all();

        /** @var ChemicalEntomophageMatch[] $matches */
        $matches = [];
        foreach ($entomophages as $entomophage){

            foreach ($chemicals as $chemical){
                $match = $this->matchReadRepository->findByFuture(
                    $entomophage->id,
                    $chemical->id
                );

                $matches[$entomophage->id][] = $match;
            }
        }

        return $this->render('index', [
            'matches' => $matches,
            'model' => $form
        ]);
    }

    /**
     * @throws NotFoundHttpException
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

    public function findModel($id): Compare
    {
        if (($model = Compare::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    private function getPost()
    {
        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();

            if (!key_exists('CompareChemicalForm', $post)){
                $post['CompareChemicalForm'] = [];
            }

            if (!key_exists('CompareEntomophageForm', $post)){
                $post['CompareEntomophageForm'] = [];
            }
        } else {
            $post = [];
        }
        return $post;
    }
}
