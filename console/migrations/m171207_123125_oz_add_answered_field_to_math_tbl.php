<?php

use yii\db\Migration;

/**
 * Class m171207_123125_oz_add_answered_field_to_math_tbl
 */
class m171207_123125_oz_add_answered_field_to_math_tbl extends Migration
{
    
    public function safeUp()
    {
    	$this->addColumn('math', 'answered', $this->smallInteger(5)->notNull()->defaultValue(-1)->after('answer'));
    }

    public function safeDown()
    {
    	$this->dropColumn('math', 'answered');
    }
}
