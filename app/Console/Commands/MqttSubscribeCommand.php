<?php

namespace App\Console\Commands;

use PhpMqtt\Client\MqttClient;
use PhpMqtt\Client\ConnectionSettings;
require "vendor/autoload.php";

use Illuminate\Console\Command;
use App\Models\Plant;

class MqttSubscribeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mqtt:subscribe';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Subscribes to mqtt broker';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $server   = '37.251.139.244';
        $port     = 1883;
        $clientId = 'pocket_plant_subscriber';

        $mqtt = new \PhpMqtt\Client\MqttClient($server, $port, $clientId);
        
        //? Create and configure the connection settings as required.
            $connectionSettings = (new ConnectionSettings)
                ->setUsername('yeti')
                ->setPassword('this is mosquitto');
        $mqtt->connect($connectionSettings, true);
        
        $mqtt->subscribe('home/boti/plant/data', function ($topic, $message) {
            echo sprintf("Received message on topic [%s]: %s\n", $topic, $message);
            
        }, 1);

        $mqtt->subscribe('home/boti/plant/umid_sol', function ($topic, $message) {
            echo sprintf("Received message on topic [%s]: %s\n", $topic, $message);
        }, 1);

        $mqtt->subscribe('home/boti/plant/umid_atm', function ($topic, $message) {
            echo sprintf("Received message on topic [%s]: %s\n", $topic, $message);
        }, 1);
        
        $mqtt->loop(true);
        $mqtt->disconnect();
        // return Command::SUCCESS;
    }
}
