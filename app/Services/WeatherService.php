<?php

namespace App\Services;

use GuzzleHttp\Client;

/**
 * Class WeatherService
 * This service class handles interactions with the WeatherAPI.
 */
class WeatherService
{
    // We're injecting a GuzzleHttp Client instance here to make HTTP requests
    private $client;

    /**
     * WeatherService constructor.
     * The Client instance is injected in the constructor.     *
     * @param Client $client GuzzleHttp Client instance.
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Get weather data for a specific location.
     * This function makes a GET request to the WeatherAPI to fetch the current weather data for the given location.
     * @param $location Location for which we want the weather data.
     * @return mixed The weather data for the specified location.
     */
    public function getWeatherData($location)
    {
        // We're making a GET request to the WeatherAPI using the injected GuzzleHttp client.
        // The 'query' parameter is an associative array that will be appended to the URL as query parameters.
        $response = $this->client->request('GET', 'http://api.weatherapi.com/v1/current.json', [
            'query' => [
                'key' => env('WEATHER_API_KEY'),  // The API key is fetched from the environment variables.
                'q' => $location,  // The location for which we want the weather data.
            ],
        ]);

        // We're getting the contents of the response body and decoding it from JSON to a PHP variable.
        return json_decode($response->getBody()->getContents());
    }
}

