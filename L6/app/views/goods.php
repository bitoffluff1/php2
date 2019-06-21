<?php /** @var array $goods */ ?>
<h1>Товары</h1>

<?php foreach ($goods as $good): /** App\models\Good $good */
    echo <<<php
<h2>$good->name </h2>
<a href="?id=$good->id"> Подробнее </a>
php;
endforeach; ?>
