<?php
class Model {

    protected static $dbc;
    protected static $table;
    public $attributes = array();
    protected $columnNames = array();
    protected static $dbTables = array();

    /*
     * Constructor
     */
    public function __construct()
    {
         self::dbConnect();
         self::setTables();
    }

    /*
     * Connect to the DB
     */
    private static function dbConnect()
    {
        if (!self::$dbc)
        {
            // @TODO: Connect to database
            self::$dbc = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASS);
            self::$dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        }
    }

    private static function setTables()
    {
        $tableStmt = self::$dbc->query('SHOW TABLES');
        $tablesArray = $tableStmt->fetchAll();
        foreach ($tablesArray as $value) {
            self::$dbTables[]= $value[0];
        }

    }

    public function getTables()
    {
        return self::$dbTables;
    }

    public function getColumnNames()
    {
        $columnStmt = self::$dbc->query("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS
        WHERE TABLE_NAME = '".static::$table."'");
        $columnsArray = $columnStmt->fetchAll();
        foreach ($columnsArray as $value) {
            $this->columnNames[]= $value['COLUMN_NAME'];
        }
        return $this->columnNames;
    }
    // private function setDataType()
    // {
    //     "SELECT DATA_TYPE FROM INFORMATION_SCHEMA.COLUMNS
    //     WHERE TABLE_NAME = '$table'
    //     AND "
    //
    // }
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
    public function save()
    {
        // @TODO: Ensure there are attributes before attempting to save
            $attributes = [];
            foreach ($this->columnNames as $value) {
                $attributes[]= $value;
            }
            print_r(array_diff($attributes, $this->attributes));
        // @TODO: Perform the proper action - if the `id` is set, this is an update, if not it is a insert

        // @TODO: Ensure that update is properly handled with the id key

        // @TODO: After insert, add the id back to the attributes array so the object can properly reflect the id

        // @TODO: You will need to iterate through all the attributes to build the prepared query

        // @TODO: Use prepared statements to ensure data security
    }
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
