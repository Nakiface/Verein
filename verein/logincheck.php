<?php // Example 26-7: login.php
$dbhost  = 'localhost';    // Unlikely to require changing
$dbname  = 'verein';   // Modify these...
$dbuser  = 'admin';   // ...variables according
$dbpass  = 'Hooghuis';   // ...to your installation

$connection = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

$query = "SELECT pass FROM members WHERE user='test3'";
$result = $connection->query($query);
$query = "SELECT * FROM memdata WHERE email='test3'";
$result2 = $connection->query($query);
$result->data_seek(0);
//echo $result->fetch_assoc()[pass];
$hash =  $result->fetch_assoc()[pass];
echo $hash;
$password = 'test3';
if (password_verify($password, $hash))
{
  echo "hat geklappt";
}
$result2->data_seek(0);
$name = $result2->fetch_assoc()[stadt];
$result2->data_seek(0);
$vorname = $result2->fetch_assoc()[name];
echo $vorname, $name;
?>
