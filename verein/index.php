<?php // Example 26-4: index.php
  session_start();
  require_once 'header.php';

  echo "<div class='center'>Willkommen bei den Patrioten,";

  if ($loggedin) echo " $user, du bist nun eingeloggt";
  else           echo ' bitte logge dich ein oder melde dich an';

  echo <<<_END
      </div><br>
    </div>
    <div data-role="footer">
      <h4></h4>
    </div>
  </body>
</html>
_END;
?>
