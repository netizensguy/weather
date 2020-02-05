<?php
namespace Netizensguy\Weather;

use GuzzleHttp\Client;

class Weather
{

	protected $gaoDeKey;//高德地图的key,列如：3c4f5741a79827018790af984084a81d
	protected $guzzleOptions = []; 
  
    public function __construct($key)
    {
    	$this->gaoDeKey = $key;
    }

    public function getHttpClient()
    {
    	return new Client($this->guzzleOptions);
    }

    public function setGuzzleOptions(array $options)
    {
    	$this->guzzleOptions = $options;
    } 

    public function getWeather($city, $type = 'base', $format = 'json')
    {
        $url = "https://restapi.amap.com/v3/weather/weatherInfo";

        $query = array_filter([
            'key' => $this->gaoDeKey,
            'city' => $city,
            'output' => $format,
            'extensions' =>  $type,
        ]);

        $response = $this->getHttpClient()->get($url, [
            'query' => $query,
        ])->getBody()->getContents();

        return $format === 'json' ? json_decode($response) : $response;

    }

}
