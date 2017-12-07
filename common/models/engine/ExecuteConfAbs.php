<?php 

namespace common\models\engine;

use common\models\engine\ExecuteAbs;

/**
 * the sub class inherit this, should implement methods:
 * getDescription() - shortly describe the class.
 * getConfig() - return execute list to execute.
 */
abstract class ExecuteConfAbs extends ExecuteAbs
{
	public function fork()
	{
		return true;
	}
}
