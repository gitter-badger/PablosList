<?php
	require_once '../bootstrap.php';
	$dbc->exec('TRUNCATE ads');
	$dbc->exec('TRUNCATE tags');
	$dbc->exec('TRUNCATE users');

	$users = [['first_name' => 'Pablo',    'last_name' => 'Pinero',   'email' => 'pablo@email.com',  		   'password' => 'pablops', 		 'phone' => '12101234567', 'bio' => 'I write... a lot.'],
			  ['first_name' => 'Keenan',   'last_name' => 'Treat',    'email' => 'keenan@email.com', 		   'password' => 'elchongo', 		 'phone' => '12101234567', 'bio' => 'I\'ve a daddy.'],
			  ['first_name' => 'Willy',    'last_name' => 'B',        'email' => 'willyb@me.com', 			   'password' => 'shinebright', 	 'phone' => '12101234567', 'bio' => ''],
			  ['first_name' => 'Barry',    'last_name' => 'O', 		  'email' => 'bigOnotation@whitehouse.gov','password' => 'phoeneticboehner', 'phone' => '12101234567', 'bio' => 'History shall remember my name'],
			  ['first_name' => 'Susan',    'last_name' => 'Sarandon', 'email' => 'ss@email.com', 			   'password' => 'goodluckguessing', 'phone' => '12101234567', 'bio' => 'Like you don\'t know me already.'],
			  ['first_name' => 'Goodluck', 'last_name' => 'Jonathan', 'email' => 'goodluckjohnny@nigeria.gov', 'password' => 'buhari', 		   	 'phone' => '12101234567', 'bio' => 'Wiki me.']];
	print_r($users);


	foreach($users as $user)
	{
		$stmt = $dbc->prepare('INSERT INTO users (first_name, last_name, email, password, phone, bio)
				    		   VALUES 			 (:first_name, :last_name, :email, :password, :phone, :bio);');
		$stmt->bindValue(':first_name', $user['first_name'], PDO::PARAM_STR);
		$stmt->bindValue(':last_name',  $user['last_name'],  PDO::PARAM_STR);
		$stmt->bindValue(':email',		$user['email'],		 PDO::PARAM_STR);
		$stmt->bindValue(':password',   $user['password'],   PDO::PARAM_STR);
		$stmt->bindValue(':phone', 		$user['phone'],		 PDO::PARAM_STR);
		$stmt->bindValue(':bio',		$user['bio'],		 PDO::PARAM_STR);
		$stmt->execute();
	}

	$ads = [['title' => 'Autographed Mont Blanc fountain pen',   'tags' => 'pen, autographed, historical item',	 'img_url' => '#', 'date_created' => '2015-04-18',
				 'price' => 350.00, 'description' => 'Pen signed by Thomas Treat Paine. Was purportedly used to lobotomized many pygmies.', 'user_id' => 1],
			['title' => 'Original iPod Shuffle', 			     'tags' => 'Apple, iPod, MP3 player, used',	   	 'img_url' => '#', 'date_created' => '2015-04-18',
				 'price' => 64.99,  'description' => 'Slightly worn with occasional electric shortings caused by lingering sweat damage.', 'user_id' => 2],
			['title' => 'Fun, flirty minor seeking sugar daddy', 'tags' => 'non-platonic, risky-seeker, proverbial home-wrecker', 'img_url' => '#', 'date_created' => '2015-04-18',
				 'price' => null, 'description' => 'Looking for a good time. Love to dance.', 'user_id' => 3],
			['title' => 'Political influence', 					 'tags' => 'geopolitics, realpolitik, vested interests, used','img_url' => '#', 'date_created' => '2015-04-18',
				 'price' => 99999.99 , 'description' => 'Need to buy political influence to alter the course of the history?', 'user_id' => 4],
			['title' => 'Television Set',						 'tags' => 'tech, entertainment system, self-loathing','img_url' => '#', 'date_created' => '2015-04-18',
				 'price' => 0.25 , 'description' => 'Selling my old TV set. Enjoy.', 'user_id' => 4]];

	foreach($ads as $ad)
	{
		$stmt = $dbc->prepare('INSERT INTO ads (title, tags, img_url, price, description, date_created, user_id)
							   VALUES 		   (:title, :tags, :img_url, :price, :description, cast(:date_created as DATE), :user_id);');

		$stmt->bindValue(':title', 	 	  $ad['title'],        PDO::PARAM_STR);
		$stmt->bindValue(':tags',  	 	  $ad['tags'],  	   PDO::PARAM_STR);
		$stmt->bindValue(':img_url', 	  $ad['img_url'], 	   PDO::PARAM_STR);
		$stmt->bindValue(':price', 	 	  $ad['price'], 	   PDO::PARAM_STR);
		$stmt->bindValue(':date_created', $ad['date_created'], PDO::PARAM_STR);
		$stmt->bindValue(':description',  $ad['description'],  PDO::PARAM_STR);
		$stmt->bindValue(':user_id', 	  $ad['user_id'], 	   PDO::PARAM_INT);
		$stmt->execute();
	}

	$tagsQuery = 'SELECT ad_id, tags FROM ads';
	$results = $dbc->query($tagsQuery)->fetchAll(PDO::FETCH_ASSOC);
	print_r($results);

	foreach($results as $result)
	{
		$tags = explode(',', $result['tags']);


		foreach($tags as $tag)
		{
			$tag = trim($tag);
			$stmt = $dbc->prepare('INSERT INTO tags (tag_name, ad_id)
								   VALUES 			(:tag_name, :ad_id);');

			$stmt->bindValue(':tag_name', $tag,				PDO::PARAM_STR);
			$stmt->bindValue(':ad_id',    $result['ad_id'], PDO::PARAM_INT);
			$stmt->execute();

		}
	}


?>
