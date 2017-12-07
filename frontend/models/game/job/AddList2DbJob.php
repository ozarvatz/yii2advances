<?php 
namespace app\models\game\job;

use Yii;
use common\models\engine\JobAbs;
use common\models\engine\ExecutionResponse;
use common\models\utils\DevUtils;
use app\models\game\data_entity\GameDataEntity;
use app\models\db\DMath;

class AddList2DbJob extends JobAbs
{
	public function getDescription()
	{
		return "save equastion list to DB";
	}

	// this is the place where problems get solved
	public function fork()
	{
		$data = $this->getData();
		// DevUtils::pPrint($data->getData(), 'data aray', __METHOD__, __LINE__);exit;
		$equestionList = $data->getSection(GameDataEntity::EQUATION_LIST);
		$inputParams = $data->getSection(GameDataEntity::INPUT_PARAMS);
		if(!isset($inputParams['isPost']))
		{
			$this->pushMessage(ExecutionResponse::INFO, 'isPost parameter is not included, description : ' + $this->getDescription());
			return true;
		}

		$equationList = &$data->getSection(GameDataEntity::EQUATION_LIST);
		foreach ($equationList as $equation) 
		{
			DevUtils::pPrint($equation, 'equation', __METHOD__, __LINE__);
			$operator = $equation[GameDataEntity::OPERATOR];
			$model = new DMath();
			$model->answer = isset($equation[GameDataEntity::USER_RESULT]) 
				? $equation[GameDataEntity::USER_RESULT]
				: 0;
			DevUtils::pPrint($equation, 'equation', __METHOD__, __LINE__);
			'+' == $operator 
				? $model->add($equation[GameDataEntity::PARAMETER_A], $equation[GameDataEntity::PARAMETER_B])
				: $model->sub($equation[GameDataEntity::PARAMETER_A], $equation[GameDataEntity::PARAMETER_B]);

			// DevUtils::pPrint($model->answer, 'model->answer', __METHOD__, __LINE__);exit;
			if(!$model->save())
			{
				DevUtils::pPrint($model->getTableSchema(), 'model->getTableSchema()', __METHOD__, __LINE__);exit;
				DevUtils::pPrint($model->getErrors(), 'model->getErrors()', __METHOD__, __LINE__);exit;
			}
		}

		$this->pushMessage(ExecutionResponse::OK, $this->getDescription());
		return true;
	}
}