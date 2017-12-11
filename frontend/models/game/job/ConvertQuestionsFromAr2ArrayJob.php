<?php 
namespace app\models\game\job;

use Yii;
use common\models\engine\JobAbs;
use common\models\engine\ExecutionResponse;
use common\models\utils\DevUtils;
use app\models\game\data_entity\GameDataEntity;
use yii\helpers\ArrayHelper;

class ConvertQuestionsFromAr2ArrayJob extends JobAbs
{
	public function getDescription()
	{
		return "convert Active-record list into simple array";
	}

	// this is the place where problems get solved
	public function fork()
	{
		$data = &$this->getData();
		$arEquationList = &$data->get(GameDataEntity::AREQUATION_LIST, GameDataEntity::EQUATION_LIST);
		$model = &$data->get('model', GameDataEntity::INPUT_PARAMS);
		$equationArray = &$this->convert($arEquationList);
		$model = [$model];
		$modelArray = &$this->convert($model);
		$data->put(GameDataEntity::EQUATION_ARRAY, $equationArray, GameDataEntity::EQUATION_LIST);
		$data->put(GameDataEntity::MODEL_ARRAY, $modelArray, GameDataEntity::EQUATION_LIST);

		$this->pushMessage(ExecutionResponse::OK, $this->getDescription());
		return true;
	}

	private function &convert(&$arList)
	{

		$result = ArrayHelper::toArray($arList, [
	        'app\models\db\DMath' => [
	            'id',
	            'task',
	            'result' => 'result',
	            'answer' => 'answer',
	        ],
	    ]);

		return $result;
	}
}