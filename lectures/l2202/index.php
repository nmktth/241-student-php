<?php
$number = 42;
$url = "https://httpbin.org/get" . urlencode($number);
$response = file_get_contents($url);


?>