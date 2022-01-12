<?php

session_start();

$rightAnswers = require_once ('./rightAnswers.php');
$countRightAnswers = 0;
$iq = 0;

// Функция подсчёта количества правильных ответов

for ($i=0; $i < 15; $i++) { 
	if ($_SESSION['answers'][$i] == $rightAnswers[$i]) {
		$countRightAnswers += 1;
	}
}

if (($_SESSION['answers'][15][0] == $rightAnswers[15][0])
	&& ($_SESSION['answers'][15][1] == $rightAnswers[15][1])) {
	$countRightAnswers += 1;
}

if (($_SESSION['answers'][25][0] == $rightAnswers[25][0])
	&& ($_SESSION['answers'][25][1] == $rightAnswers[25][1])) {
	$countRightAnswers += 1;
}

if (($_SESSION['answers'][34][0] == $rightAnswers[34][0])
	&& ($_SESSION['answers'][34][1] == $rightAnswers[34][1])) {
	$countRightAnswers += 1;
}

for ($i=16; $i < 25; $i++) { 
	if ($_SESSION['answers'][$i] == $rightAnswers[$i]) {
		$countRightAnswers += 1;
	}
}

for ($i=26; $i < 34; $i++) { 
	if ($_SESSION['answers'][$i] == $rightAnswers[$i]) {
		$countRightAnswers += 1;
	}
}

for ($i=35; $i < 40; $i++) { 
	if ($_SESSION['answers'][$i] == $rightAnswers[$i]) {
		$countRightAnswers += 1;
	}
}

// Рассчитываем IQ

if ($countRightAnswers < 6) {
	$iq = $countRightAnswers * 15;
} else if (($countRightAnswers >= 6) && ($countRightAnswers <= 18)) {
	$iq = round(((($countRightAnswers - 6) * 2.5 ) + 90));
} else if ($countRightAnswers == 19) {
	$iq = round(((($countRightAnswers - 6) * 2.5 ) + 92.5));
} else if ($countRightAnswers >= 20) {
	$iq = round(((($countRightAnswers - 6) * 2.5 ) + 95));
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
		<div class="main__test">
			<h2><?= 'Ваш IQ равен: ' . $iq; ?></h2>
			<div class="iq__level">
				<h3>Градация уровней IQ:</h3>
				<table>
					<tr>
						<td>130 и более</td>
						<td>Высокий IQ</td>
					</tr>
					<tr>
						<td>110 - 130</td>
						<td>Выше среднего уровня IQ</td>
					</tr>
					<tr>
						<td>90 - 110</td>
						<td>Средний IQ</td>
					</tr>
					<tr>
						<td>70 - 90</td>
						<td>Ниже среднего уровня IQ</td>
					</tr>
					<tr>
						<td>Менее 70</td>
						<td>Низкий IQ</td>
					</tr>
				</table>
			</div>
			<form action="./againTest.php">
				<button class="button__answer">Пройти тест заново</button>
			</form>
		</div>
		<div class=""></div>
	</section>
	<?php require_once('footer.php')?>
</body>
</html>

