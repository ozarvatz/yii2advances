<?php

namespace frontend\controllers;
use common\models\utils\DevUtils;
/**
 * I generate this class by GII, did not contribute match to life;)
 */
class GameController extends \yii\web\Controller
{
	public function actions()
	{
		return 
		[
            'index' => 'app\controllers\gameActions\IndexAction',
            'data' => 'app\controllers\gameActions\DataAction',
            'async' => 'app\controllers\gameActions\AsyncAction',
		];
	}

	public function beforeAction($action)
    {
    	// DevUtils::pPrint($action->id, 'action->id', __METHOD__, __LINE__);
        $this->enableCsrfValidation = false;
        // if (in_array($action->id, ['async'])) {
        // }
        return parent::beforeAction($action);
    }
}
