<?php
require_once 'BaseModel.php';
class User extends Model {

    protected static $table = 'users';
	protected static $id    = 'user_id';

    public static function find($id)
    {
        // Get connection to the database
        parent::dbConnect();

        // @TODO: Create select statement using prepared statements
        $stmt = parent::$dbc->prepare('SELECT * FROM users WHERE user_id = :id');

        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        // @TODO: Store the resultset in a variable named $result
        $results = $stmt->fetch(PDO::FETCH_ASSOC);
        // The following code will set the attributes on the calling object based on the result variable's contents

        $instance = null;
        if ($results)
        {
            $instance = new static;
            $instance->attributes = $results;
        }
        return $instance;
    }

}

?>
