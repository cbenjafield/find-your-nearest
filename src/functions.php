<?php
/**
 * Helpful Global Plugin Functions
 */

if(!function_exists('dpr'))
{
	function dpr($data)
	{
		die('<pre>'.print_r($data, true).'</pre>');
	}
}

if(!function_exists('fyn_component'))
{
	function fyn_component(string $file, array $data = [])
	{
		ob_start();
		extract($data);

		$file = FYN_components_path . DIRECTORY_SEPARATOR . str_replace('.', DIRECTORY_SEPARATOR, $file) . '.php';

		if(realpath($file)) 
		{
			include $file;
			return ob_get_clean();
		}
		return '';
	}
}