<?php
echo <<<_END
<form action="eintrag.php" method="post"><pre>
        Name <input type="text" name="name">
     Vorname <input type="text" name="vorname">

 Stra&szlig;e, Nr. <input type="text" name="strasse">
         PLZ <input type="text" name="plz">
       Stadt <input type="text" name="stadt">

     Telefon <input type="text" name="tel">
      E-mail <input type="text" name="email">

           Info zu meinen politischen Aktivit&auml;ten
           <textarea id="text" name="info" cols="35" rows="4"></textarea>
           <input type='hidden' name='eintrag' value='yes'>
           <input type="submit" value="Eintragen">
</pre></form>
<form action="textarea.html" method="post">
   <div>
      <label for="text">Anmerkung</label>
         <textarea id="text" name="text" cols="35" rows="4"></textarea> 	
      <input type="submit" value="Senden" />
   </div>
</form>

_END;
?>
