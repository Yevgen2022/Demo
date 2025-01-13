<?php


use Core\App;
use Core\Database;
use Core\Validator;
use Http\Forms\LoginForm;


$db = App::resolve(Database::class);

$email = $_POST['email'];
$password = $_POST['password'];


$form = new LoginForm();

if (!$form->validate($email, $password)) {
    return view('sessions/create.view.php',
        ['errors' => $form->errors()
        ]);
};


$user = $db->query('select * from users where email = :email',
    ['email' => $email]
)->find();

if ($user) {
    if (password_verify($password, $user['password'])) {
        login([
            'email' => $email
        ]);

        header("Location: /");
        exit();
    }
}


return view('session/create.view.php', [
    'errors' => [
        'email' => 'The email address and password you entered does not exist.'
    ]
]);


