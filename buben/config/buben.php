<?php
Yii::$container->set('yii\widgets\ActiveForm', [
    'errorSummaryCssClass' => 'has-error',
    'options' => [
        'enctype'=>'multipart/form-data'
    ],
    'fieldConfig' => [
        'errorOptions'=> ['class' => 'has-error'],
        'inputOptions'=> ['class' => 'form-control underlined']
    ],
]);
return [
    'id' => 'buben-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'buben\controllers',
    'bootstrap' => ['log'],
    'components' => [
        'user' => [
            'identityClass' => 'buben\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-buben', 'httpOnly' => true],
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
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@buben/mail',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'session' => [
            'name' => 'buben',
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '9T-rcIZGsadasdaserg',
        ],
        'assetManager' => [
            'bundles' => [
                'yii\web\JqueryAsset' => [
                    'js'=>[]
                ],
                'yii\bootstrap\BootstrapPluginAsset' => [
                    'js'=>[]
                ],
                'yii\bootstrap\BootstrapAsset' => [
                    'css' => [],
                ],
            ],
        ],
    ]
];
