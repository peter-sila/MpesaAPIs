<?php

header("Content-Type: application/json");

$stkcallbackresponse = file_get_contents('php://input');
$logfile = "mpesastkresponse.json";
$log = fopen($logfile, "a");
fwrite($log, $stkcallbackresponse);
fclose($log);

$data = json_decode($stkcallbackresponse);


?>
