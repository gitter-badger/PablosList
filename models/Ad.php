<?php
	require_once 'BaseModel.php';

	class Ad extends Model
	{
		protected static $table = 'ads';
		protected static $id    = 'ad_id';


		public static function allByUser($user_id)
		{
			parent::dbConnect();

			$query = "SELECT * FROM " . self::$table . " WHERE user_id = :user_id";

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

	}
?>
