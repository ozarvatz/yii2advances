<?php

namespace common\models\engine;

interface IExecute
{
	public function execute();
	public function getDescription();
	public function &getData();
	public function setData(&$data);
	public function getConf();

	public function &continueOnFalse($bool); //continue to the next exec chain
	public function isContinueOnFalse();
}