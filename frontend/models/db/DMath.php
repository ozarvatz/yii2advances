<?php

namespace app\models\db;
use achertovsky\math\models\Math;
use yii\helpers\ArrayHelper;
use common\models\utils\DevUtils;
/**
 * This is the model class for table "dmath" inherit for Achertovsky testtask-math.
 * This is the model class for table "math".
 * 
 * @property integer $a
 * @property integer $b
 * @property string $task
 * @property double $result
 * @property double $answer
 */
class DMath extends \achertovsky\math\models\Math
{
	/**
     * @inheritdoc
     */
    public function rules()
    {
		return [
            [['task', 'result', 'answer'], 'required'],
            [['task', 'operation'], 'string'],
            [['result', 'answer'], 'number'],
            [['answered'], 'integer'],
            [['a', 'b'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        $senarios = ArrayHelper::merge(
            parent::scenarios(),
            [
                'operation' => ['a', 'b'],
                'result' => ['task', 'result', 'answer'],
            ]
        );
        return $senarios;
    }

    /**
     * Making preparements before save to db and return true
     * @inheritdoc
     */
    public function beforeSave($insert)
    {
        parent::beforeSave($insert);
        $this->setScenario('result');
        return true;
    }

    /**
     * Set a, b and operation properties from task str.
     * use as bypass for the befor save (return false) of \achertovsky\math\models\Math
     * @param [type] $task [description]
     */
    public function setAnBnOperationOutOfTask($task)
    {
        $this->operation = strpos($task, "+") === false
            ? '-'
            : '+';
        $pos = strpos($task, $this->operation);

        $this->a = substr($task, 0, $pos);
        $this->b = substr($task, $pos + 1, strlen($task));
    }

}


