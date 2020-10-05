<?php
class OpenWeather
{
    protected $apiKey;

    public function __construct($apiKey)
    {
        $this->apiKey = $apiKey;
    }

    public function getForecast($city)
    {
        $curl = $curl = curl_init("api.openweathermap.org/data/2.5/weather?q={$city},fr&appid={$this->apiKey}&units=metric&lang=fr");
        curl_setopt_array($curl, [
            CURLOPT_CAINFO          => __DIR__ . DIRECTORY_SEPARATOR . 'cert.cer', // Certificat
            CURLOPT_RETURNTRANSFER  => true,
            CURLOPT_TIMEOUT         => 1
        ]);
        $data = curl_exec($curl);
        if ($data === false || curl_getinfo($curl, CURLINFO_HTTP_CODE) != 200) {
            return null;
        }

        $data = json_decode($data, true);
        $results = [
            'temp' => $data['main']['temp'],
            'description' => $data['weather'][0]['description'],
            'date' => new DateTime('@'. $data['dt'])
        ];
        return $results;
    }
}
