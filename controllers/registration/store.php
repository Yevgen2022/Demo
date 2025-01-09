<?php

use Core\App;
use Core\Database;
use Core\Validator;


$email = $_POST['email'];
$password = $_POST['password'];


// validate form inputs
$errors = [];
if (!Validator::email($email)) {
    $errors['email'] = 'Please enter a valid email address';
}

if (!Validator::string($password, 7, 255)) {
    $errors['password'] = 'Please provide a password of at least seven characters.';
}


if (! empty($errors)) {
    return view('registration/create.view.php', [
        'errors' => $errors
    ]);
}


$db = App::resolve(Database::class);
//check if the account already exist
$user = $db->query('select * from users where email = :email', [
    ':email' => $email
])->find();



if ($user) {
    //then someone with that email already exist and has an account.
    // If yes, redirect to a login page.
    header("Location: /");
    exit();

} else {
    $db->query('insert into users (email, password) values (:email, :password)', [
        ':email' => $email,
        ':password' => password_hash($password, PASSWORD_DEFAULT)
    ]);
}

//mark that the user has logged in
$_SESSION['user'] =[
    'email' => $email,
];

header("Location: /");
exit();



// If not, save one to the database, and then log the user in, and redirect.