<?php

namespace app\models\game\data_entity;
use common\models\engine\IData;

class GameDataEntity implements IData
{
	const INPUT_PARAMS = 'input_params';
	const EQUATION = 'equation';
	const PARAMETER_A = 'parameter_a';
	const PARAMETER_B = 'parameter_b';
	const OPERATOR = 'operator';
	const RESULT = 'result';
	const USER_RESULT = 'user_result';

	const EQUATION_LIST = 'equation_list';
	CONST AREQUATION_LIST = 'arEquationList';

	private $data;	

	public function __construct($data = [])
	{
		$this->data = $data;
	}

	public function put($key, &$value, $section)
	{
		$this->data[$section][$key] = $value;
	}

	public function &get($key, $section)
	{
		$retVal = isset($this->data[$section][$key])
			? $this->data[$section][$key]
			: null;
		return $retVal;
	}

	public function &getSection($section)
	{
		empty($this->data[$section])
			? $this->data[$section] = []
			: null;

		return $this->data[$section];
	}

	public function &getData()
	{
		return $this->data;
	}
}