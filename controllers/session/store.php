<?php


use Core\App;
use Core\Database;
use Core\Validator;


$db = App::resolve(Database::class);

$email = $_POST['email'];
$password = $_POST['password'];

$errors = [];
if (!Validator::email($email)) {
    $errors['email'] = 'Please enter a valid email address';
}

if (!Validator::string($password)) {
    $errors['password'] = 'Please provide a valid password.';
}

if (!empty($errors)) {
    return view('sessions/create.view.php',
        ['errors' => $errors]);
}


$user = $db->query('select * from users where email = :email',
    ['email' => $email]
)->find();


//if(!$user){
//    return view ('sessions/create.view.php',[
//        'errors' => [
//            'email' => 'The email address you entered does not exist.'
//        ]
//    ]);
//}


if ($user) {
    if(password_verify($password, $user['password'])){
        login([
            'email' => $email
        ]);

        header("Location: /");
        exit();
    }
}


return view ('session/create.view.php',[
    'errors' => [
        'email' => 'The email address and password you entered does not exist.'
    ]
]);


