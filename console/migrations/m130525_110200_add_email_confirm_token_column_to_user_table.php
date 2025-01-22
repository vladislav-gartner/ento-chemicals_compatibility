<?php

use \yii\db\Migration;

class m130525_110200_add_email_confirm_token_column_to_user_table extends Migration
{
    public function up()
    {
        $this->addColumn('{{%user}}', 'email_confirm_token', $this->string()->defaultValue(null));
    }

    public function down()
    {
        $this->dropColumn('{{%user}}', 'email_confirm_token');
    }
}
