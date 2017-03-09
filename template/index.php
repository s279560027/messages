<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 08.03.2017
 * Time: 22:07
 */
?><!DOCTYPE html>
<html>
<head>
    <link href="/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="navbar">
    <div class="navbar-inner">
        <div class="container">
            <ul class="nav nav-tabs">
                <li<?=$_SERVER['REQUEST_URI'] == '/'? ' class="active"' : '' ;?>><a href="/">Главная</a></li>
                <li<?=$_SERVER['REQUEST_URI'] == '/list'? ' class="active"' : '' ;?>><a href="/list">Список всех отзывов</a></li>
                <li<?=$_SERVER['REQUEST_URI'] == '/admin'? ' class="active"' : '' ;?>><a href="/admin">Администрирование</a></li>
            </ul>

            <?=$variables['content']; ?>
        </div>
    </div>
</div>



</body>
</html>