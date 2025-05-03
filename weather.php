<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');


ini_set('display_errors', 0);
error_reporting(E_ALL);

ini_set('log_errors', 1);
ini_set('error_log', 'weather_api_errors.log');

$location = isset($_GET['location']) ? $_GET['location'] : null;
$days = isset($_GET['days']) ? intval($_GET['days']) : 7;

if (!$location) {
    http_response_code(400);
    echo json_encode(['error' => 'Location parameter is required']);
    exit;
}

function getCoordinates($location) {
    $encodedLocation = urlencode($location);
    
    $nominatimUrl = "https://nominatim.openstreetmap.org/search?q={$encodedLocation}&format=json&limit=1";
    
    $ch = curl_init();
    
    curl_setopt($ch, CURLOPT_URL, $nominatimUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'User-Agent: OzoneAero Weather Map/1.0'
    ]);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    
    $response = curl_exec($ch);
    
    if ($response === false) {
        error_log("Nominatim API Error: " . curl_error($ch));
        curl_close($ch);
        return null;
    }
    
    curl_close($ch);
    
    $data = json_decode($response, true);
    
    if (empty($data) || !isset($data[0]['lat']) || !isset($data[0]['lon'])) {
        error_log("Nominatim API: No coordinates found for location: $location");
        return null;
    }
    
    return [
        'latitude' => $data[0]['lat'],
        'longitude' => $data[0]['lon'],
        'display_name' => $data[0]['display_name']
    ];
}

function getWeatherData($latitude, $longitude, $days) {
    $apiUrl = "https://api.open-meteo.com/v1/forecast?latitude={$latitude}&longitude={$longitude}" .
              "&current=temperature_2m,relative_humidity_2m,apparent_temperature,precipitation,weather_code,pressure_msl,surface_pressure,wind_speed_10m,wind_direction_10m,wind_gusts_10m" .
              "&hourly=temperature_2m,relative_humidity_2m,apparent_temperature,precipitation_probability,precipitation,weather_code,pressure_msl,surface_pressure,wind_speed_10m,wind_direction_10m,wind_gusts_10m,uv_index,visibility" .
              "&daily=weather_code,temperature_2m_max,temperature_2m_min,apparent_temperature_max,apparent_temperature_min,sunrise,sunset,uv_index_max,precipitation_sum,precipitation_hours,precipitation_probability_max,wind_speed_10m_max,wind_gusts_10m_max,wind_direction_10m_dominant" .
              "&timezone=auto&forecast_days={$days}";
    
    $ch = curl_init();
    
    curl_setopt($ch, CURLOPT_URL, $apiUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Accept: application/json',
        'User-Agent: OzoneAero Weather Map/1.0'
    ]);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    
    $response = curl_exec($ch);
    
    if ($response === false) {
        error_log("Open-Meteo API Error: " . curl_error($ch));
        curl_close($ch);
        return null;
    }
    
    curl_close($ch);
    
    $data = json_decode($response, true);
    
    if (!$data || isset($data['error'])) {
        error_log("Open-Meteo API Error: " . json_encode($data));
        return null;
    }
    
    return $data;
}

function getWeatherCondition($code) {
    $conditions = [
        0 => ['Cer senin', 'day/113.png'],
        1 => ['În principal clar', 'day/116.png'],
        2 => ['Parțial înnorat', 'day/116.png'],
        3 => ['Acoperit de nori', 'day/119.png'],
        45 => ['Ceaţă', 'day/248.png'],
        48 => ['Depunerea de ceață', 'day/248.png'],
        51 => ['Burniță ușoară', 'day/266.png'],
        53 => ['Burniță moderată', 'day/266.png'],
        55 => ['Burniță densă', 'day/266.png'],
        56 => ['Burniță ușoară înghețată', 'day/281.png'],
        57 => ['Burniță densă înghețată', 'day/284.png'],
        61 => ['Ploaie ușoară', 'day/296.png'],
        63 => ['Ploaie moderată', 'day/302.png'],
        65 => ['Ploaie puternică', 'day/308.png'],
        66 => ['Ploaie înghețată ușoară', 'day/311.png'],
        67 => ['Ploaie înghețată abundentă', 'day/314.png'],
        71 => ['Zăpadă ușoară', 'day/326.png'],
        73 => ['Zăpadă moderată', 'day/332.png'],
        75 => ['Zăpadă abundentă', 'day/338.png'],
        77 => ['Boabele de zăpadă', 'day/326.png'],
        80 => ['Averse uşoare de ploaie', 'day/353.png'],
        81 => ['Averse de ploaie moderată', 'day/356.png'],
        82 => ['Averse de ploaie violente', 'day/359.png'],
        85 => ['Averse ușoare de zăpadă', 'day/368.png'],
        86 => ['Averse abundente de zăpadă', 'day/371.png'],
        95 => ['Furtună', 'day/389.png'],
        96 => ['Furtună cu grindină ușoară', 'day/392.png'],
        99 => ['Furtună cu grindină puternică', 'day/395.png']
    ];
    
    if (isset($conditions[$code])) {
        return [
            'text' => $conditions[$code][0],
            'icon' => '//cdn.weatherapi.com/weather/64x64/' . $conditions[$code][1]
        ];
    }
    
    return [
        'text' => 'Unknown',
        'icon' => '//cdn.weatherapi.com/weather/64x64/day/116.png'
    ];
}

function convertToWeatherApiFormat($openMeteoData, $locationInfo) {
    $current = $openMeteoData['current'];
    $hourly = $openMeteoData['hourly'];
    $daily = $openMeteoData['daily'];
    
    $currentCondition = getWeatherCondition($current['weather_code']);
    
    $result = [
        'location' => [
            'name' => explode(',', $locationInfo['display_name'])[0],
            'region' => '',
            'country' => 'Romania',
            'lat' => $openMeteoData['latitude'],
            'lon' => $openMeteoData['longitude'],
            'localtime' => date('Y-m-d H:i')
        ],
        'current' => [
            'temp_c' => $current['temperature_2m'],
            'condition' => [
                'text' => $currentCondition['text'],
                'icon' => $currentCondition['icon'],
                'code' => $current['weather_code']
            ],
            'wind_kph' => $current['wind_speed_10m'] * 3.6, 
            'wind_degree' => $current['wind_direction_10m'],
            'pressure_mb' => $current['pressure_msl'],
            'humidity' => $current['relative_humidity_2m'],
            'feelslike_c' => $current['apparent_temperature'],
            'uv' => isset($hourly['uv_index'][0]) ? $hourly['uv_index'][0] : 0,
            'vis_km' => isset($hourly['visibility'][0]) ? $hourly['visibility'][0] / 1000 : 10 
        ],
        'forecast' => [
            'forecastday' => []
        ]
    ];
    
    $daysCount = count($daily['time']);
    for ($i = 0; $i < $daysCount; $i++) {
        $dayCondition = getWeatherCondition($daily['weather_code'][$i]);
        
        $hours = [];
        $dayStart = $i * 24;
        $dayEnd = $dayStart + 24;
        
        for ($h = $dayStart; $h < $dayEnd && $h < count($hourly['time']); $h++) {
            $hourCondition = getWeatherCondition($hourly['weather_code'][$h]);
            
            $hours[] = [
                'time' => $hourly['time'][$h],
                'temp_c' => $hourly['temperature_2m'][$h],
                'condition' => [
                    'text' => $hourCondition['text'],
                    'icon' => $hourCondition['icon'],
                    'code' => $hourly['weather_code'][$h]
                ],
                'wind_kph' => $hourly['wind_speed_10m'][$h] * 3.6,
                'wind_degree' => $hourly['wind_direction_10m'][$h],
                'pressure_mb' => $hourly['pressure_msl'][$h],
                'humidity' => $hourly['relative_humidity_2m'][$h],
                'feelslike_c' => $hourly['apparent_temperature'][$h],
                'will_it_rain' => $hourly['precipitation_probability'][$h] > 50 ? 1 : 0,
                'chance_of_rain' => $hourly['precipitation_probability'][$h]
            ];
        }
        
        $result['forecast']['forecastday'][] = [
            'date' => $daily['time'][$i],
            'day' => [
                'maxtemp_c' => $daily['temperature_2m_max'][$i],
                'mintemp_c' => $daily['temperature_2m_min'][$i],
                'avgtemp_c' => ($daily['temperature_2m_max'][$i] + $daily['temperature_2m_min'][$i]) / 2,
                'maxwind_kph' => $daily['wind_speed_10m_max'][$i] * 3.6,
                'totalprecip_mm' => $daily['precipitation_sum'][$i],
                'avghumidity' => array_sum(array_slice($hourly['relative_humidity_2m'], $dayStart, 24)) / 24,
                'daily_will_it_rain' => $daily['precipitation_probability_max'][$i] > 50 ? 1 : 0,
                'daily_chance_of_rain' => $daily['precipitation_probability_max'][$i],
                'condition' => [
                    'text' => $dayCondition['text'],
                    'icon' => $dayCondition['icon'],
                    'code' => $daily['weather_code'][$i]
                ],
                'uv' => $daily['uv_index_max'][$i]
            ],
            'hour' => $hours
        ];
    }
    
    return $result;
}

function getFallbackData($location) {
    $city = explode(',', $location)[0];
    
    $now = new DateTime();
    $currentHour = (int)$now->format('G');
    
    $temp = rand(15, 25);
    $conditions = ['Sunny', 'Partly cloudy', 'Cloudy', 'Clear', 'Light rain'];
    $condition = $conditions[array_rand($conditions)];
    
    $data = [
        'location' => [
            'name' => $city,
            'region' => '',
            'country' => 'Romania',
            'lat' => 0,
            'lon' => 0,
            'localtime' => $now->format('Y-m-d H:i')
        ],
        'current' => [
            'temp_c' => $temp,
            'condition' => [
                'text' => $condition,
                'icon' => '//cdn.weatherapi.com/weather/64x64/day/116.png',
                'code' => 1000
            ],
            'wind_kph' => rand(5, 20),
            'humidity' => rand(40, 80),
            'feelslike_c' => $temp - rand(-2, 2),
            'uv' => rand(1, 8),
            'pressure_mb' => rand(1000, 1020),
            'vis_km' => rand(8, 15)
        ],
        'forecast' => [
            'forecastday' => []
        ],
        '_fallback' => true
    ];
    
    for ($i = 0; $i < 7; $i++) {
        $date = new DateTime();
        $date->modify("+$i day");
        
        $dayTemp = rand(15, 28);
        $nightTemp = rand(8, 15);
        $dayCondition = $conditions[array_rand($conditions)];
        
        $hours = [];
        for ($h = 0; $h < 24; $h++) {
            $hourTemp = $h >= 8 && $h <= 18 ? 
                        rand($dayTemp - 2, $dayTemp + 2) : 
                        rand($nightTemp - 2, $nightTemp + 2);
            
            $hourDate = clone $date;
            $hourDate->setTime($h, 0);
            
            $hours[] = [
                'time' => $hourDate->format('Y-m-d H:i'),
                'temp_c' => $hourTemp,
                'condition' => [
                    'text' => $h >= 8 && $h <= 18 ? $dayCondition : 'Clear',
                    'icon' => '//cdn.weatherapi.com/weather/64x64/day/116.png',
                    'code' => 1000
                ]
            ];
        }
        
        $data['forecast']['forecastday'][] = [
            'date' => $date->format('Y-m-d'),
            'day' => [
                'maxtemp_c' => $dayTemp,
                'mintemp_c' => $nightTemp,
                'condition' => [
                    'text' => $dayCondition,
                    'icon' => '//cdn.weatherapi.com/weather/64x64/day/116.png',
                    'code' => 1000
                ]
            ],
            'hour' => $hours
        ];
    }
    
    return $data;
}

try {
    $coordinates = getCoordinates($location);

    $weatherData = getWeatherData($coordinates['latitude'], $coordinates['longitude'], $days);
    
    if (!$weatherData) {
        $fallbackData = getFallbackData($location);
        echo json_encode($fallbackData);
        exit;
    }
    
    $formattedData = convertToWeatherApiFormat($weatherData, $coordinates);
    
    echo json_encode($formattedData);
} catch (Exception $e) {
    error_log("Weather API Error: " . $e->getMessage());

    $fallbackData = getFallbackData($location);
    echo json_encode($fallbackData);
}
