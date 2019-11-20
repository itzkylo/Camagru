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
            'name' => array(
                'required' => true,
                'min' => 2,
                'max' => 25
            ),
            'username' => array(
                'required' => true,
                'min' => 2,
                'max' => 20,
                'unique' => 'users'
            ),
            'password' => array(
                'required' => true,
                'min' => 6
            ),
            'password_again' => array(
                'required' => true,
                'matches' => 'password'
            ),
            'email' => array(
                'required' => true,
                'min' => 2,
                'max' => 50
            ),
        ));

        if($validation->passed()) {

            try {
                $user->update(array(
                    'name' => Input::get('name'),
                    'username' => Input::get('username'),
                    'email' => Input::get('email')
                ));

                Session::flash('home', 'Your details have been updated!');
                Redirect::to('index.php'); 

            } catch(Exception $e) {
                die($e->getMessage());
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
                <h1>Update your profile</h1>
                </div>
            </div>
            <div class="login-page">
                <div class="form">
                    <form class="register-form" action="" method="post">
                        <input type="text"  placeholder="Name & Surname" name="name" id="name" value="<?php echo escape($user->data()->name); ?>" autocomplete="off"/>
                        <input type="text"  placeholder="Username" name="username" id="username" value="<?php echo escape($user->data()->username); ?>" autocomplete="off"/>
                        <input type="text"  placeholder="Email" name="email" id="email" value="<?php echo escape($user->data()->email); ?>"/>
                        <input type="hidden" name="token" value="<?php echo Token::generate(); ?>"/>
                        <button value="Update">Update</button>
                        <p class="message">Change Password? <a href="changepassword.php">Click Here</a></p>
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
