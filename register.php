<?php
    require_once 'core/init.php';

    if(Input::exists()) {
        if (Token::check(Input::get('token'))) {

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
                    'min' => 8
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
                $user = new User();
                $salt = Hash::salt(32);
                try {
                    
                    $user->create(array(
                        'username' => Input::get('username'),
                        'name' => Input::get('name'),
                        'email' => Input::get('email'),
                        'password' => Hash::make(Input::get('password'), $salt),
                        'salt' => $salt,
                        'joined' => date('Y-m-d H:m:s'),
                        'groups' => 1,
                        'confirmed' => 0

                    ));

                        $email = Input::get('email');
                        $u_name = Input::get('username');
                        $subject = 'Signup | Verification';
                        $message = 'Thank you for registering. Please click the link to verify your registration:';
                        $message .= "<a href='http://localhost:8080/Camagru/confirm.php?user=$u_name&salt=$salt'>Confirm Account</a>";
                        $headers = 'From:noreply@camagru.admin.kjohnsto' . "\r\n";
                        $headers .= "MIME-Version: 1.0" . "\r\n";
                        $headers .= "Content-Type:text/html;charset=UTF-8". "\r\n";
                        mail($email, $subject, $message, $headers);
                        Session::flash('home', 'Please check your email for confirmation');
                        Redirect::to('index.php');
                 
                } catch(Exception $e) {
                    die($e->getMessage());
                }
            }else {
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
                <h2>Please register a profile</h2>
                </div>
            </div>
            <div class="login-page">
                <div class="form">
                    <form class="register-form" action="" method="post">
                        <input type="text"  placeholder="Name & Surname" name="name" id="name" value="<?php echo escape(Input::get('name')); ?>" autocomplete="off" />
                        <input type="text"  placeholder="Username" name="username" id="username" value="<?php echo escape(Input::get('username')); ?>" autocomplete="off"/>
                        <input type="text"  placeholder="Email" name="email" id="email" pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,63}$" oninput="setCustomValidity('')" oninvalid="setCustomValidity('Invalid Email')"oninput="setCustomValidity('')" oninvalid="setCustomValidity('Invalid, Username needs to be minimum 5 characters, minimum 1 special character, 1 Capital letter and 1 number')"/>
                        <input type="password"  placeholder="Password" name="password" id="password" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$" oninput="setCustomValidity('')" oninvalid="setCustomValidity('Invalid Password - Password needs to be 8 minimum characters, minimum 1 special character, 1 Capital letter and 1 number')" autocomplete="off">/>
                        <input type="password"  placeholder="Re-enter password" name="password_again" id="password_again"/>
                        <input type="hidden" name="token" value="<?php echo Token::generate(); ?>"/>
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
