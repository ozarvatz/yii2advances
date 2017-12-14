<?php

use yii\db\Migration;

/**
 * Class m171206_092255_oz_create_user_answer_math_tbd
 */
class m171206_092255_oz_create_user_answer_math_tbd extends Migration
{
    
    public function safeUp()
    {
    	$this->addColumn('math', 'answer', $this->double()->notNull()->after('result'));
    }

    public function safeDown()
    {
    	$this->dropColumn('math', 'answer');
    }
}
