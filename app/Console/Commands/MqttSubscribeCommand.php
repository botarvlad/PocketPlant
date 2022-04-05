<?php

namespace App\Console\Commands;

use PhpMqtt\Client\MqttClient;
use PhpMqtt\Client\ConnectionSettings;
require "vendor/autoload.php";

use Illuminate\Support\Facades\DB;
use Illuminate\Console\Command;

use App\Models\Plant;
use App\Models\Device;
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

        $mqtt->subscribe('home/boti/plant/umid_sol', function ($topic, $message) use ( $mqtt) {
            echo sprintf("Received message on topic [%s]: %s\n", $topic, $message);
            //$this->pub($mqtt);
            $this->checkDevicePlant($message, $mqtt);
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
    }

    function checkDevicePlant($message, $m) {
        $decoded_message = json_decode($message);

        $current_umid = $decoded_message->umid_sol;
        $device_mac = $decoded_message->mac;
        
        // verifici in ce planta sta device-ul
        $device = Device::where('mac_address', $device_mac)->get();
        echo sprintf("Plant Id al device-ului este: %s\n", $device[0]->plant_id);
        $plant = Plant::where('id', $device[0]->plant_id)->get();
        echo sprintf("Planta in care sta device-ul este: %s\n", $plant);

        // iei trash_holdul pentru umiditatea ideala a plantei respective
        echo sprintf("Specia plantei este: %s\n", $plant[0]->species);
        $ideal_value = DB::table('plants_care')->where('name', $plant[0]->species)->value('water'); 
        echo sprintf("Ideal Value este: %s\n", $ideal_value);
        //! Nu ii buna valoarea (este 'dry') Trebe mapare...
        
        $ideal_value = 40; //! Atribuire Temporara
        
        // compari cele 2 variabile de pana acum (current_umid < trash_hold)
        if ($current_umid < $ideal_value) {
            $this->pub($m);
        } else {
            return;
        }
        // true => pub()
        // false => return
    }

    function pub($m) {
        $m->publish("home/boti/actions/run_pump", "on", 0);
    }
}
