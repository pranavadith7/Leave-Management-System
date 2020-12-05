<?php
$db_host = getenv('db_host');
$dbname = getenv('db_name');
$db_username = getenv('db_username');
$db_password = getenv('db_password');
/*echo $db_password;
echo $db_host;
*/
$conn= mysqli_connect($db_host, $db_username, $db_password,$dbname);
if (!$conn) {
echo "Connection failed: " . mysqli_connect_error();
}
?>