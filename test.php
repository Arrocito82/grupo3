<!DOCTYPE html>
<html>
<head>
	<title>test</title>
</head>
<body>
	
	
	<?php
require 'vendor/autoload.php' ;
$client = new MongoDB\Client(
    'mongodb+srv://admin:grupo03TPI@grupo03.wwsio.mongodb.net/grupo03?retryWrites=true&w=majority'
);


$collection = $client->grupo03->Categoria;

//$result = $collection->insertOne( [ 'nombre' => 'bailable' ] );

//echo "Inserted with Object ID '{$result->getInsertedId()}'";
//$cursor = $collection->find(['nombre' => 'bailable']);
$cursor = $collection->find([]);

foreach ($cursor as $document) {
    echo $document['_id'], " \t",$document['nombre'], "<br>";
}
	?> 
	<h1>algo es algo</h1>

</body>
</html>

