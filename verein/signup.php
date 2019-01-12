<?php // Example 26-5: signup.php
  require_once 'header.php';

echo <<<_END
  <script>
    function checkUser(user)
    {
      if (user.value == '')
      {
        $('#used').html('&nbsp;')
        return
      }

      $.post
      (
        'checkuser.php',
        { user : user.value },
        function(data)
        {
          $('#used').html(data)
        }
      )
    }
  </script>
_END;

  $error = $user = $pass = "";
  if (isset($_SESSION['user'])) destroySession();

  if (isset($_POST['user']))
  {
    $user     = sanitizeString($_POST['user']);
    $pass     = sanitizeString($_POST['pass']);
    $name     = sanitizeString($_POST['name']);
    $vorname  = sanitizeString($_POST['vorname']);
    $strasse  = sanitizeString($_POST['strasse']);
    $plz      = sanitizeString($_POST['plz']);
    $stadt    = sanitizeString($_POST['stadt']);
    $tel      = sanitizeString($_POST['tel']);
    $info     = sanitizeString($_POST['info']);

    if ($user == "" || $pass == "")
      $error = 'Not all fields were entered<br><br>';
    else
    {
      $result = queryMysql("SELECT * FROM members WHERE user='$user'");

      if ($result->num_rows)
        $error = 'That username already exists<br><br>';
      else
      {
        queryMysql("INSERT INTO memdata (name, vorname, strasse, plz, stadt, tel, email, info)
                    VALUES ('$name', '$vorname', '$strasse', '$plz', '$stadt', '$tel', '$user', '$info')");
        queryMysql("INSERT INTO members VALUES('$user', '$pass')");
        die('<h4>Account created</h4>Please Log in.</div></body></html>');
      }
    }
  }

echo <<<_END
      <form method='post' action='signup.php'>$error
      <div data-role='fieldcontain'>
        <label></label>
        Bitte tragen Sie ihre Daten ein
      </div>

      <div data-role='fieldcontain'>
        <label>E-Mail</label>
        <input type='text' maxlength='64' name='user' value='$user'
          onBlur='checkUser(this)'>
        <label></label><div id='used'>&nbsp;</div>
      </div>

      <div data-role='fieldcontain'>
        <label>Passwort</label>
        <input type='password' maxlength='255' name='pass' value='$pass'>
      </div>
      </br>
      <div data-role='fieldcontain'>
        <label>Name</label>
        <input type='text' maxlength='64' name='name' value='$name'>
      </div>

      <div data-role='fieldcontain'>
        <label>Vorname</label>
        <input type='text' maxlength='64' name='vorname' value='$vorname'>
      </div>

      <div data-role='fieldcontain'>
        <label>Stra&szlig;e</label>
        <input type='text' maxlength='64' name='strasse' value='$strasse'>
      </div>

      <div data-role='fieldcontain'>
        <label>PLZ</label>
        <input type='text' maxlength='64' name='plz' value='$plz'>
      </div>

      <div data-role='fieldcontain'>
        <label>Stadt</label>
        <input type='text' maxlength='64' name='stadt' value='$stadt'>
      </div>

      <div data-role='fieldcontain'>
        <label>Telefon</label>
        <input type='text' maxlength='64' name='tel' value='$tel'>
      </div>

      <div data-role='fieldcontain'>
        <label>Info</label>
        <input type='text' maxlength='4096' name='info' value='$info'
            placeholder='Bitte tragen Sie hier ein wo Sie politisch aktiv waren/sind'>
      </div>

      <div data-role='fieldcontain'>
        <label></label>
        <input data-transition='slide' type='submit' value='Sign Up'>
      </div>
    </div>
  </body>
</html>
_END;
?>
