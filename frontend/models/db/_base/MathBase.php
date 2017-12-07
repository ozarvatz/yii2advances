<?php

namespace app\models\db\_base;

use Yii;

/**
 * This is the model class for table "math".
 *
 * @property integer $id
 * @property string $task
 * @property double $result
 * @property double $answer
 * @property integer $answered
 */
class MathBase extends \common\models\GxActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'math';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['result', 'answer'], 'required'],
            [['result', 'answer'], 'number'],
            [['answered'], 'integer'],
            [['task'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'task' => 'Task',
            'result' => 'Result',
            'answer' => 'Answer',
            'answered' => 'Answered',
        ];
    }
}
