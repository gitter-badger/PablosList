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

    public function insert()
    {
        $stmt = self::$dbc->prepare('INSERT INTO users (first_name, last_name, email,  password, avatar_img)
                               VALUES (:first_name, :last_name, :email, :password, :avatar_img)');

        $stmt->bindValue(':first_name', $this->first_name, PDO::PARAM_STR);
        $stmt->bindValue(':last_name', $this->last_name, PDO::PARAM_STR);
        $stmt->bindValue(':email', $this->email, PDO::PARAM_STR);
        $stmt->bindValue(':password', $this->password, PDO::PARAM_STR);
        $stmt->bindValue(':avatar_img', 'img/pablo.jpg', PDO::PARAM_STR);

        return $stmt->execute();
    }
    

    public function checkEmail($email) {
        $query = 'SELECT email FROM users WHERE email = :email;';
        $stmt  = self::$dbc->prepare($query);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        return $results = $stmt->fetch(PDO::FETCH_ASSOC);
    }

}

?>
