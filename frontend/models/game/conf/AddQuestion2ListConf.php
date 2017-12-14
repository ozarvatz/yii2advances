<?php 
namespace app\models\game\conf;
use common\models\engine\ExecuteConfAbs;
use app\models\game\job\GenerateNewVariablesJob;
use app\models\game\job\AddEquation2DbJob;
use app\models\game\job\InsertNewEquation2DbJob;
use app\models\game\job\LoadEquationListFromDbJob;


class AddQuestion2ListConf extends ExecuteConfAbs
{
	public function getDescription()
	{
		return "Create list and add new question if necessary";
	}

	public function getConf()
	{
		return 
		[
			new AddEquation2DbJob(),
			new GenerateNewVariablesJob(),
			new InsertNewEquation2DbJob(),
			new LoadEquationListFromDbJob(),
		];
	}
}