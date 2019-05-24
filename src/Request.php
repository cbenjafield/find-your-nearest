<?php

namespace Benjafield\FindYourNearest;

class Request {

	protected $get = [];
	protected $post = [];

	public function __construct()
	{
		$this->get = $_GET;
		$this->post = $_POST;
	}

	public function __get($name)
	{
		if(isset($_REQUEST[$name])) return $_REQUEST[$name];
		return null;
	}

	public function __isset($name)
	{
		return $this->has($name);
	}

	public function has($name)
	{
		return !!isset($_REQUEST[$name]);
	}

}