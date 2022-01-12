<?php
session_start();

// Создаём массив ответов
if (!isset($_SESSION['answers'])) {
	$_SESSION['answers'] = [];
} 

// Запрашиваем массив вопросов
$questions = require_once ('./questions.php');
// Создаём переменную с номером вопроса
if (!isset($_SESSION['question_number'])) {
	$_SESSION['question_number'] = 1;
} else if ((!empty($_POST['answer'])) || ((!empty($_POST['answer1'])) && (!empty($_POST['answer2'])))) {
	$_SESSION['question_number'] += 1;
	// Если переменная POST не пустая, записываем ответ в массив
	if (count($_POST) == 2) {
		$_SESSION['answers'][] = [$_POST['answer1'],$_POST['answer2']];
	} else {
		$_SESSION['answers'][] = mb_strtoupper($_POST['answer']);
	}
}

// Если номер вопроса больше 40, то переходим на страницу завершения теста
if ($_SESSION['question_number'] == 41) {
	// Переходим на страницу итогов теста
	header ('Location: ./finish.php');
	exit();  
}
?>


<!DOCTYPE html>
<html lang="ru">
<head>
	<?php require_once('head.php')?>
	<!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-KQC2P9X');</script>
    <!-- End Google Tag Manager -->
</head>
<body>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KQC2P9X"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
	<?php require_once('header.php')?>
	<section class="main">

		<div class=""></div>
		<div class="main__test" id="test">

			<?= '<h2>Вопрос '. $_SESSION['question_number'] . '. ' .($questions[$_SESSION['question_number']-1]['titleQuestion']).'</h2>';
			echo '<form action="start.php" method="POST">'; ?>
			

			<?php

			

				// Проверяем категорию вопроса
			if ($questions[$_SESSION['question_number']-1]['category'] == 'choice_of_shapes') {
				echo '<div class="main___test__task">';
						// Создаём блок вопроса
					echo '<div class="test__task__question">';
					echo '<img src=\''.($questions[$_SESSION['question_number']-1]['question']).'\'>';
					echo '</div>';

						// Создаём блок ответов
					echo '<div class="test__task__answers choice_of_shapes">';
							//Перебираем и выводим варианты ответов
					foreach (($questions[$_SESSION['question_number']-1]['answers']) as $key=>$answer) {
						$value = $key + 1;
						echo '<div class="choice_of_shapes__item">';
						echo '<input class="input__choice_of_shapes" type="radio" id='.$answer.' name="answer" value='.$value.'>';
						echo '<label for='.$answer.'><img src='.$answer.'></label>';
						echo '</div>';
					}
					echo '</div>';
				echo '</div>';

				// Проверяем категорию вопроса
			} else if ($questions[$_SESSION['question_number']-1]['category'] == 'inserting_word') {
				echo '<div class="main___test__task">';
						// Создаём блок вопроса
					echo '<div class="test__task__question">';
							//Перебираем и выводим данные для вопроса
					foreach (($questions[$_SESSION['question_number']-1]['question']) as $question) {
						echo '<p>'.$question.'</p>';
					};
					echo '</div>';

						// Создаём блок ответов
					echo '<div class="test__task__answers">';
					echo '<input type="text" name="answer">';
					echo '</div>';
				echo '</div>';

				// Проверяем категорию вопроса
			} else if ($questions[$_SESSION['question_number']-1]['category'] == 'anagram') {
				echo '<div class="main___test__task__anagram">';
						// Создаём блок вопрос-ответ для анаграмм
					echo '<div class="test__task__question__anagram">';
					foreach (($questions[$_SESSION['question_number']-1]['answers']) as $key=>$answer) {
						$value = $key + 1;
						echo '<input class="input__anagram" type="radio" id='.$answer.' name="answer" value='.$value.'>';
						echo '<label  style="font-size: 24px" for='.$answer.'><p>'.$answer.'</p></label>';
					}
					echo '</div>';
				echo '</div>';

				// Проверяем категорию вопроса
			} else if ($questions[$_SESSION['question_number']-1]['category'] == 'missing_number') {
				echo '<div class="main___test__task">';
						// Создаём блок вопроса
					echo '<div class="test__task__question">';
					echo '<img src=\''.($questions[$_SESSION['question_number']-1]['question']).'\'>';
					echo '</div>';

						// Создаём блок ответов
					echo '<div class="test__task__answers">';
					echo '<input type="text" name="answer">';
					echo '</div>';
				echo '</div>';

				// Проверяем категорию вопроса
			} else if ($questions[$_SESSION['question_number']-1]['category'] == 'missing_number_double') {
				echo '<div class="main___test__task">';
						// Создаём блок вопроса
					echo '<div class="test__task__question">';
					echo '<img src=\''.($questions[$_SESSION['question_number']-1]['question']).'\'>';
					echo '</div>';

						// Создаём блок ответов
					echo '<div class="test__task__answers">';
					echo '<input type="text" name="answer1" placeholder="1">';
					echo '<input type="text" name="answer2" placeholder="2">';
					echo '</div>';
				echo '</div>';


			};

			echo '<button type="submit" class="button__answer">Ответить</button>';
			echo '</form>';
			?>
			<div class="main__test__otherButtons">
				<form action="skipQuestion.php">
					<button class="otherButton">Пропустить вопрос</button>
				</form>

				<form action="endTest.php">
					<button class="otherButton">Завершить тест</button>
				</form>
			</div>

		</div>
		<div class=""></div>
	</section>

	
	<?php require_once('footer.php')?>
</body>
</html>