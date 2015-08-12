<?php

define('DB_HOST', '127.0.0.1');
define('DB_NAME','pablo_db');
define('DB_USER','pablo_user');
define('DB_PASS','duckthis');

class Model {

    protected static $dbc;
    protected static $table;
    protected static $id;
    private $attributes = array();


    /*
     * Constructor
     */
    public function __construct()
    {
         self::dbConnect();
    }

    /*
     * Connect to the DB
     */
    protected static function dbConnect()
    {
        if (!self::$dbc)
        {
            // @TODO: Connect to database
            self::$dbc = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASS);
            self::$dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        }
    }


    public function getTables()
    {
        return self::$dbTables;
    }

    /*
     * Get a value from attributes based on name
     */
    public function __get($name)
    {
        // @TODO: Return the value from attributes with a matching $name, if it exists
        return array_key_exists($name, $this->attributes) ? $this->attributes[$name] : null;

    }

    /*
     * Set a new attribute for the object
     */
    public function __set($name, $value)
    {
        // @TODO: Store name/value pair in attributes array
        $this->attributes[$name] = $value;

    }

    /*
     * Persist the object to the database
     */

    /*
     * Find a record based on an id
     */


    /*
     * Find all records in a table
     */
    public static function all()
    {
        self::dbConnect();
        $stmt = self::$dbc->query('SELECT TABLE_NAME, COLUMN_NAME, COLUMN_KEY, DATA_TYPE from INFORMATION_SCHEMA.COLUMNS
                                    WHERE TABLE_SCHEMA = '."'".DB_NAME."'");
        // @TODO: Learning from the previous method, return all the matching records
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getAllData()
    {
        $data = self::all();
        array_filter( function(){

        });
    }
}
?>
