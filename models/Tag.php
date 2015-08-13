<?php
require_once 'BaseModel.php';

class Tag extends Model
{
	protected static $table = 'tags';
	protected static $id    = 'tag_id';

	public function insert()
	{
		$stmt = self::$dbc->prepare('INSERT INTO tags (tag_name, ad_id)
							   VALUES (:tag_name, :ad_id)');

		$stmt->bindValue(':tag_name', $this->tag_name, PDO::PARAM_STR);
		$stmt->bindValue(':ad_id', $this->ad_id, PDO::PARAM_INT);

		$stmt->execute();

	}

}
?>
