<?php
error_reporting(-1);
header('Content-Type: text/html; charset=utf-8');
require "/../vendor/autoload.php";
?>
<html>
<title>Главная</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<head>
	<link rel="stylesheet" type="text/css" href="css\index.css">
	<script type="text/javascript" src="javas.js"> </script>
</head>
<body>
	<div>
<?
$data_sets = file_get_contents("settings.json");
$data_sets = json_decode($data_sets, true);
$key = ($data_sets['key']);
$secretkey = ($data_sets['secretkey']);
If (($key == "")||($secretkey == ""))
{
	?>
	<form action="/pages/do_login.php" enctype="multipart/form-data" method="post">
		<div class="key_input_text"> Введите ключ
			<input type="text" name="key" autocomplete="off">
		</div>
		<div class="key_input_text"> Введите секретный ключ
			<input type="text" name="secretkey" autocomplete="off">
		</div>
		<button type="submit" name="do_log_enter">Подтвердить</button>
	</form>
	<?
}
else{
	$sharedConfig = [
		'credentials' => [
		  'key'      => $key,
	  	  'secret'   => $secretkey,
		],
		'region'   => 'us-east-1',
		'endpoint' => 'https://storage.yandexcloud.net',
		'version'  => 'latest',
	];
	$sdk = new Aws\Sdk($sharedConfig);
	$s3Client = $sdk->createS3();
	?>
		</div>
		<div>
			<form action="/pages/do_load.php" enctype="multipart/form-data" method="post">
				<div class="img_input_text"> Укажите папку или путь из нескольких папок
					<input type="text" name="file_folder" placeholder="имя папки/имя подпапки" autocomplete="off">
				</div>
				<div class="img_input_text"> Выберите файл
					<input type="file" name="file_inp">
				</div>
				<button type="submit" name="do_but_enter">Загрузить</button>
			</form>
		</div>
<?
}
?>
</body>
</html>
