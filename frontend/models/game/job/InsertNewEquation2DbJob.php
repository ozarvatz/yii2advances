<?php
namespace app\models\game\job;

use Yii;
use common\models\engine\JobAbs;
use common\models\engine\ExecutionResponse;
use common\models\utils\DevUtils;
use app\models\game\data_entity\GameDataEntity;
use app\models\db\DMath;

class InsertNewEquation2DbJob extends JobAbs
{
	public function getDescription()
	{
		return "this job add equastion to db via math model";
	}
	
	// this is the place where problems get solved
	public function fork()
	{
		$data = &$this->getData();
		$inputParams = &$data->getSection(GameDataEntity::INPUT_PARAMS);
		
		
		$model = new DMath();
		$equation = $data->getSection(GameDataEntity::EQUATION);

		$operator = $equation[GameDataEntity::OPERATOR];
			$model->answer = -1;
			// DevUtils::pPrint($equation, 'equation', __METHOD__, __LINE__);
			'+' == $operator 
				? $model->add($equation[GameDataEntity::PARAMETER_A], $equation[GameDataEntity::PARAMETER_B])
				: $model->sub($equation[GameDataEntity::PARAMETER_A], $equation[GameDataEntity::PARAMETER_B]);

			// DevUtils::pPrint($model->answer, 'model->answer', __METHOD__, __LINE__);exit;
			if(!empty($model->getErrors()))
			{
				// DevUtils::pPrint($model->getErrors(), 'model->getErrors()', __METHOD__, __LINE__);
				$this->pushMessage(ExecutionResponse::ERROR, 'model parameter is not included, last error : ' + end($model->getErrors()));
			}

			$data->put('model', $model, GameDataEntity::INPUT_PARAMS);

		$this->pushMessage(ExecutionResponse::OK, $this->getDescription());
		return true;
	}
}