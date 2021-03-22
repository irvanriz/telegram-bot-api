<?php
include 'config.php';

$nama = $_POST['nama'];
$pesan = $_POST['pesan'];
$tanggal = date("Y-m-d");

if ( isset($_POST['submit']) )
{
    $sql    = "INSERT INTO apptele VALUES('','$nama','$pesan','$tanggal')";
    //$sql    = "INSERT INTO apptele SET nama='$_POST[nama]',pesan='$_POST[pesan]',tanggal='$_POST[tanggal]'";
    $result = mysqli_query($link, $sql);
} 

define('BOT_TOKEN', '1366163648:AAE0WVEnezXfnVmeLFJJLwW4u3FWXsU1FrY');
define('CHAT_ID','-416615904');
 
function kirimTelegram($pesan,$nama) {
    $pesan = json_encode($pesan);
    $API = "https://api.telegram.org/bot".BOT_TOKEN."/sendmessage?chat_id=".CHAT_ID."&text=$nama"."|"."$pesan";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_URL, $API);
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}
kirimTelegram($_POST['pesan'],$_POST['nama']);

header('Location:index.php');

?>