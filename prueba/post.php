<?php
$data = json_decode(file_get_contents('php://input'), true);



echo var_dump($data);

?>