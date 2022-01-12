<?php 
	session_start();
    $_SESSION['question_number'] += 1;
    $_SESSION['answers'][] = NULL;
	
    // Переходим на главную страницу
    header ('Location: ./start.php');
	exit();   

?>