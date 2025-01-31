<?php
namespace frontend\controllers;

use core\entities\User\User;
use Yii;
use yii\web\Controller;


class SiteController extends Controller
{
    /**
     * @var User
     */
    private $currentUser;

    /**
     * @inheritdoc
     */
    public function actions(): array
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);

        if (!Yii::$app->user->isGuest){
            $this->currentUser = Yii::$app->user->identity->getUser();
        }
    }

    public function actionIndex(): string
    {
        if (!$this->currentUser){
            $this->view->params['addClass'] = 'sidebar-collapse';
        }
        return $this->render('index', []);
    }
}
