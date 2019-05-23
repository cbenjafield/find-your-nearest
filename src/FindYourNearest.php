<?php

namespace Benjafield\FindYourNearest;

/**
 * Main Plugin Class
 */
class FindYourNearest {

	protected $version = '1.0.0';

	protected $shortcodes;

	protected $ajax;

	protected $request;

	public function __construct()
	{
		$this->bootstrap();
	}

	public function bootstrap()
	{
		require_once FYN_src_path . '/Response.php';
		require_once FYN_src_path . '/Request.php';
		require_once FYN_src_path . '/Shortcodes.php';
		require_once FYN_src_path . '/Ajax.php';

		$this->shortcodes = new Shortcodes;
		$this->ajax = new Ajax;
	}

}