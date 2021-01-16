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
	$bucket = "foldertest";
	$s3Client->putObject([
        'Bucket' => $bucket,
				'Key'    => $folder.$file_name,
        'Body'   => fopen( $new_temp. $file_name, 'r')
]);

	echo "https://storage.yandexcloud.net/".$bucket."/".$folder.$file_name;
	gc_collect_cycles();
	unlink($new_temp.$file_name);
}
?>
