<?php

class Log
{
    protected $filename;
    protected $handle;

    public function __construct($prefix = 'log')
    {
        $this->setfilename($prefix);
        $this->handle = fopen($this->filename, 'a');

    }

    protected function setfilename($prefix)
    {
        if (is_string($prefix)) {
            $filename = $prefix.'-'.date('Y-m-d').".log";
            if ( touch($filename) && is_writable($filename) ){
                $this->filename = $filename;
            } else {
                die;
            }
        } else {
            die;
        }
    }

    public function getfilename()
    {
        return $this->filename;
    }

    public function __destruct()
    {
        if ( isset($this->handle) ) {
            fclose($this->handle);
        }
    }

    public function logMessage($logLevel, $message)
    {
        fwrite($this->handle, '['.$logLevel.'] '.$message.PHP_EOL);
    }
    // Methods info() and error() that will take in a message and forward it on to logMessage()
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
