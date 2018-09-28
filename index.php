<?php
$start = microtime(true);
$a = memory_get_usage();
require_once('core/JCore.php');
$JCore = new JCore();
$user = new JUserManagementSystem();
if (JCore::getInput('action') == 'exit') {
	JCore::stopSession();
	echo "<script> window.location.href='http://coredev/index.php'; </script>";
}
?>
<!Doctype>
<html>
	<head>
		<meta charset="utf-8">
		<link href="style/index.css" rel="stylesheet"/>
	</head>
	<body>
		<div id="layot">
			<div id="menuHead">
				<H3 class="h3titleSite">MySiteName</H3>
				<ul class="lincMenuHead">
					<li><a href="index.php">Главная</a></li>
					<li><a href="">Форум</a></li>
					<li><a href="index.php?action=info">Информация</a></li>
				</ul>
				<ul class="lincRegHead">
				<?php
				if (JCore::getSessAccesUser() == 0) {
					echo "<li><a href='auth.php'>Вход\Регистрация</a></li>";
				}else{
					echo "<li><a href='index.php?action=exit'>Выход!</a></li>
						<li><a href='index.php?action=lk'>Личный кабинет!</a></li>";
				}
				?>
				</ul>
			</div>
			<div id="header"></div>
			<div id="rightBlock"></div>
			<div id="leftBlock">
				<ul>
					<li><a href="index.php?action=books">Книги</a></li>
					<li><a href="index.php?action=films">Фильмы</a></li>
					<li><a href="index.php?action=images">Картинки</a></li>
					<li><a href="index.php?action=games">Игры</a></li>
				</ul>
			</div>
			<div id="content">
<?php
	switch (JCore::getInput('action')) {
		case 'books':
		break;
		
		case 'films':
		break;
		
		case 'images':
		break;
		
		case 'games':
		break;
		/* Личный кабинет */
		case 'lk':
		if (JCore::getSessAccesUser() > 0) {
			$rsltUserSession = JCore::getSession();
			echo "<table>
			<tr>
				<td>id</td>
				<td>Логин</td>
				<td>Звание</td>
				<td>Коины</td>
				<td>Почта</td>
				<td>ip</td>
				<td>Дата регистрации</td>
				<td>Уровень доступа</td>
			</tr>
			<tr>
				<td>".$rsltUserSession['id']."</td>
				<td>".$rsltUserSession['userLogin']."</td>
				<td>".JCore::userRank($rsltUserSession['userRank'])."</td>
				<td>".$rsltUserSession['userCoin']."</td>
				<td>".$rsltUserSession['userMail']."</td>
				<td>".$rsltUserSession['userIp']."</td>
				<td>".$rsltUserSession['userDateReg']."</td>
				<td>".JCore::AccesName($rsltUserSession['userAcces'])."</td>
			</tr>
			</table>";	
		}else{
			echo "<a href = 'auth.php'>Зарегестрироваться!</a>";
			}
		break;
		/* ПВыводим одну новость по названию новости */
		case 'viewNews';
		$oneNews = new JNews();
		$oneNews->setNews(["titleNews" => JCore::getInput('titleNews')]);
		$rsltOneNews = $oneNews->getNews();
		printf("<table class = 'contentTable'>
			<tr>
				<td colspan = '2'>".$rsltOneNews['titleNews']."</td>
			</tr>
			<tr>
				<td>".$rsltOneNews['imgNews']."</td>
				<td>".$rsltOneNews['contentNews']."</td>
			</tr>
			<tr>
				<td><a href = '".$rsltOneNews['lincNews']."'>Linc to News</a></td>
				<td>".$rsltOneNews['categoryNews']."</td>
			</tr>
			</table>");
		break;
		/* Поумолчанию выводим Новости */
		default:
		$allNews = new JNews();
		$rsltNews = $allNews->getAllNews();
		foreach ($rsltNews as $key => $val) {
			printf("<table class = 'contentTable'>
			<tr>
				<td colspan = '2'><a href ='index.php?action=viewNews&titleNews=%s'>%s</a></td>
			</tr>
			<tr>
				<td width = '150px'>%s</td>
				<td><p>%s</p></td>
			</tr>
			<tr>
				<td><a href = '%s'>Linc to News</a></td>
				<td>%s</td>
			</tr>
			</table>",$rsltNews[$key]['titleNews'],
					$rsltNews[$key]['titleNews'],
					$rsltNews[$key]['titleImg'],
					$rsltNews[$key]['contentNews'],
					$rsltNews[$key]['lincNews'],
					$rsltNews[$key]['categoryNews']);
		}
		break;
	}
?>
			</div>
			<div id="footer"></div>
		</div>
	</body>
</html>
<?php
$b = memory_get_usage();
$c = $b-$a;
echo ($c);
$time = microtime(true) - $start;
printf('Скрипт выполнялся %.4F сек.', $time);
?>