<!DOCTYPE html>
<html>
  <head>
    <title>Setting up database</title>
  </head>
  <body>

    <h3>Setting up...</h3>

<?php // Example 26-3: setup.php
  require_once 'functions.php';

  createTable('members',
              'user VARCHAR(64),
              pass VARCHAR(255)');

  createTable('memdata',
              'id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
              name VARCHAR(64),
              vorname VARCHAR(64),
              strasse VARCHAR(64),
              plz INT(5),
              stadt VARCHAR(32),
              tel VARCHAR(32),
              email VARCHAR(64),
              info VARCHAR(4096),
              created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP');

              createTable('messages',
                          'id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                          auth VARCHAR(16),
                          recip VARCHAR(16),
                          pm CHAR(1),
                          time INT UNSIGNED,
                          message VARCHAR(4096),
                          INDEX(auth(6)),
                          INDEX(recip(6))');

              createTable('friends',
                          'user VARCHAR(16),
                          friend VARCHAR(16),
                          INDEX(user(6)),
                          INDEX(friend(6))');

              createTable('profiles',
                          'user VARCHAR(16),
                          text VARCHAR(4096),
                          INDEX(user(6))');

?>

    <br>...done.
  </body>
</html>
