<?php
require 'elements/header.php';
require_once 'class/OpenWeather.php';
$meteo = new OpenWeather('046fa79e412cbe0f76bb20831021e23a');
$forecast = $meteo->getForecast('Quimper,fr');
?>

<div class="container">
    <ul>
        <li><?= $forecast['date']->format('d/m/Y') ?> <?= $forecast['description'] ?> <?= $forecast['temp'] ?>°C</li>
    </ul>
</div>

<?php
require 'elements/footer.php';
