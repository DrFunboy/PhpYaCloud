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
$sharedConfig = [
	'credentials' => [
	  'key'      => 'BeqMVuax0Tq7HRrNvuDU',
  	  'secret'   => 'rIMYMN6oXgCEVD7N5g8z2ZBZ1vKMLJfioKDDye4o',
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
			<div class="img_input_text"> Выберите файл
				<input type="file" name="file_inp">
			</div>
			<button type="submit" name="do_but_enter">Загрузить</button>
		</form>
	</div>
</body>
</html>
