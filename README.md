# MysqliDB

A class to use a Mysqli class.

The class constructor:

$mysqliDB = new MyslqiDB("query", "format", "parameters");

Example:

$user_name = "Jorge";</br>
$query = "SELECT * FROM USER WHERE NAME = ?";
$format = 's';
$parameters = array($user_name);

$mysliDB = new MysqliDB($query, $format, $parameters);
$res = $mysqliDB->ejecutar();
