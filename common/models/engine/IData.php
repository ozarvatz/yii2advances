<?php

namespace common\models\engine;

interface IData
{
	public function put($key, &$value, $section);
	public function &get($key, $section);
	public function &getSection($section);
	public function &getData();
}