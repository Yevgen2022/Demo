<?php


use Core\App;
use Core\Authenticator;
use Core\Database;
use Core\Middleware\Auth;
use Core\Validator;
use Http\Forms\LoginForm;


//$db = App::resolve(Database::class);

$email = $_POST['email'];
$password = $_POST['password'];


$form = new LoginForm();

if ($form->validate($email, $password)) {

    if ((new Authenticator)->attempt($email, $password)) {
        redirect('/');
    }
    $form->error('email', 'No matching account found for that email address and password');
};


return view('sessions/create.view.php',
    ['errors' => $form->errors()
    ]);


//    return view('session/create.view.php', [
//        'errors' => [
//            'email' => 'The email address and password you entered does not exist.'
//        ]
//    ]);


//$user = $db->query('select * from users where email = :email',
//    ['email' => $email]
//)->find();
//
//if ($user) {
//    if (password_verify($password, $user['password'])) {
//        login([
//            'email' => $email
//        ]);
//
//        header("Location: /");
//        exit();
//    }
//}
//
//
//return view('session/create.view.php', [
//    'errors' => [
//        'email' => 'The email address and password you entered does not exist.'
//    ]
//]);


