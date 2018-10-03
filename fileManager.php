<?php
require_once('core/JCore.php');
$JCore = new JCore();
?>
<!doctype html>
<html>
	<head>
		<link href="style/fileManager.css" rel="stylesheet"/>
		<title></title>
	</head>
	<body>
		<div id="fileManagerLayot">
			<a href = 'filename.php?action=book'></a>
			<div id="fileManagerHeader"><H2>JCoreFileManager</H2></div>
			<div id="fileManagerContent">
				<?php
				switch (JCore::getInput('action')) {
					case 'book':
					$templBookArr = ["cat" => "", "titleBook" => ""];
					$fileBookArr = JCore::arrGetInput($templBookArr);
					new JdBug($fileBookArr,1);
					echo "";
					break;
				}
				?>
				
			</div>
			<div id="fileManagerFooter"></div>
		</div>
	</body>
</html>