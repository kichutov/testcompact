<?php 
	session_start();
	// Очищаем массив $_SESSION
    session_unset();
    // Удаляем временное хранилище на сервере
    session_destroy();
    // Удаляем cookie сессии на стороне пользователя
    setcookie(session_name(), '', time() - 60*60*24*32, '/');

    $_SESSION['answers'] = [];

    // Переходим на главную страницу
    header ('Location: ./index.php');
	exit();   

?>