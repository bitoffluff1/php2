<h1>Товар</h1>

<?php
echo <<<php
<h2>$good->name</h2>
<p>Стоимость: $good->price</p>
<a href="?id=$good->id">Удалить</a>
php;
?>

