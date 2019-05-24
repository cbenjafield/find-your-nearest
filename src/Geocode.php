<?php

namespace Benjafield\FindYourNearest;

class Geocode {

	protected $googleApiKey = '';

	protected $request;

	public function __construct(Request $request)
	{
		$this->request = $request;
	}

	public function buildGoogleGeocodeUrl(array $params = [])
	{
		if(isset($params['components']) && is_array($params['components']))
		{
			$components = [];
			foreach($params['components'] as $key => $value)
			{
				$components[] = $key . ':' . urlencode($value);
			}
			$params['components'] = implode('|', $components);
		}

		$params = array_merge([
			'key' => $this->googleApiKey
		], $params);

		$queryStringArr = [];

		foreach($params as $key => $value)
		{
			$queryStringArr[] = $key . '=' . ($key !== 'components' ? urlencode($value) : $value);
		}

		return 'https://maps.googleapis.com/maps/api/geocode/json?' . implode('&', $queryStringArr);
	}

	public function googleGeocode(array $params = [])
	{
		$url = $this->buildGoogleGeocodeUrl($params);

		$response = json_decode(file_get_contents($url));

		if(!isset($response->results[0]->geometry)) return false;

		return (object) [
			'latitude' => $response->results[0]->geometry->location->lat,
			'longitude' => $response->results[0]->geometry->location->lng
		];
	}

}