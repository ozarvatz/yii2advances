<?php

use yii\db\Migration;

/**
 * Class m171206_092255_oz_create_user_answer_math_tbd
 */
class m171206_092255_oz_create_user_answer_math_tbd extends Migration
{
    
    public function up()
    {
        $this->execute("
            ALTER TABLE `math` ADD `answer` FLOAT(32) NOT NULL AFTER `result`;
        ");
    }

    public function down()
    {
    }
}
