<?php
namespace backend\controllers;

use core\rules\BannedRule;
use Yii;
use yii\web\Controller;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex(): string
    {
        return $this->render('index');
    }

    /**
     * @throws \Exception
     */
    public function actionRule()
    {

        $auth = Yii::$app->authManager;

        // Создаем правило
        $rule = new BannedRule();
        $auth->add($rule);

        //  Создаем разрешение, и привязываем к нему правило
        $doBanned = $auth->createPermission('doBanned');
        $doBanned->description = 'Бан только узеров';
        $doBanned->ruleName = $rule->name;
        $auth->add($doBanned);

        //  Достаем из базы менеджера
        $manager = $auth->getRole('manager');

        // Делаем наследование менеджером, разрешения
        $auth->addChild($manager, $doBanned);

    }
}
