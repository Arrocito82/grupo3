<!DOCTYPE html>
<html>
<head>
	<title>test</title>
	<?php require 'Components/Layout/globalCssImports.php'; ?>
</head>
<body>
<?php require 'Components/Layout/navbar.php'; ?>
<div class="container">
	<main role="main" class="pb-3">

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
	<h1>algo es algo </h1>
	</main>
</div>	

<?php require 'Components/Layout/footer.php'; ?>
<?php require 'Components/Layout/globalJsImports.php'; ?>
</body>
</html>

