<?php

namespace Benjafield\FindYourNearest;

/**
 * Main Plugin Class
 */
class FindYourNearest {

	protected $version = '1.0.0';

	protected $shortcodes;

	protected $ajax;

	protected $admin;

	public function __construct()
	{
		$this->bootstrap();

		if(is_admin()) $this->adminBootstrap();
	}

	protected function bootstrap()
	{
		require_once FYN_src_path . '/Response.php';
		require_once FYN_src_path . '/Request.php';
		require_once FYN_src_path . '/Geocode.php';
		require_once FYN_src_path . '/Shortcodes.php';
		require_once FYN_src_path . '/Ajax.php';

		$this->shortcodes = new Shortcodes;
		$this->ajax = new Ajax;
	}

	protected function adminBootstrap()
	{
		$this->admin = new Admin;
	}

	public function search(Request $request)
	{
		
	}

}