<?php 

namespace common\models\engine;

use common\models\engine\ExecuteAbs;

/**
 * the sub class inherit this, should implement methods:
 * getDescription() - shortly describe the class.
 * fork() - do something.
 */
abstract class JobAbs extends ExecuteAbs
{
	public function getConf()
	{
		return null;
	}
}
