<?php
    require_once 'core/init.php';

    $user = new User();

    if(!$user->isLoggedIn()) {
        Redirect::to('index.php');
    }

    if(Input::exists()) {
        if(Token::check(Input::get('token'))) {
            
            $validate = new Validate();
            $validation = $validate->check($_POST, array(
                'password_current' => array(
                    'required' => true
                ),
                'password_new' => array(
                    'required' => true,
                    'min' => 6
                ),
                'password_new_again' => array(
                    'required' => true,
                    'min' => 6,
                    'matches' => 'password_new'
                )
            ));

            if($validation->passed()) {
                
                if(Hash::make(Input::get('password_current'), $user->data()->salt) !== $user->data()->password) {
                    echo 'Your current password is incorrect.';
                } else {
                    $salt = Hash::salt(32);
                    $user->update(array(
                        'password' => Hash::make(Input::get('password_new'), $salt),
                        'salt' => $salt
                    ));

                    Session::flash('home', 'Your password has been changed');
                    Redirect::to('index.php');
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
            <link rel="stylesheet" href="./style.css">
    </head>
        <body>
            <div class="logo-header-container">
                <div class="logo"></div>
                <div class="Header">
                    <h1>Change Password</h1>
                </div>
            </div>
            <div class="login-page">
                <div class="form">
                    <form class="register-form" action="" method="post">
                        <input type="password"  placeholder="Current Password" name="password_current" id="password_current">
                        <input type="password"  placeholder="New Password" name="password_new" id="password_new" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$" oninput="setCustomValidity('')" oninvalid="setCustomValidity('Invalid Password - Password needs to be 8 minimum characters, minimum 1 special character, 1 Capital letter and 1 number')" autocomplete="off">
                        <input type="password"  placeholder="Re-enter password" name="password_new_again" id="password_new_again">
                        <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
                        <button value="update">Update</button>
                        <p class="message">Happy with password? <a href="login.php">Login</a> </p>
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
