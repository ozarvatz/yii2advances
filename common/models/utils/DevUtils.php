<?php
namespace common\models\utils;
use yii\helpers\VarDumper;
/**
 * just a static class for printing and dumping 
 */
class DevUtils 
{

	public static function pPrint($obj, $title = '', $method = __METHOD__, $line = __LINE__, $return = false, $levels = 15) 
	{
        self::prettyColorPrintR($obj, "{$method} ({$line}) - {$title}", $return, $levels);
    }

	public static function prettyColorPrintR($obj, $title = '', $return = false, $levels = 15) 
	{
        $print = '<div style="direction:ltr;">';
        $print .= $title != '' ? $title . ':' : '';
        $print .= '<pre>' . PHP_EOL;
        $print .= VarDumper::dumpAsString($obj, $levels, true);
        $print .= '</pre></div><hr />' . PHP_EOL;

        if ($return) 
        {
            return $print;
        }
        else 
        {
            echo $print;
        }
    }

    public static function getCurrentFloatTimestamp($floatVal = true) {
        $comps = explode(' ', microtime());
        if ($floatVal) {
            return floatval(sprintf('%d.%03d', $comps[1], $comps[0] * 1000));
        }

        return sprintf('%d.%03d', $comps[1], $comps[0] * 1000);
    }
}