<?php
require "/../../vendor/autoload.php";
error_reporting(E_ALL);
/*ini_set('display_errors', 0);
ini_set('log_errors','on');
ini_set('error_log', __DIR__ . '/../logs/main_error.log');*/
header('Content-Type: text/html; charset=utf-8');
$data = $_POST;
if (isset($data["do_but_del"]))
{

	$folder = ($_POST['file_delete']);
	$errors = array();
	if (($folder) == "")
	{
		$errors[] = 'Файл не выбран';
	}
	if (empty($errors))
	{

			echo(" <div style='color: #0f0;'>да! </div>");
	}
	else
	{
		echo '<div style="color: red;  font-size: 1.5vw;">' . array_shift($errors).'</div>' ;
	}

	$data_sets = file_get_contents("../settings.json");
	$data_sets = json_decode($data_sets, true);
	$key = ($data_sets['key']);
	$secretkey = ($data_sets['secretkey']);
	$bucketname = ($data_sets['bucketname']);


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
	echo "<pre>";
	var_dump(
		$s3Client->deleteObject(
		[
        'Bucket' => $bucketname,
				'Key'    => $folder
		])
	);
	echo "</pre>";
}
?>
