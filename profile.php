<?php
    require_once 'core/init.php';

    if(!$username = Input::get('user')) {
        Redirect::to('index.php');
    } else {
        $user = new User($username);
        if (!$user->exists()) {
            Redirect::to(404);
        } else {
            $data = $user->data();
        }
        ?>
        <div class="HomeNames">
            <h3>Welcome <?php echo escape($data->username); ?></h3>
            <p>Full Name: <?php echo escape($data->name); ?></p>
        </div>
        <?php
    }
?>

<html>
    <head>
        <title>Camagru</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
        <link href="https://fonts.googleapis.com/css?family=Bebas+Neue&display=swap" rel="stylesheet">
<style>
body {
  background-image: url(Assets/BubblesBackground.png);
  background-repeat: no-repeat;
  background-attachment: fixed;
  background-size: cover;
}
</style>
    </head>
        <body>

        </body>