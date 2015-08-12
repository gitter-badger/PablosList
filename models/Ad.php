<?php
	require_once 'BaseModel.php';
	// $new_ad = new Ad();
	// $new_ad->tags         = Input::get('tags');
	// $new_ad->title        = Input::get('title');
	// $new_ad->price        = (float)Input::get('price');
	// $new_ad->img_url      = $filename;
	// $new_ad->description  = Input::get('description');
	// $new_ad->date_created = date('Y-m-d');
	// $new_ad->user_id      = (int)$_SESSION['user_id'];
	// $new_ad->save();
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
		public $date_created;

		public function create()
		{
			$stmt = $dbc->prepare('INSERT INTO ads (user_id, title, price,  img_url, tags, date_created, description)
								   VALUES (:user_id, :title, :price, :img_url, :tags, :date_created, :description)');


				$stmt->bindValue(':user_id', $this->user_id, PDO::PARAM_STR);
				$stmt->bindValue(':title', $this->title, PDO::PARAM_STR);
				$stmt->bindValue(':price', $this->price, PDO::PARAM_INT);
				$stmt->bindValue(':img_url', $this->img_url, PDO::PARAM_STR);
				$stmt->bindValue(':tags', $this->date_created, PDO::PARAM_STR);				
				$stmt->bindValue(':date_created', $this->date_created, PDO::PARAM_STR);
			} catch (Exception $e) {
				$errors[]= $e->getMessage();
			}
			try {

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
