<?php
namespace app\models\game\job;

use Yii;
use common\models\engine\JobAbs;
use common\models\engine\ExecutionResponse;
use common\models\utils\DevUtils;
use app\models\game\data_entity\GameDataEntity;


class AddUserResult2EquationJob extends JobAbs
{
	public function getDescription()
	{
		return "this job add equation to list";
	}
	
	// this is the place where problems get solved
	public function fork()
	{
		$data = &$this->getData();
		$inputParams = $data->getSection(GameDataEntity::INPUT_PARAMS);
		
		if(!isset($inputParams['user_result']))
		{
			$this->pushMessage(ExecutionResponse::INFO, 'user_result parameter is not included, description : ' + $this->getDescription());
			return true;
		}

		$data->put(GameDataEntity::USER_RESULT, $inputParams['user_result'], GameDataEntity::EQUATION);

		$this->pushMessage(ExecutionResponse::OK, $this->getDescription());
		return true;
	}
}