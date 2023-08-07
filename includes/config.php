<?php 
// DB credentials.
define('DB_HOST','localhost');
define('DB_USER','tim');
define('DB_PASS','Xj3W3WLgQeQxOp6');
define('DB_NAME2','tim');
// Establish database connection.
try
{
    $dbh1 = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME2,DB_USER, DB_PASS,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
}
catch (PDOException $e)
{
    exit("Error: " . $e->getMessage());
}
?>

