<?php

namespace Benjafield\FindYourNearest;

class Shortcodes {

	protected $shortcodes = [];
	protected $prefix = 'fyn-';

	public function __construct()
	{
		$methods = get_class_methods($this);
		foreach($methods as $method)
		{
			if(stripos($method, 'sc') !== false) $this->add($this->_makeHandle($method), [$this, $method]);
		}
	}

	public function add(string $handle, $callable)
	{
		$this->shortcodes[] = $handle;
		add_shortcode($handle, $callable);
	}

	protected function _makeHandle(string $method)
	{
		$pieces = preg_split('/(?=[A-Z])/', $method);
		unset($pieces[0]);
		return strtolower($this->prefix . implode('-', $pieces));
	}

	public function scSearchForm($atts = [])
	{
		return fyn_component('search-form', shortcode_atts([
			'form_id' => 'fyn-form-' . uniqid(),
			'form_class' => '',
			'field_id' => '',
			'field_class' => '',
			'field_placeholder' => 'Enter your postcode...',
			'button_id' => '',
			'button_class' => '',
			'button_text' => 'Search'
		], $atts));
	}

}