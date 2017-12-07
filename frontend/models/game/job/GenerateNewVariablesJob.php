<?php 
namespace app\models\game\job;

use Yii;
use common\models\engine\JobAbs;
use common\models\engine\ExecutionResponse;
use common\models\utils\DevUtils;
use app\models\game\data_entity\GameDataEntity;


class GenerateNewVariablesJob extends JobAbs
{
	public function getDescription()
	{
		return "this job randomly calculate two numbers (int or double) and - or + operator";
	}

	// this is the place where problems get solved
	public function fork()
	{
		$this->generateEquation();
		$this->pushMessage(ExecutionResponse::OK, $this->getDescription());
		return true;
	}


	private function generateEquation()
	{
		$isDouble = rand(1, 2) == 2 
			? true
			: false;
		$isPlusOperation = rand(1, 2) == 2 
			? true
			: false; 
		$operator = $isPlusOperation ? '+' : '-';
		$a = rand(Yii::$app->params['min_num'], Yii::$app->params['max_num']);
		$b = rand(Yii::$app->params['min_num'], Yii::$app->params['max_num']);

		$quotientA = rand(0, 100) / 100;
		$quotientB = rand(0, 100) / 100;

		$quotientA = number_format($quotientA, 2, '.', '');
		$quotientB = number_format($quotientB, 2, '.', '');
		

		if($isDouble)
		{
			$a += $quotientA;
			$b += $quotientB;
		}

		$result = $isPlusOperation 
			? $a + $b
			: $a - $b;

		$data = &$this->getData();

		$data->put(GameDataEntity::PARAMETER_A, $a, GameDataEntity::EQUATION);
		$data->put(GameDataEntity::PARAMETER_B, $b, GameDataEntity::EQUATION);
		$data->put(GameDataEntity::OPERATOR,$operator , GameDataEntity::EQUATION);
		$data->put(GameDataEntity::RESULT, $result, GameDataEntity::EQUATION);
		// DevUtils::pPrint($data, 'data', __METHOD__, __LINE__);exit;
		

	}
}
