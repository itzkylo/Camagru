<?php
require_once 'config/setup.php';
require_once 'core/init.php';

if(Session::exists('home')) {
    echo '<p>' . Session::flash('home') . '</p>';
}

$user = new User();
if($user->isLoggedIn()) {
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
    <div id="info" class="info">
        <p>Welcome<br><a href="profile.php?user=<?php echo escape($user->data()->username); ?>"><?php echo escape($user->data()->username); ?></a></p>

        <div class="box">
            <ul>
                <li><a href="logout.php">Log out</a></li>
                <li><a href="update.php">Update Profile</a></li>
            </ul>
        </div>
    </div>
<?php
} else {
    echo '<p>You need to <a href="login.php">log in</a> or <a href="register.php">register</a></p>';
}
