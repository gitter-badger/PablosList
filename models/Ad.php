<?php
	require_once 'BaseModel.php';

	class Ad extends Model
	{
		protected static $table = 'ads';
		protected static $id    = 'ad_id';


		public function insert()
		{
			$stmt = self::$dbc->prepare('INSERT INTO ads (user_id, title, price,  img_url, tags, date_created, description)
								   VALUES (:user_id, :title, :price, :img_url, :tags, :date_created, :description)');

			$stmt->bindValue(':user_id', $this->user_id, PDO::PARAM_INT);
			$stmt->bindValue(':title', $this->title, PDO::PARAM_STR);
			$stmt->bindValue(':price', $this->price, PDO::PARAM_INT);
			$stmt->bindValue(':img_url', $this->img_url, PDO::PARAM_STR);
			$stmt->bindValue(':tags', $this->tags, PDO::PARAM_STR);
			$stmt->bindValue(':date_created', $this->date_created, PDO::PARAM_STR);
			$stmt->bindValue(':description', $this->description, PDO::PARAM_STR);

	        $stmt->execute();

		}
		public static function allByUser($user_id)
		{
			parent::dbConnect();

			$query = "SELECT * FROM ads WHERE user_id = :user_id";

			$stmt = parent::$dbc->prepare($query);
			$stmt->bindValue(':user_id', (int)$user_id, PDO::PARAM_INT);
			$stmt->execute();

			$ads = $stmt->fetchAll(PDO::FETCH_ASSOC);

			return $ads;
		}

		public static function lastEntry($user_id)
		{
			parent::dbConnect();

			$query = "SELECT ad_id FROM ads WHERE user_id = $user_id ORDER BY ad_id DESC LIMIT 1;";

			$results = parent::$dbc->query($query)->fetch(PDO::FETCH_ASSOC);
			$ad_id = (int)$results['ad_id'];

			return $ad_id;
		}

		public static function find($id)
	    {
	        // Get connection to the database
	        parent::dbConnect();

	        // @TODO: Create select statement using prepared statements
	        $stmt = parent::$dbc->prepare('SELECT * FROM ads WHERE ad_id = :id');

	        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
	        $stmt->execute();
	        // @TODO: Store the resultset in a variable named $result
	        $results = $stmt->fetch(PDO::FETCH_ASSOC);
	        // The following code will set the attributes on the calling object based on the result variable's contents

	        $instance = null;
	        if ($results)
	        {
	            $instance = $results;
	            // $instance->attributes = $results;
	        }
	        return $instance;
	    }

	}
?>
