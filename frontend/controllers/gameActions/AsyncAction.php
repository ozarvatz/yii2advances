<?php
namespace app\controllers\gameActions;

use yii\base\Action;
use yii\httpclient\Client;

class AsyncAction extends Action
{
	public function run()
	{
		return $this->controller->render('async_jqueary');
	}
}