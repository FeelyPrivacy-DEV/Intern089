<?php

session_start(); 
use Elasticsearch\ClientBuilder;
require '../../vendor/autoload.php';
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

$logger = new Logger('name');
$logger->pushHandler(new StreamHandler('path/to/your.log', Logger::WARNING));

$client = ClientBuilder::create()       // Instantiate a new ClientBuilder
            ->setLogger($logger)        // Set your custom logger
            ->build();
    $client = ClientBuilder::create()->build();

    $con = new MongoDB\Client( 'mongodb://test.com:27017' );
    $db = $con->php_mongo; $collection = $db->manager;

    $result = [];

    $query = $collection->find();

    foreach($query as $key) {
        $result[] = $key['fname'];
    }

    
    // print_r($result);

    $params = [
        'index' => 'my_index',
        'id'    => 'my_id',
        'body'  => ['testField' => 'abc']
    ];
    
    $response = $client->search($params);

    echo '<pre>';
    print_r($response);




        
?> 