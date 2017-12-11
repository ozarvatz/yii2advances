<?php
namespace app\controllers\gameActions;

use Yii;
use yii\base\Action;
use yii\httpclient\Client;
use common\models\utils\DevUtils;
use app\models\game\conf\AddQuestion2SimpleArrayConf;
use app\models\game\data_entity\GameDataEntity;

class DataAction extends Action
{
	public function run()
	{
		$request = Yii::$app->request;
		$model = new \app\models\db\DMath();

		$gameData = new GameDataEntity();
		$confObj = new AddQuestion2SimpleArrayConf();
		$confObj->setData($gameData);

		$params = Yii::$app->request->get();
		$aspost = false;
		if(!empty($params['id']))
		{
			$model = \app\models\db\DMath::find()
			    ->where(['id' => $params['id']])
			    ->one();    
			$model->setAttributes(['answer' => $params['answer']]);
			$aspost = true;
		}

		// if($request->isPost)
		// {
		// 	$params = Yii::$app->request->post('DMath');
		// 	$model = \app\models\db\DMath::find()
		// 	    ->where(['id' => $params['id']])
		// 	    ->one();    
		// 	$model->setAttributes(['answer' => $params['answer']]);
		// }
		
		
		$gameData->put('isPost', $aspost, GameDataEntity::INPUT_PARAMS);
		$gameData->put('model', $model, GameDataEntity::INPUT_PARAMS);


		$confObj->execute();
		DevUtils::pPrint($gameData, 'gameData', __METHOD__, __LINE__);

		$arEquationList = $gameData->get(GameDataEntity::AREQUATION_LIST, GameDataEntity::EQUATION_LIST);
		$modelArray = $gameData->get(GameDataEntity::MODEL_ARRAY, GameDataEntity::EQUATION_LIST);

		$equationArray = $gameData->get(GameDataEntity::EQUATION_ARRAY, GameDataEntity::EQUATION_LIST);

		return \yii\helpers\Json::encode(['model' => $modelArray, 'equation_list' => $equationArray, 'model' => $model]);
	}
}


