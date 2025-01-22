<?php

use app\components\crud\CRUDGenerator;
use app\components\model\ModelGenerator;
use yii\filters\AccessControl;

$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [
        'gridview' => [
            'class' => 'kartik\grid\Module',
        ],
        'gii' => [
            'generators' => [
                'migrik' => [
                    'class' => \insolita\migrik\gii\StructureGenerator::class,
                    'templates' => [
                        'custom' => '@backend/gii/templates/migrator_schema',
                    ],
                    'migrationPath' => '@console/migrations/',
                ],
                'migrikdata' => [
                    'class' => \insolita\migrik\gii\DataGenerator::class,
                    'templates' => [
                        'custom' => '@backend/gii/templates/migrator_data',
                    ],
                    'migrationPath' => '@console/migrations/',
                ],
                'model' => [
                    'class' => ModelGenerator::class,
                    'singularize' => True,
                    'enableI18N' => True,
                    'generateQuery' => True,
                    'ns' => 'core\entities',
                    'queryNs' => 'core\entities',
                    'templates' => [
                        'default' => '@backend/gii/templates/model/default',
                        'expert' => '@backend/gii/templates/model/expert'
                    ],
                    'template' => 'expert'
                ],
                'crud' => [
                    'class' => CRUDGenerator::class,
                    'baseControllerClass' => 'yii\web\Controller',
                    'modelClass' => 'core\entities\\',
                    'controllerClass' => 'backend\controllers\\',
                    'enableI18N' => True,
                    'templates' => [
                        'default' => '@backend/gii/templates/crud/default',
                        'expert' => '@backend/gii/templates/crud/expert'
                    ],
                    'template' => 'expert'
                ]
            ],
        ]
    ],
    'components' => [
        'project' => [
            'class' => '\core\services\kit\ProjectService',
        ],
        'view' => [
            'theme' => [
                'pathMap' => [
                    '@vendor/yiisoft/yii2-gii/src/views' => '@app/gii/views'
                ],
            ],
        ],
        'i18n' => [
            'translations' => [
                '*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@backend/messages',
                    'sourceLanguage' => 'lt',
                    'fileMap' => [
                        //'main' => 'main.php',
                    ],
                ],
            ],
        ],
        'request' => [
            'csrfParam' => '_csrf-backend',
            'baseUrl' => '/admin',
            'cookieValidationKey' => $params['cookieValidationKey']
        ],
        'user' => [
            'identityClass' => 'common\auth\Identity',
            'enableAutoLogin' => true,
            'identityCookie' => [
                'name' => '_identity',
                'httpOnly' => true,
                'domain' => $params['cookieDomain']
            ],
            'loginUrl' => ['auth/login'],
        ],
        'session' => [
            'name' => '_session',
            'cookieParams' => [
                'domain' => $params['cookieDomain'],
                'httpOnly' => true
            ]
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'backendUrlManager' => require __DIR__ . '/urlManager.php',
        'frontendUrlManager' => require __DIR__ . '/../../frontend/config/urlManager.php',
        'urlManager' => function () {
            return Yii::$app->get('backendUrlManager');
        },
    ],
    'as access' => [
        'class' => 'yii\filters\AccessControl',
        'except' => ['auth/login', 'site/error'],
        'rules' => [
            [
                'allow' => true,
                'roles' => ['manager'],
            ],
            [
                'allow' => false,
                'roles' => ['user'],
                'denyCallback' => function ($rule, $action) {
                    Yii::$app->user->logout();
                    $action->controller->redirect('auth/login');
                },
            ],
        ],
    ],
    'params' => $params,
];
