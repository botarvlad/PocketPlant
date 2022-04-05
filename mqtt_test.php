<?php 

require "vendor/autoload.php";
use PhpMqtt\Client\MqttClient;
use PhpMqtt\Client\ConnectionSettings;

$server   = '37.251.139.244';
$port     = 1883;
$clientId = 'pocket_plant_subscriber';

function doStuff ($topic, $message) {
    echo sprintf("Received message on topic [%s]: %s\n", $topic, $message);
    // fa functie de scris in db 
}

$mqtt = new \PhpMqtt\Client\MqttClient($server, $port, $clientId);
// Create and configure the connection settings as required.
    $connectionSettings = (new ConnectionSettings)
        ->setUsername('yeti')
        ->setPassword('this is mosquitto');
$mqtt->connect($connectionSettings, true);
// $mqtt->subscribe('home/boti/plant/temp', doStuff, 1);
$mqtt->subscribe('home/boti/plant/temp', function ($topic, $message) {
  echo sprintf("Received message on topic [%s]: %s\n", $topic, $message);
}, 1);
$mqtt->subscribe('home/boti/plant/umid_sol', function ($topic, $message) {
  echo sprintf("Received message on topic [%s]: %s\n", $topic, $message);
}, 1);
$mqtt->subscribe('home/boti/plant/umid_atm', function ($topic, $message) {
  echo sprintf("Received message on topic [%s]: %s\n", $topic, $message);
}, 1);
// fa comanda cu php artisan
$mqtt->loop(true);
$mqtt->disconnect();

?>