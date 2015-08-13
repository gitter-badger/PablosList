<?php

class Input
{
    /**
     * Check if a given value was passed in the request
     *
     * @param string $key index to look for in request
     * @return boolean whether value exists in $_POST or $_GET
     */
    protected static $stringMin = 2;
    protected static $stringMax = 500;
    protected static $numMin = 0;
    protected static $numMax = 99999999999999999999999999999999999;

    public static function has($key)
    {
            return isset($_REQUEST[$key]) ? true : false;
    }

    /**
     * Get a requested value from either $_POST or $_GET
     *
     * @param string $key index to look for in index
     * @param mixed $default default value to return if key not found
     * @return mixed value passed in request
     */
    public static function get($key, $default = null)
    {
        // TODO: Fill in this function
        return self::has($key) ?  htmlspecialchars(strip_tags($_REQUEST[$key])) : $default;

    }

    public static function dumpPost()
    {
        // TODO: Fill in this function
        return isset($_POST) ?  var_dump($_POST) : null;

    }
    // Each of these methods should use the get() method internally to retrieve the value from $_POST or $_GET.
    // If the values does not exist, or match the expected type, throw an exception.

    // Update your getString() and getNumber() methods to each take two optional parameters: $min and $max.
    // Update your methods in the following manner:

    public static function getString($key, $min = 2, $max = 500)
    {

        // If $key is not a string, or $min & $max are not numbers, throw an InvalidArgumentException.
        if (!is_string($key) || !is_numeric($min) || !is_numeric($max)  ) {
            throw new InvalidArgumentException('$key must be a string && $min/$max must be numbers.');
        }
        // If the requested key is missing from the input, throw an OutOfRangeException
        if (!Input::has($key)) {
            throw new OutOfRangeException('$key was not found.');
        }
        // If the value is the wrong type, throw a DomainException
        if (!is_string(self::get($key))) {
            throw new DomainException('$key is not a string.');
        }
        // If a string is shorter than $min or longer than $max, throw a LengthException
        if ( strlen(self::get($key)) < $min || strlen(self::get($key)) > $max ) {
            throw new LengthException('String does not meet min/max length paramets.');
        }
        // If a number is less than $min or larger than $max, throw a RangeException
        if ($min < self::$stringMin || $max > self::$stringMax) {
            throw new RangeException('Please use a number between execepted Input min/max');
        }
        if ( self::get($key) && is_string(self::get($key)) ) {
            return trim(self::get($key));
        }
        else {
            if ( !self::get($key) ) {
                throw new Exception('$key not found in REQUEST');
            }
            if ( !is_string(self::get($key)) ) {
                throw new Exception('$key is not a string');
            }
        }
    }
    // If $key is not a string, or $min & $max are not numbers, throw an InvalidArgumentException.
    // If the requested key is missing from the input, throw an OutOfRangeException
    // If the value is the wrong type, throw a DomainException
    // If a string is shorter than $min or longer than $max, throw a LengthException
    // If a number is less than $min or larger than $max, throw a RangeException
    public static function getNumber($key, $min = 0, $max = 15)
    {
        // If $key is not a string, or $min & $max are not numbers, throw an InvalidArgumentException.
        if (!is_string($key) || !is_numeric($min) || !is_numeric($max)  ) {
            throw new InvalidArgumentException('$key must be a string && $min/$max must be numbers.');
        }
        // If the requested key is missing from the input, throw an OutOfRangeException
        if (!Input::has($key)) {
            throw new OutOfRangeException('$key was not found.');
        }
        $value = str_replace(',', '', Input::get($key));
        // If the value is the wrong type, throw a DomainException
        if (!is_numeric($value)) {
            throw new DomainException('$key is not a string.');
        }
        // If the numeric string is shorter than $min or longer than $max, throw a LengthException
        if ( strlen($value) < $min || strlen($value) > $max ) {
            throw new LengthException('String does not meet min/max length paramets.');
        }

        if ( $value && is_numeric($value) ) {
            return $value;
        }
        else {
            if ( !is_numeric($value) ) {
                throw new Exception('$key is not a number');
            }
        }
    }

    public static function getDate($key, $format = 'Y-m-d')
    {
        $value = static::get($key);
        $dateObject = new DateTime($value);
        if ($dateObject) {
        $dateString = $dateObject->format($format);
        return $dateString;
        } else {
            throw new Exception('Not able to instantiate DateTime Object.');
        }
    }
    ///////////////////////////////////////////////////////////////////////////
    //                      DO NOT EDIT ANYTHING BELOW!!                     //
    // The Input class should not ever be instantiated, so we prevent the    //
    // constructor method from being called. We will be covering private     //
    // later in the curriculum.                                              //
    ///////////////////////////////////////////////////////////////////////////
    private function __construct() {}
}
