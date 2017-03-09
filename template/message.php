<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 08.03.2017
 * Time: 22:07
 */
?><!DOCTYPE html>
<html>
<body>
<h3>Просмотр сообщения #<?=htmlspecialchars($variables['message']['id']); ?></h3>
<h4>Имя:</h4>
<?=htmlspecialchars($variables['message']['name']); ?>
<h4>Заголовок:</h4>
<?=htmlspecialchars($variables['message']['header']); ?>
<h4>Email:</h4>
<?=htmlspecialchars($variables['message']['email']); ?>
<h4>Текст сообщения:</h4>
<?=htmlspecialchars($variables['message']['text']); ?>




</body>
</html>