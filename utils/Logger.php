<?php

class Log
{
    protected $filename;
    protected $handle;
    protected $prefix;

    public function __construct($prefix = 'log')
    {
        $this->prefix = $prefix."-";
    }

    public function __destruct()
    {
        if ( isset($this->handle) ) {
            fclose($this->handle);
        }
    }

    public function logMessage($level, $message)
    {
        date_default_timezone_set('America/Chicago');

		$filename = $this->prefix.date("Y-m-d").".log";
		$date = date('Y-m-d H:i:s');
		$handle = fopen($filename, 'a+');
		fwrite($handle, "[{$level}]: {$message} Timestamp: {$date}\n");
		fclose($handle);
    }
    public function info($message)
    {
        $logLevel = "INFO";
        $this->logMessage($logLevel, $message);
    }

    public function error($message)
    {
        $logLevel = "ERROR";
        $this->logMessage($logLevel, $message);
    }

} // END LOG CLASS
?>
