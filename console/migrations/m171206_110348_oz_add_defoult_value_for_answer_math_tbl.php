<?php

use yii\db\Migration;

/**
 * Class m171206_110348_oz_add_defoult_value_for_answer_math_tbl
 */
class m171206_110348_oz_add_defoult_value_for_answer_math_tbl extends Migration
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
