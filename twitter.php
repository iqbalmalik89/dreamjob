<?php
include('twitterLib.php');
// $pdo = new PDO("mysql:dbname=dreamjob", "root");
// $fpdo = new FluentPDO($pdo);
// die();
$obj = new twitterLib();
$rs = $obj->search('Tilde Co-Founder, OSS enthusiast and world traveler.');
echo "<pre>";
print_r($rs);
?>