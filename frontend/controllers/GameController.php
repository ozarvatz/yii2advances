<?php

namespace frontend\controllers;
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
		];
	}
}
