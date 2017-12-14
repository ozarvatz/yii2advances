<?php

use yii\db\Migration;

/**
 * Class m171205_122254_oz_update_math_to_suport_float
 */
class m171205_122254_oz_update_math_to_suport_float extends Migration
{
    
    public function safeUp()
    {
    	$this->alterColumn('math', 'result', $this->double()->notNull());
    }

    public function safeDown()
    {
        $this->alterColumn('math', 'result', $this->integer());
    }
}
