<?php
    require_once 'core/init.php';

    if(Input::exists()) {
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
            echo 'passed';
        }else {
            foreach($validation->errors() as $error) {
                echo $error, '<br>';
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
                    <form class="register-form" action="" method="post">
                        <input type="text"  placeholder="Name & Surname" name="name" id="name" value="<?php echo escape(Input::get('name')); ?>" autocomplete="off"/>
                        <input type="text"  placeholder="Username" name="username" id="username" value="<?php echo escape(Input::get('username')); ?>" autocomplete="off"/>
                        <input type="text"  placeholder="Email" name="email" id="email"/>
                        <input type="password"  placeholder="Password" name="password" id="password"/>
                        <input type="password"  placeholder="Re-enter password" name="password_again" id="password_again"/>
                        <button value="Register">Register</button>
                        <p class="message">Already Registered? <a href="login.php">Login</a> </p>
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
