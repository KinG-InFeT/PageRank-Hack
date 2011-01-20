<?php

if (preg_match("/config.php/", $_SERVER['PHP_SELF'])) die(htmlspecialchars($_SERVER['PHP_SELF']));

/*
CREATE TABLE page_rank_hack (
	id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	title_site TEXT NOT NULL,
	site TEXT NOT NULL,
	admin_site TEXT NOT NULL,
	num_click INT NOT NULL
) ENGINE = MYISAM;
*/

$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "pagerank";

$admin_password = md5("admin");
?>
