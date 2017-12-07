<?php
namespace app\models\game\job;

use Yii;
use common\models\engine\JobAbs;
use common\models\engine\ExecutionResponse;
use common\models\utils\DevUtils;
use app\models\game\data_entity\GameDataEntity;


class AddEquation2DbJob extends JobAbs
{
	public function getDescription()
	{
		return "this job add equation to list";
	}
	
	// this is the place where problems get solved;)
	public function fork()
	{
		$data = &$this->getData();
		$inputParams = $data->getSection(GameDataEntity::INPUT_PARAMS);
		if(!isset($inputParams['isPost']))
		{
			$this->pushMessage(ExecutionResponse::ERROR, 'isPost parameter is not included');
			return false;
		}

		if(!$inputParams['isPost'])
		{
			$this->pushMessage(ExecutionResponse::INFO, 'isPost == false, nothing to add to the DB list');
			return true;
		}


		$model = $inputParams['model'];
		$model->setAnBnOperationOutOfTask($model->task);
		$model->answered = 1;
		if(!$model->save())
		{
			// DevUtils::pPrint($model->getErrors(), '$model->getErrors()', __METHOD__,  __LINE__);
			$this->pushMessage(ExecutionResponse::ERROR, 'filed execute DMath->save(), last error' . end($model->getErrors()));
			return false;
		}

		unset($model);
		
		$this->pushMessage(ExecutionResponse::OK, $this->getDescription());
		return true;
	}


}