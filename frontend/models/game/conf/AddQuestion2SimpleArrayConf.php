<?php 
namespace app\models\game\conf;
use common\models\engine\ExecuteConfAbs;
use app\models\game\conf\AddQuestion2ListConf;
use app\models\game\job\ConvertQuestionsFromAr2ArrayJob;

class AddQuestion2SimpleArrayConf extends ExecuteConfAbs
{
	public function getDescription()
	{
		return "Wrap question list, from ar list into array that can be delevered as simple json";
	}

	public function getConf()
	{
		return 
		[
			new AddQuestion2ListConf(),
			new ConvertQuestionsFromAr2ArrayJob(),
		];
	}
}