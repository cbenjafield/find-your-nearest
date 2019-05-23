<?php

namespace Benjafield\FindYourNearest;

class Response {

	protected static $instance;

	public static function instance()
	{
		if(is_null(self::$instance))
		{
			self::$instance = new self;
		}
		return self::$instance;
	}

	public function json($payload = [], $status = 200)
	{
		header('Content-Type: application/json');
		http_response_code($status);
		die(json_encode($payload));
	}

	public static function ok($data = [])
	{
		return self::instance()->json($data, 200);
	}

	public static function notFound($data = [])
	{
		return self::instance()->json($data, 404);
	}

	public static function notAllowed($data = [])
	{
		return self::instance()->json($data, 403);
	}

	public static function badRequest($data = [])
	{
		return self::instance()->json($data, 400);
	}

	public static function error($data = [])
	{
		return self::instance()->json($data, 500);
	}

}