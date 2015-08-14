<?php

require_once 'BaseModel.php';
class User extends Model {

    protected static $table = 'users';

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

    public function save()
    {
        // Ensure there are attributes before attempting to save
        if (isset($this->attributes)){

            if (isset($this->attributes['user_id'])){
            // Perform the proper action - if the `id` is set, this is an update, if not it is a insert
                $this->update();
            } else {
                $this->insert();
            }
        }
    }

    public function update()
    {
        $table = static::$table;
        // @TODO: Ensure that update is properly handled with the id key
        $query = "UPDATE $table SET
                    first_name = :first_name,
                    last_name = :last_name,
                    email = :email,
                    password = :password
                    WHERE user_id = :id";
        // @TODO: Use prepared statements to ensure data security
        $stmt = self::$dbc->prepare($query);
        $stmt->bindValue(':first_name', $this->first_name,  PDO::PARAM_STR);
        $stmt->bindValue(':last_name',  $this->last_name,   PDO::PARAM_STR);
        $stmt->bindValue(':email',      $this->email,       PDO::PARAM_STR);
        $stmt->bindValue(':password',   $this->password,    PDO::PARAM_STR);
        $stmt->bindValue(':id',         $this->id,          PDO::PARAM_INT);
        $stmt->execute();
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
