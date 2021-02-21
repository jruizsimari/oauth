<?php require('config.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mon site</title>
</head>
<body>
  <h1>Se connecter</h1>
  <!-- add these three lines in config.php in the root document -->

  <!-- define('GOOGLE_ID', 'google_client_id');
       define('GOOGLE_SECRET', 'google_secret_key');
       define('PAGE_CONNECT', 'http://localhost:port/connect.php'); -->

  <a href="https://accounts.google.com/o/oauth2/v2/auth?scope=email&access_type=online&response_type=code&redirect_uri=<?= urlencode('http://localhost:5555/connect.php');?>&client_id=<?= GOOGLE_ID ?>">Se connecter via google</a>
</body>
</html>