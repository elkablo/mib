<?
if ($index->mib!="mib") die ("Access denied");
$db_server="localhost";
$db_user="user";
$db_password="pass";
$db_name="dbname";
$spojenie=mysql_pconnect($db_server,$db_user,$db_password);
mysql_select_db($db_name,$spojenie);
?>