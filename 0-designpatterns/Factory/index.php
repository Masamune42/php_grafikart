<?php
require 'vendor/autoload.php';

use App\CarFactory;

CarFactory::getCar('4x4');
echo '<br>';
CarFactory::getCar('citadine');