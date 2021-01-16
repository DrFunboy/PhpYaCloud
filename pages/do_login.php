<?
$data = $_POST;
if (isset($data["do_log_enter"]))
{
  $key = filter_var(trim($_POST['key']),FILTER_SANITIZE_STRING);
  $secretkey = filter_var(trim($_POST['secretkey']),FILTER_SANITIZE_STRING);
  $bucketname = ($_POST['bucketname']);
  if(($key != "")&&($secretkey != "")&&($bucketname!= ""))
  {
    $data_sets = file_get_contents("../settings.json");
    $data_sets = json_decode($data_sets, true);
    $data_sets['key'] = $key;
    $data_sets['secretkey'] = $secretkey;
    $data_sets['bucketname'] = $bucketname;
    file_put_contents('../settings.json',json_encode($data_sets));
    header('Location: ../index.php');
  }
  else {
    echo "Заполните все поля";
  }
}
?>
