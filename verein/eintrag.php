<?php // Example 26-11: messages.php
  require_once 'header.php';

  if (!$loggedin) die("</div></body></html>");

  if (isset($_GET['view'])) $view = sanitizeString($_GET['view']);
  else                      $view = $user;

  if (isset($_POST['name']))
  {
    $name     = sanitizeString($_POST['name']);
    $startzeit    = sanitizeString($_POST['startzeit']);
    $endzeit  = sanitizeString($_POST['endzeit']);
    $datum  = sanitizeString($_POST['datum']);
    $text = sanitizeString($_POST['text']);

    if ($name != "")
    {
      $pm   = substr(sanitizeString($_POST['pm']),0,1);
      $dauer = get_time_difference($startzeit, $endzeit);
      queryMysql("INSERT INTO zeiten (name, startzeit, endzeit, datum, email, dauer, text)
        VALUES('$name', '$startzeit', '$endzeit', '$datum', '$user', '$dauer', '$text')");
      $result = queryMysql("SELECT id FROM zeiten WHERE name='$name' AND datum='$datum' AND email='$user' AND startzeit='$startzeit'");
      $result -> data_seek(0);
      $id = $result -> fetch_assoc()[id];
      queryMysql("INSERT INTO zeituser (eventid, user, dauer) VALUES ('$id', '$user', '$dauer')");
      echo "Dein Eintrag war erfolgreich";
    }
  }

  if ($view != "")
  {
    if ($view == $user) $name1 = $name2 = "Deine";
    else
    {
      $name1 = "<a href='eintrag.php?view=$view'>$view</a>'s";
      $name2 = "$view's";
    }

    echo "<h3>$name1 Einträge</h3>";
    //showProfile($view);

    /*<input type='radio' name='pm' id='public' value='0' checked='checked'>
    <label for="public">Public</label>
    <input type='radio' name='pm' id='private' value='1'>
    <label for="private">Private</label>*/

    echo <<<_END
      <form method='post' action='eintrag.php?view=$view'>
        <fieldset data-role="controlgroup" data-type="horizontal">
          <legend>Mach hier bitte deinen Eintrag</legend>

        </fieldset>

        <legend>Notwendige Eingaben</legend>

        <div data-role='fieldcontain'>
          <label>Name</label>
          <input type='text' maxlength='64' name='name' value='$name'>
        </div>

        <div data-role='fieldcontain'>
          <label>datum</label>
          <input type='date' name="datum" value='$datum'>
        </div>

        <div data-role='fieldcontain'>
          <label>Startzeit</label>
          <input type='time' name="startzeit" value='$startzeit'>
        </div>

        <div data-role='fieldcontain'>
          <label>Endzeit</label>
          <input type='time' name="endzeit" value='$endzeit'>
        </div>

        <legend>zusätzliche Infos</legend>
        <textarea name='text'></textarea>
          <input data-transition='slide' type='submit' value='Eintrag senden'>
      </form><br>
_END;

    date_default_timezone_set('UTC');

    /*if (isset($_GET['erase']))
    {
      $erase = sanitizeString($_GET['erase']);
      queryMysql("DELETE FROM messages WHERE id=$erase AND recip='$user'");
    }

    $query  = "SELECT * FROM messages WHERE recip='$view' ORDER BY time DESC";
    $result = queryMysql($query);
    $num    = $result->num_rows;

    for ($j = 0 ; $j < $num ; ++$j)
    {
      $row = $result->fetch_array(MYSQLI_ASSOC);

      if ($row['pm'] == 0 || $row['auth'] == $user || $row['recip'] == $user)
      {
        echo date('M jS \'y g:ia:', $row['time']);
        echo " <a href='messages.php?view=" . $row['auth'] .
             "'>" . $row['auth']. "</a> ";

        if ($row['pm'] == 0)
          echo "wrote: &quot;" . $row['message'] . "&quot; ";
        else
          echo "whispered: <span class='whisper'>&quot;" .
            $row['message']. "&quot;</span> ";

        if ($row['recip'] == $user)
          echo "[<a href='messages.php?view=$view" .
               "&erase=" . $row['id'] . "'>erase</a>]";

        echo "<br>";
      }
    }*/
  }

  /*if (!$num)
    echo "<br><span class='info'>No messages yet</span><br><br>";

  echo "<br><a data-role='button'
        href='messages.php?view=$view'>Refresh messages</a>";*/
?>

    </div><br>
  </body>
</html>
