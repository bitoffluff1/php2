<?php /** @var array $users */ ?>
<h1>Пользователи</h1>

<?php foreach ($users as $user): /** App\models\User $user */
    echo <<<php
<h2>$user->login </h2>
<a href="?c=user&a=user&id=$user->id"> Подробнее </a>
php;
endforeach; ?>
