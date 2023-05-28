<?php

require 'vendor/autoload.php';

use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule;

$connection = require 'config.php';
$capsule->addConnection($connection['database']);

$capsule->setAsGlobal();

$capsule->bootEloquent();
