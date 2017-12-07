<?php

use yii\db\Migration;

/**
 * Class m171206_092713_oz_create_user_answer_math_tbd_not_null
 */
class m171206_092713_oz_create_user_answer_math_tbd_not_null extends Migration
{
    public function up()
    {
        $this->execute("
            ALTER TABLE `math` CHANGE `answer` `answer` FLOAT(32) NOT NULL;
        ");
    }

    public function down()
    {
    
    }
    
}
