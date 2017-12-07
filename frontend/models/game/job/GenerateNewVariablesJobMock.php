<?php 
namespace app\models\game\job;

use common\models\engine\JobAbs;
use common\models\engine\ExecutionResponse;
class GenerateNewVariablesJobMock extends JobAbs
{
	public function getDescription()
	{
		return "this job use as test for GenerateNewVariablesJob";
	}

	public function fork()
	{
		$data = &$this->getData();

		$this->pushMessage(ExecutionResponse::OK, $this->getDescription());
		return true;
	}
}
