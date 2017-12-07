<?php
namespace app\models\game\job;

use Yii;
use common\models\engine\JobAbs;
use common\models\engine\ExecutionResponse;
use common\models\utils\DevUtils;
use app\models\game\data_entity\GameDataEntity;
use app\models\db\DMath;

class LoadEquationListFromDbJob extends JobAbs
{
	public function getDescription()
	{
		return "load equation list from DB";
	}
	
	// this is the place where problems get solved
	public function fork()
	{
		$data = &$this->getData();
		
		$arEquationList = DMath::find()->where("answered = 1")->all();
		
		$data->put(GameDataEntity::AREQUATION_LIST, $arEquationList, GameDataEntity::EQUATION_LIST);

		$this->pushMessage(ExecutionResponse::OK, $this->getDescription());
		return true;
	}
}