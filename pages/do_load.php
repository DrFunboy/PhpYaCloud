<?php
require "/../../vendor/autoload.php";
error_reporting(-1);
header('Content-Type: text/html; charset=utf-8');
$data = $_POST;
if (isset($data["do_but_enter"]))
{
	$file_name = $_FILES ['file_inp']['name'];
	$file_tmp_name = $_FILES ['file_inp']['tmp_name'];
	$folder = ($_POST['file_folder']);
	if (($folder)!="") {
	$folder = ($folder."/");
	}
	$new_temp = "../files/";
	$errors = array();
	if (($file_name) == "")
	{
		$errors[] = 'Файл не выбран';
	}
	if (empty($errors))
	{

			echo(" <div style='color: #0f0;'>да! </div>");
			move_uploaded_file($file_tmp_name, $new_temp. $file_name);
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
	$s3Client->putObject([
        'Bucket' => $bucketname,
				'Key'    => $folder.$file_name,
        'Body'   => fopen( $new_temp. $file_name, 'r')
]);

	echo "https://storage.yandexcloud.net/".$bucketname."/".$folder.$file_name;
	gc_collect_cycles();
	unlink($new_temp.$file_name);
}
?>
