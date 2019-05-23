<?php

namespace Benjafield\FindYourNearest;

class Ajax {

	protected $ajax = [];
	protected $prefix = 'fyn-';
	protected $request;

	public function __construct()
	{
		$this->request = new Request;
		$methods = get_class_methods($this);
		foreach($methods as $method)
		{
			if(stripos($method, 'ajax') !== false) $this->add($this->_makeHandle($method), [$this, $method]);
		}
	}

	public function add(string $handle, $callable)
	{
		$this->ajax[] = $handle;
		add_action('wp_ajax_' . $handle, $callable);
		add_action('wp_ajax_nopriv_' . $handle, $callable);
	}

	protected function _makeHandle(string $method)
	{
		$pieces = preg_split('/(?=[A-Z])/', $method);
		unset($pieces[0]);
		return strtolower($this->prefix . implode('-', $pieces));
	}

}