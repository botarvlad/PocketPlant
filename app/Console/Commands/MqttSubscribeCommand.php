<?php

namespace App\Console\Commands;

use PhpMqtt\Client\MqttClient;
use PhpMqtt\Client\ConnectionSettings;
require "vendor/autoload.php";

use Illuminate\Console\Command;
use App\Models\Plant;
use App\Models\PlantAirHumidity;
use App\Models\PlantSoilMoisture;
use App\Models\PlantTemperature;

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

        $received_umid_sol = 100;

        $mqtt = new \PhpMqtt\Client\MqttClient($server, $port, $clientId);
        
        //? Create and configure the connection settings as required.
            $connectionSettings = (new ConnectionSettings)
                ->setUsername('yeti')
                ->setPassword('this is mosquitto');
        $mqtt->connect($connectionSettings, true);
        
        $mqtt->subscribe('home/boti/plant/temp', function ($topic, $message) {
            echo sprintf("Received message on topic [%s]: %s\n", $topic, $message);
            $plantTemperature = new PlantTemperature;
            $plantTemperature->temp = $message;
            $plantTemperature->save();
        }, 1);

        $mqtt->subscribe('home/boti/plant/umid_sol', function ($topic, $message) use ($received_umid_sol, $mqtt){
            echo sprintf("Received message on topic [%s]: %s\n", $topic, $message);
            $received_umid_sol = $message;
            $this->pub($mqtt, $received_umid_sol);
            echo sprintf("Umiditatea in sol este: %s\n", $received_umid_sol);
            $plantSoilMoisture = new PlantSoilMoisture;
            $plantSoilMoisture->umid_sol = $message;
            $plantSoilMoisture->save();
        }, 1);

        $mqtt->subscribe('home/boti/plant/umid_atm', function ($topic, $message) {
            echo sprintf("Received message on topic [%s]: %s\n", $topic, $message);
            $plantAirHumidity = new PlantAirHumidity;
            $plantAirHumidity->umid_atm = $message;
            $plantAirHumidity->save();
        }, 1);
        
        $mqtt->loop(true);
        $mqtt->disconnect();
        // return Command::SUCCESS;
    }

    function pub($m, $value) {
        echo $value;
        if ($value < 30) {
            $m->publish("home/boti/actions/run_pump", "on", 0);
        }
    }
}
