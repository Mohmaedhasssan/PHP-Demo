<?php

use Core\Database;
use Core\Validator;
use Core\App;

$db=App::resolve(Database::class);

$currentUserId = 1;
$errors = [];

if (!Validator::string($_POST['body'],1,1000)) {
    $errors['body'] = 'A body of Maximum Charactars 1,000 is required';
}


if (!empty($errors)) {
    return view("notes/create.view.php",[
        'heading' =>'Create New Note',
        'errors'=>$errors
    ]);
}

$db->query('INSERT INTO notes (body,user_id) VALUES(:body,:user_id)', [
    'body' => $_POST['body'],
    'user_id' => $currentUserId
]);

header('Location: /notes');
die();