<?php
error_reporting(-1);
header('Content-Type: text/html; charset=utf-8');
require "/../vendor/autoload.php";
?>
<html>
<title>Удаление</title>
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
			<form action="/pages/do_del.php" method="post">
				<div class="img_input_text"> Укажите название файла или путь и название к файлу
					<input type="text" name="file_delete" placeholder="имя файла/папки и файла" autocomplete="off">
				</div>
				<button type="submit" name="do_but_del">Удалить</button>
			</form>
		</div>
<?
}
?>
</body>
</html>
