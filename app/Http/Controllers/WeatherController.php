<?php

namespace App\Http\Controllers;

use App\Http\Requests\WeatherGetRequest;
use Illuminate\Http\Request;
use App\Services\WeatherService;
use Illuminate\Support\Facades\Auth;

class WeatherController extends Controller
{
    /**
     * Handle a GET request to retrieve the weather for a given location.
     * Validates the request and delegates the response generation to a private method.
     * @param  WeatherGetRequest  $request          Validated request object.
     * @param  WeatherService     $weatherService   Weather service to retrieve weather data.
     * @return \Illuminate\Http\JsonResponse
     */
    public function getWeather(WeatherGetRequest $request, WeatherService $weatherService)
    {
        $validated = $request->validated();
        $location = $validated['location'];
        return $this->generateWeatherResponse($location, $weatherService);
    }

    /**
     * Handle a POST request to retrieve the weather for a given location.
     * Validates the request and delegates the response generation to a private method.
     * @param  WeatherGetRequest  $request          Validated request object.
     * @param  WeatherService     $weatherService   Weather service to retrieve weather data.
     * @return \Illuminate\Http\JsonResponse
     */
    public function postWeather(WeatherGetRequest $request, WeatherService $weatherService)
    {
        $validated = $request->validated();
        $location = $validated['location'];
        return $this->generateWeatherResponse($location, $weatherService);
    }

    /**
     * Generates the weather response for a given location.
     * Utilizes the WeatherService to fetch weather data and formats the response accordingly.
     * @param  string           $location        The location for which to retrieve the weather.
     * @param  WeatherService   $weatherService  Weather service to retrieve weather data.
     * @return \Illuminate\Http\JsonResponse
     */
    private function generateWeatherResponse($location, WeatherService $weatherService)
    {
        try {
            $weatherData = $weatherService->getWeatherData($location);

            if (!isset($weatherData->current)) {
                return response()->json(['message' => 'Could not find weather for this location.'], 404);
            }

            return response()->json($weatherData);
        } catch (\Exception $e) {
            // Logging the exception's message could be valuable for debugging
            // logger($e->getMessage());

            return response()->json(['message' => 'There was an error while processing your request.'], 500);
        }
    }
}
