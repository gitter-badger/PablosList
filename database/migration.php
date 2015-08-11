<?php
require_once '../bootstrap.php';

$dropTags  = "DROP TABLE IF EXISTS tags;";
$dbc->exec($dropTags);

$dropAds   = "DROP TABLE IF EXISTS ads;";
$dbc->exec($dropAds);

$dropUsers = "DROP TABLE IF EXISTS users;";
$dbc->exec($dropUsers);

$usersMigration =
    'CREATE TABLE users (
	 user_id    INT UNSIGNED NOT NULL AUTO_INCREMENT,
	 first_name VARCHAR(100) NOT NULL,
	 last_name  VARCHAR(100) NOT NULL,
	 email	    VARCHAR(100) NOT NULL,
	 password   VARCHAR(100) NOT NULL,
     avatar_img VARCHAR(100) DEFAULT NULL,
	 UNIQUE KEY email (email),
	 PRIMARY KEY (user_id))';

$dbc->exec($usersMigration);

$adsMigration =
    'CREATE TABLE ads (
	 ad_id    	  INT UNSIGNED NOT NULL AUTO_INCREMENT,
	 user_id	  INT UNSIGNED NOT NULL,
	 title 		  VARCHAR(100) NOT NULL,
	 price 		  FLOAT(15,2),
	 img_url   	  VARCHAR(100),
	 tags 		  VARCHAR(1000),
	 date_created DATE		   NOT NULL,
	 description  VARCHAR(1000),
	 PRIMARY KEY (ad_id),
	 KEY user_id (user_id),
	 CONSTRAINT ads_ibfk_1 FOREIGN KEY (user_id) REFERENCES users (user_id) ON DELETE CASCADE
     )';

$dbc->exec($adsMigration);

$tagsMigration =
	'CREATE TABLE tags (
	 tag_id   INT UNSIGNED NOT NULL AUTO_INCREMENT,
	 tag_name VARCHAR(50)  NOT NULL,
	 ad_id    INT UNSIGNED NOT NULL,
	 PRIMARY KEY (tag_id),
	 KEY ad_id 	 (ad_id),
	 CONSTRAINT tags_ibfk_1 FOREIGN KEY (ad_id) REFERENCES ads (ad_id) ON DELETE CASCADE
     )';

$dbc->exec($tagsMigration);
?>
