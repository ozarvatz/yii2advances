<?php

use yii\db\Migration;

/**
 * Class m171205_122254_oz_update_math_to_suport_float
 */
class m171205_122254_oz_update_math_to_suport_float extends Migration
{
    
    public function up()
    {
        $this->execute("
            ALTER TABLE `math` CHANGE `result` `result` FLOAT(32) NOT NULL;
        ");
    }

    public function down()
    {
        
    }
}
