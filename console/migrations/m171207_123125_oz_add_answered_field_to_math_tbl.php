<?php

use yii\db\Migration;

/**
 * Class m171207_123125_oz_add_answered_field_to_math_tbl
 */
class m171207_123125_oz_add_answered_field_to_math_tbl extends Migration
{
    
    public function up()
    {
        $this->execute("
            ALTER TABLE `math` ADD `answered` TINYINT NOT NULL DEFAULT '0' AFTER `answer`;
        ");
    }

    public function down()
    {
    }
}
