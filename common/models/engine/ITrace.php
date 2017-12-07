<?php
namespace common\models\engine;

/**
 * this file is part of the engine ecosystem 
 */
interface ITrace
{
	public function pushMessage($messageId, $message);
	public function &getTracingDoc();
}