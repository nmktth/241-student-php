<?php
    $headers = get_headers('https://github.com/nmktth/241-student-php');
    echo "<textarea>";
        print_r($headers);
    echo "</textarea>";
?>