<?php
require_once('core/JCore.php');
$JCore = new JCore();
if (JCore::getSessAccesUser() > 0) {
	echo "<script> window.location.href='http://coredev/index.php'; </script>";
}
?>
<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<link href="style/auth.css" rel="stylesheet"/>
		<title></title>
	</head>
	<body>
		<div id="authLayot">
		
			<form action="auth.php?action=auth" method="POST">
			<table class = "authTable">
				<tr>
					<td colspan="2">Авторизация!</td>
				</tr>
				<tr>
					<td>Логин:</td>
					<td><input name = 'userLogin' type = 'text'></td>
				</tr>
				<tr>
					<td>Пароль:</td>
					<td><input name = 'userPass' type = 'password'></td>
				</tr>
				<tr>
					<td colspan="2"><input name = 'authSub' type = 'submit'></td>
				</tr>
			</table>
			</form>
			<?php
				if (JCore::getInput('action') == 'auth') {
				echo "<div id='authError'>";
					$authError = new JErrorManagementSystem();
					$templAuthArr = ["userLogin"=>"",
								"userPass"=>""];
					$rsltPostAuth = JCore::arrPostInput($templAuthArr);
					if (empty($rsltPostAuth['userLogin']) or 
						strlen($rsltPostAuth['userLogin']) < JCONFIG['min_User_Login']) {
							$authError->setNumberError("0001xL");
					}else if (empty($rsltPostAuth['userPass']) or 
						strlen($rsltPostAuth['userPass']) < JCONFIG['min_User_Pass']) {
						$authError->setNumberError("0001xP");
					}else{
						$authUser = new JUserManagementSystem();
						$authUser->setUserData($rsltPostAuth);
						if (!$authUser->userExist()) {
							$authError->setNumberError("0001xU");
						}else if (!$authUser->verifyPass()) {
							$authError->setNumberError("0002xP");
						}else{
							$rsltOneUser = $authUser->getOneUserDb();
							JCore::setSession($rsltOneUser);
							echo "<script> window.location.href='http://coredev/index.php'; </script>";
						}
					}
					$authError->getMsgError();
				echo "</div>";
				}
			?>
			
			<form action="auth.php?action=reg" method="POST">
			<table class = "regTable">
				<tr>
					<td colspan="2">Регистрация!</td>
				</tr>
				<tr>
					<td>Логин:</td>
					<td><input name = 'userLogin' type = 'text'></td>
				</tr>
				<tr>
					<td>Пароль:</td>
					<td><input name = 'userPass' type = 'password'></td>
				</tr>
				<tr>
					<td>Повтор пароля:</td>
					<td><input name = 'userPassRep' type = 'password'></td>
				</tr>
				<tr>
					<td>Почта:</td>
					<td><input name = 'userMail' type = 'text'></td>
				</tr>
				<tr>
					<td colspan="2"><input name = 'regSub' type = 'submit'></td>
				</tr>
			</table>
			</form>
			<?php
			if (JCore::getInput('action') == 'reg') {
				echo "<div id='authError'>";
				$regError = new JErrorManagementSystem();
					$templRegArr = ["userLogin"=>"",
								"userPass"=>"",
								"userPassRep" => "",
								"userMail" => FILTER_VALIDATE_EMAIL];
					$rsltRegArr = JCore::arrPostInput($templRegArr);
					if (empty($rsltRegArr['userLogin']) or 
						strlen($rsltRegArr['userLogin']) < JCONFIG['min_User_Login']) {
							$regError->setNumberError("0001xL");
					}else if (empty($rsltRegArr['userPass']) or 
						strlen($rsltRegArr['userPass']) < JCONFIG['min_User_Pass']) {
						$regError->setNumberError("0001xP");
					}else if ($rsltRegArr['userPass'] != $rsltRegArr['userPassRep']) {
						$regError->setNumberError("0003xP");
					}else if (!$rsltRegArr['userMail']) {
						$regError->setNumberError("0001xM");
					}else{
						$regUser = new JUserManagementSystem();
						$regUser->setUserData($rsltRegArr);
						if ($regUser->userExist()) {
							$regError->setNumberError("0002xU");
						}else{
							$regUser->passHash();
							$regUser->addUserDb();
							$regError->lackyMsg("Спасибо за регистрацию!");
						}
					}
					$regError->getMsgError();
				echo "</div>";
			}
			?>
		</div>
	</body>
</html>













