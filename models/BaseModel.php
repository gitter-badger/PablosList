<?php
class Model {

    protected static $dbc;
    protected static $table;
    protected static $id;
    private $attributes = array();
    protected $columnNames = array();
    protected static $dbTables = array();

    /*
     * Constructor
     */
    public function __construct()
    {
         self::dbConnect();
        //  self::setTables();
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
         $columns = self::$dbc->query("SELECT `COLUMN_NAME`, `DATA_TYPE`, `COLUMN_KEY`
                                        FROM `INFORMATION_SCHEMA`.`COLUMNS`
                                        WHERE `TABLE_SCHEMA` = '" . DB_NAME . "' AND `TABLE_NAME` = '" . static::$table . "';")->fetchAll(PDO::FETCH_ASSOC);
         if(!empty($this->attributes))
         {
             isset($this->attributes[static::$id]) ? $this->update($columns) : $this->insert($columns);
         }
     }

     protected function update($columns)
     {
         $numItems = count($columns);
         $i 		  = 0;
         $append   = '';
         $query 	  = "UPDATE ".static::$table." SET";

         foreach($columns as $column)
         {
             if($column['COLUMN_KEY'] != 'PRI')
             {
                 /**
                 *Assumes the existence via - 1 of one int type element of $columns...
                 */
                 (++$i == $numItems - 1) ? $query .= " " .$column['COLUMN_NAME']." = :".$column['COLUMN_NAME'] : $query.= " ". $column['COLUMN_NAME']. " = :".$column['COLUMN_NAME'].",";
             }
             else
             {
                 $append = " WHERE ".$column['COLUMN_NAME']. " = :".$column['COLUMN_NAME'];
             }

         }

         $query .= $append;

         $stmt = self::$dbc->prepare($query);

         foreach($this->attributes as $attribute => $value)
         {
             $type = (is_numeric($value)) ? PDO::PARAM_INT : PDO::PARAM_STR;
             $stmt->bindValue(":{$attribute}", $value, $type);
         }

         $stmt->execute();


     }

     protected function insert($columns)
     {
         $query	  = 'INSERT INTO ' . static::$table . ' (';
         $values   = 'VALUES (';
         $i		  = 0;
         $numItems = count($columns);
         //var_dump($numItems);

         foreach($columns as $column)
         {
             if($column['COLUMN_KEY'] != 'PRI')
             {
                 $query .= (++$i == $numItems - 1) ? $column['COLUMN_NAME'] . ') ' : $column['COLUMN_NAME'] . ', ';

                 if($column['DATA_TYPE'] != 'date')
                 {

                     $values .= ($i == $numItems - 1) ? ':' . $column['COLUMN_NAME'] . ');' : ':' . $column['COLUMN_NAME'] . ', ';
                 }
                 else
                 {
                     $values .= ($i == $numItems - 1) ? 'cast(:' . $column['COLUMN_NAME'] . ' as DATE));' : ' cast(:' . $column['COLUMN_NAME'] . ' as DATE), ';
                 }
             }

         }

         $query .= $values;

         $stmt = self::$dbc->prepare($query);
         print($query);
         print_r($this->attributes);

         foreach($this->attributes as $attribute => $value)
         {
             $type = (is_numeric($value)) ? PDO::PARAM_INT : PDO::PARAM_STR;
             $stmt->bindValue(":{$attribute}", $value, $type);
         }

         $stmt->execute();

         $stmt = self::$dbc->prepare("SELECT " . static::$id . " FROM " . static::$table . " ORDER BY " . static::$id . " DESC LIMIT 1;");

         $stmt->execute();

         $data = $stmt->fetch(PDO::FETCH_ASSOC);
         $this->attributes[static::$id] = $data[static::$id];

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
