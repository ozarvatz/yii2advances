<?php
namespace app\controllers\gameActions;

use Yii;
use yii\base\Action;
use yii\httpclient\Client;
use common\models\utils\DevUtils;
use app\models\game\conf\AddQuestion2ListConf;
use app\models\game\data_entity\GameDataEntity;
/**
 * action index for game controller.
 * usually I prefer file per action, especially if the action is big or if there are many actions per controller. 
 */
class IndexAction extends Action
{
	public function run()
	{
		$request = Yii::$app->request;
		$model = new \app\models\db\DMath();

		$gameData = new GameDataEntity();
		$confObj = new AddQuestion2ListConf();
		$confObj->setData($gameData);

		if($request->isPost)
		{
			$params = Yii::$app->request->post('DMath');
			$model = \app\models\db\DMath::find()
			    ->where(['id' => $params['id']])
			    ->one();    
			$model->setAttributes(['answer' => $params['answer']]);
		}
		
		
		$gameData->put('isPost', $request->isPost, GameDataEntity::INPUT_PARAMS);
		$gameData->put('model', $model, GameDataEntity::INPUT_PARAMS);


		$confObj->execute();
		// DevUtils::pPrint($gameData, 'gameData', __METHOD__, __LINE__);

		$arEquationList = $gameData->get(GameDataEntity::AREQUATION_LIST, GameDataEntity::EQUATION_LIST);
		$model = $gameData->get('model', GameDataEntity::INPUT_PARAMS);

		// return $this->controller->render('async_jqueary',
		// return $this->controller->render('async',
		return $this->controller->render('index',
		[
			GameDataEntity::AREQUATION_LIST => $arEquationList,
			'model' => $model,
		]);
	}
}

