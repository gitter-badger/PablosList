<?php
	require_once '../bootstrap.php';
	$dbc->exec('TRUNCATE users');
	$dbc->exec('TRUNCATE ads');
	$dbc->exec('TRUNCATE tags');

	$users = [
                [
                    'first_name' => 'Pablo',
                    'last_name' => 'King',
                    'email' => 'pablo@winning.com',
                    'password' => '$2y$10$/qmZ8IRNbltJykLCsUtFf.9zgA2qJL0sh5OJuHK7og/qSENAmzz1ephp',
                    'avatar_img' => 'img/pablo.jpg'
                ],
			    [
                    'first_name' => 'Justin',
                    'last_name' => 'Beere',
                    'email' => 'justin@codeup.rocks',
                    'password' => '$2y$10$/qmZ8IRNbltJykLCsUtFf.9zgA2qJL0sh5OJuHK7og/qSENAmzz1ephp',
                    'avatar_img' => 'img/pablo.jpg'
                ],
			    [
                  'first_name' => 'Meghan',
                  'last_name' => 'Ahrens',
                  'email' => 'meghan@codeup.rocks',
                  'password' => '$2y$10$/qmZ8IRNbltJykLCsUtFf.9zgA2qJL0sh5OJuHK7og/qSENAmzz1ephp',
                  'avatar_img' => 'img/pablo.jpg'
                ]
            ];

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

	$ads = [
                [
                    'title' => 'Autographed Mont Blanc by Pablo King',
                    'tags' => 'pen, autographed, historical item',
                    'img_url' => '/img/ducks/full_size.jpg',
                    'date_created' => '2015-08-12',
    				'price' => 9000.00,
                    'description' => 'Pen signed by Pablo King the world class business duck. Was used in business deals to stack those greenbills.',
                    'user_id' => 1
                ],
			    [
                    'title' => 'Original iPod Shuffle',
                    'tags' => 'Apple, iPod, MP3 player, used',
                    'img_url' => '/img/ducks/full_size.jpg',
                    'date_created' => '2015-08-12',
				    'price' => 64.99,
                    'description' => 'Slightly worn with occasional electric shortings caused by lingering sweat damage.',
                    'user_id' => 2
                ],
			    [
                    'title' => 'Rich, Sugar Duck seeking fun flirty female friend',
                    'tags' => 'non-platonic, risky-seeker, proverbial home-wrecker',
                    'img_url' => '/img/ducks/full_size.jpg',
                    'date_created' => '2015-08-12',
				    'price' => null,
                    'description' => 'Looking for a good time. Love to dance.',
                    'user_id' => 1
                ],
			    [
                    'title' => 'Fancy as Duck Socks',
                    'tags' => 'socks, fancy, fashion',
                    'img_url' => '/img/ducks/full_size.jpg',
                    'date_created' => '2015-08-12',
				    'price' => 49.99,
                    'description' => 'Cutest socks ever. You should buy them! :)',
                    'user_id' => 3
                ]
			];

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
