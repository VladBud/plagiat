<?php
namespace components;
class Logger
{
    private static $logFile = 'logs/systemlog.txt';
    /**
     * @param bool|string $msg
     * @param bool|string $file
     * @param boolean $msgDate
     */
    public static function log($msg = false, $file = false, $msgDate = true)
    {
        if(is_bool($file) && $file === true) {
            self::$logFile = 'logs/' . date("D-M-Y") . '.txt';
        } elseif (is_string($file)){
            self::$logFile = 'logs/' . $file . '.txt';
        }
        if($msgDate)
            $msg = '[ ' . date('Y-m-d h:i:s') . ' ] ' . $msg;
        $msg = $msg . "\n";
        file_put_contents(self::$logFile, $msg, FILE_APPEND);
    }
}