<?php
require_once '../bootstrap.php';

$showMeTheCarFax = new User();
$plzWork = $showMeTheCarFax->getColumnNames();
print_r($plzWork);

 ?>
