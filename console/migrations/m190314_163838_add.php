<?php

use yii\db\Migration;

/**
 * Class m190314_163838_add
 */
class m190314_163838_add extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        //TODO remove it in init or in installer
        $user = new \buben\models\User();
        $user->username = 'admin';
        $user->email = 'admin@ta.eshe';
        $user->setPassword('admin');
        $user->generateAuthKey();
        $user->save();
        echo "user created with:\r\nUsername: admin\r\nPassword: admin\r\n";
        $roleAdmin = Yii::$app->authManager->createRole('admin');
        $roleAdmin->description = 'admin';
        Yii::$app->authManager->add($roleAdmin);
        echo "create role admin\r\n";
        $role = Yii::$app->authManager->createRole('contentManager');
        $role->description = 'contentManager';
        Yii::$app->authManager->add($role);
        echo "create role contentManager\r\n";
        Yii::$app->authManager->assign($roleAdmin, $user->id);
        echo "assign role admin to user \r\n";
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        \buben\models\User::deleteAll(['and',['username'=>'admin'],['email'=>'admin@ta.eshe']]);

        return true;
    }
}
