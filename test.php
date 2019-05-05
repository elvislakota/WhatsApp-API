<?php


require ('vendor/autoload.php');



$clientEntity = new \WhatsAppAPI\Controllers\clientEntity('001', '00000000');

$req = new \WhatsAppAPI\Requests\RegistrationExist($clientEntity);

