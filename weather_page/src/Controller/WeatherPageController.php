<?php

namespace Drupal\weather_page\Controller;

use Drupal\Core\Controller\ControllerBase;

class WeatherPageController extends ControllerBase
{
  public function display()
  {
    //use guzzle to get temp for city
    $response = \Drupal::httpClient()
    ->get('api.openweathermap.org/data/2.5/weather?zip=21211,us&units=Imperial&appid=9440334fdd1938f308d12e80651537d0');
    $json_string = (string) $response->getBody();
    $weather = json_decode($json_string,true);
    return [
      '#markup' => $this->t('The current temperature is @temp in Baltimore. Condition (clouds/raining) is:  @precip and a high of @high. and a low of @low', ['@temp' => $weather['main']['temp'], '@precip' => $weather['weather'][0]['main'], '@high'=> $weather['main']['temp_max'], '@low'=> $weather['main']['temp_min'] ])
    ];
  }
}
