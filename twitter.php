<?php
include('twitterLib.php');
$obj = new twitterLib();
$rs = $obj->search('iqbal');
echo "<pre>";
print_r($rs);
?>