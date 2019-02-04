<?php // Example 26-1: functions.php
  $dbhost  = 'localhost';    // Unlikely to require changing
  $dbname  = 'verein';   // Modify these...
  $dbuser  = 'admin';   // ...variables according
  $dbpass  = 'Hooghuis';   // ...to your installation

  $connection = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
  if ($connection->connect_error) die("Fatal Error");

  function createTable($name, $query)
  {
    queryMysql("CREATE TABLE IF NOT EXISTS $name($query)");
    echo "Table '$name' created or already exists.<br>";
  }

  function get_time_difference($start_time_o, $end_time_o){
      $start_time = explode(":", $start_time_o);
      $end_time = explode(":", $end_time_o);

      $start_time_stamp = mktime($start_time[0], $start_time[1], 0, 0, 0, 0);
      $end_time_stamp = mktime($end_time[0], $end_time[1], 0, 0, 0, 0);

      $time_difference = $end_time_stamp - $start_time_stamp;

      return gmdate("H:i", $time_difference);
  }

  function queryMysql($query)
  {
    global $connection;
    $result = $connection->query($query);
    if (!$result) die("Fatal Error");
    return $result;
  }

  function destroySession()
  {
    $_SESSION=array();

    if (session_id() != "" || isset($_COOKIE[session_name()]))
      setcookie(session_name(), '', time()-2592000, '/');

    session_destroy();
  }

  function sanitizeString($var)
  {
    global $connection;
    $var = strip_tags($var);
    $var = htmlentities($var);
    if (get_magic_quotes_gpc())
      $var = stripslashes($var);
    return $connection->real_escape_string($var);
  }

  function showProfile($user)
  {
    if (file_exists("$user.jpg"))
      echo "<img src='$user.jpg' style='float:left;'>";

    $result = queryMysql("SELECT * FROM profiles WHERE user='$user'");

    if ($result->num_rows)
    {
      $row = $result->fetch_array(MYSQLI_ASSOC);
      echo stripslashes($row['text']) . "<br style='clear:left;'><br>";
    }
    else echo "<p>Hier wurde noch nichts eingetragen</p><br>";
  }
?>
