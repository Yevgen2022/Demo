<?php



use Core\Database;
use Core\Validator;


require base_path('Validator.php');


$config = require base_path('config.php');
$db = new Database($config['database']);
//$heading = 'Create Note';


$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //$errors = [];

    
if (! Validator::email('john@example.com')){
    dd('that is not a valid email!');
};


    
    // if (strlen($_POST['body']) === 0) {
    if (! Validator::string($_POST['body'], 1, 100)) {
        $errors['body'] = 'A body of no more then 1,00 characters is required.';
    }

    // if ($validator->string($_POST['body']) > 100) {
    //     $errors['body'] = 'A body can not be more 100 characters. ';
    // }



    if (empty($errors)) {
        $db->query('INSERT INTO notes(body, user_id) VALUES(:body, :user_id)', [
            'body' => $_POST['body'],
            'user_id' => 1
        ]);
    }
};

view("notes/create.view.php", [
    'heading' => 'Create Note',
    'errors' => $errors,
]);
