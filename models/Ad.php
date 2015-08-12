<?php
	require_once 'BaseModel.php';
	$new_ad = new Ad();
	$new_ad->tags         = Input::get('tags');
	$new_ad->title        = Input::get('title');
	$new_ad->price        = (float)Input::get('price');
	$new_ad->img_url      = $filename;
	$new_ad->description  = Input::get('description');
	$new_ad->date_created = date('Y-m-d');
	$new_ad->user_id      = (int)$_SESSION['user_id'];
	$new_ad->save();
	class Ad extends Model
	{
		protected static $table = 'ads';
		protected static $id    = 'ad_id';
		public $tags;
		public $title;
		public $price;
		public $img_url;
		public $description;
		public $user_id;

		public function create()
		{
			$stmt = $dbc->prepare('INSERT INTO ads (user_id, title, price,  img_url, tags, date_created, description)
								   VALUES (:user_id, :title, :price, :img_url, :tags, :date_created, :description)');

			try {
				$stmt->bindValue(':user_id', (int)$_SESSION['user_id'], PDO::PARAM_STR);
			} catch (Exception $e) {
				$errors[]= $e->getMessage();
			}
			try {
				$stmt->bindValue(':title', Input::getString('title', 5, 60), PDO::PARAM_STR);
			} catch (Exception $e) {
				$errors[]= $e->getMessage();
			}
			try {
				$stmt->bindValue(':date_established', Input::getDate('date'), PDO::PARAM_STR);
			} catch (Exception $e) {
				$errors[]= $e->getMessage();
			}
			try {
				$stmt->bindValue(':area_in_acres', Input::getNumber('area'), PDO::PARAM_INT);
			} catch (Exception $e) {
				$errors[]= $e->getMessage();
			}
			try {
				$stmt->bindValue(':description', Input::getString('description'), PDO::PARAM_STR);

			} catch (Exception $e) {
				$errors[]= $e->getMessage();
			}
			if (empty($errors)) {

		        $stmt->execute();
		        unset($_POST);
		    }
		}
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
