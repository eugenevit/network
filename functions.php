<?php //functions.php

// определяем переменные для базы данных
$dbhost = 'localhost';
$dbname = 'web'; // database name

$dbuser = 'root';
$dbpass = 'difficultpass';
$appname = "Web";

// подключение к БД
mysql_connect($dbhost, $dbuser, $dbpass) or die (mysql_error());
mysql_select_db($dbname) or die (mysql_error());

function createTable($name, $query)
{
	queryMysql("CREATE TABLE IF NOT EXISTS $name($query)");
	echo "Таблица '$name' создана или уже существовала<br />";
}

function queryMysql($query)
{
	$result = mysql_query($query) or die (mysql_error());
	return $result;
}

// выходим из сессии
function destroySession()
{
	$_SESSION=array();

	if(session_id() != "" || isset($_COOKIE[session_name()]))
		setcookie(session_name(), '', time()-2592000, '/');

	session_destroy();
}

// функция безопасности
function sanitizeString($var)
{
	$var = strip_tags($var);
	$var = htmlentities($var);
	$var = stripslashes($var);
	return mysql_real_escape_string($var);
}

// ф-ия отобр фото профиля пользователя
function showProfile($user)
{
	if (file_exists("$user.jpg"))
		echo "<img src = '$user.jpg'> align='left' />";
		
	$result = queryMysql("SELECT * FROM profiles WHERE user = '$user'");

	if (mysql_num_rows($result))
	{
		$row = mysql_fetch_row($result);
		echo stripsplashes ($row[1]) . "<br clear=left /><br />";
	}
}
?>