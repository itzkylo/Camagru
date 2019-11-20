<?php
require_once 'core/init.php';

if(Input::exists()) {
    if(Token::check(Input::get('token'))) {
        $validate = new Validate();
        $validation = $validate->check($_POST, array(
            'username' => array('required' => true),
            'password' => array('required' => true)
        ));

        if($validation->passed()) {
            $user = new User();
            $login = $user->login(Input::get('username'), Input::get('password'));

            if($login) {
                Redirect::to('index.php');
            } else {
                echo '<p>Sorry, login failed.</p>';
            }

        } else {
            foreach($validation->errors() as $error) {
                echo $error, '<br>';
            }
        }

    }
}

?>

<html>
    <head>
        <title>Camagru</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="style.css">
    </head>
        <body>
            <div class="logo-header-container">
                <div class="logo"></div>
                <div class="Header">
                <h1>Welcome to Camagru</h1>
                </div>
            </div>
            <div class="login-page">
                <div class="form">
                    <form class="login-form" action="" method="post">
                        <input type="text"  placeholder="Username" name="username" id="username" autocomplete="off"/>
                        <input type="password"  placeholder="Password" name="password" id="password" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$" oninput="setCustomValidity('')" oninvalid="setCustomValidity('Invalid Password - Password needs to be 8 minimum characters, minimum 1 special character, 1 Capital letter and 1 number')" autocomplete="off">/>
                        <input type="hidden" name="token" value="<?php echo Token::generate(); ?>"/>
                        <button value="Login">Login</button>
                        <p class="message">Not Registered? <a href="register.php">Register</a></p>
                    </form>
                </div>
            </div>
            <div class="area" >
                    <ul class="circles">
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                    </ul>
            </div >
        </body>
</html>
