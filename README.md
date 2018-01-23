# MysqliDB

A class to use a Mysqli class.

The class constructor:

$mysqliDB = new MyslqiDB("query", "format", "parameters");

Example:

$user_name = "Jorge"; </br>
$query = "SELECT * FROM USER WHERE NAME = ?"; </br>
$format = 's'; </br>
$parameters = array($user_name); </br>

$mysliDB = new MysqliDB($query, $format, $parameters); </br>
$res = $mysqliDB->ejecutar();
