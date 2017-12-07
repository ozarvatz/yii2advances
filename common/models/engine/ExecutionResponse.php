<?php
namespace common\models\engine;

class ExecutionResponse 
{
	const OK 		 = 1;
	const ERROR 		 = 2;
	const WARNING 	 = 3;
	const INFO 		 = 4;
	const PREFORMANCE = 5;
	
	public static function getDescription($key, $message)
	{	
		return self::_getDescription($key) . ", message : " . $message;
	}

	public static function getLogLevel($key)
	{
		switch ($key) {
			case 1:
				return 'info';
				break;
			case 2:
				return 'error';
				break;
			case 3:
				return 'warning';
				break;
			case 4:
				return 'info';
				break;
			case 5:
				return 'trace';
				break;
			default:
				break;
		}
	}
	
	private static function _getDescription($key)
	{
		switch ($key) {
			case 1:
				return "Execution succeed";
			case 2:
				return "Execution faild";
			case 3:
				return "Execution warning";
			case 4:
				return "Execution info";
			case 5:
				return "Execution preformance";
				
			default:
				return "Execution, unsupported index (" + $key + ")";
		}
	}
	
}
