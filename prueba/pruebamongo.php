<?php
require 'vendor/autoload.php' ;
$uri = 'mongodb://rs1.example.com,rs2.example.com/?replicaSet=myReplicaSet';

$collection = (new MongoDB\Client($uri))->test->inventory;

$changeStream = $collection->watch();

for ($changeStream->rewind(); true; $changeStream->next()) {
    if ( ! $changeStream->valid()) {
        continue;
    }

    $event = $changeStream->current();

    if ($event['operationType'] === 'invalidate') {
        break;
    }

    $ns = sprintf('%s.%s', $event['ns']['db'], $event['ns']['coll']);
    $id = json_encode($event['documentKey']['_id']);

    switch ($event['operationType']) {
        case 'delete':
            printf("Deleted document in %s with _id: %s\n\n", $ns, $id);
            break;

        case 'insert':
            printf("Inserted new document in %s\n", $ns);
            echo json_encode($event['fullDocument']), "\n\n";
            break;

        case 'replace':
            printf("Replaced new document in %s with _id: %s\n", $ns, $id);
            echo json_encode($event['fullDocument']), "\n\n";
            break;

        case 'update':
            printf("Updated document in %s with _id: %s\n", $ns, $id);
            echo json_encode($event['updateDescription']), "\n\n";
            break;
    }
}