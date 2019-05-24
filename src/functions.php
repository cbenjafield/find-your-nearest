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

if(!function_exists('fyn_start'))
{
	function fyn_instance()
	{
		return new Benjafield\FindYourNearest\FindYourNearest;
	}
}

if(!function_exists('fyn_url'))
{
	function fyn_url($path = null)
	{
		return FYN_plugin_url . (!empty($path) ? ltrim($path, '/') : '');
	}
}

if(!function_exists('fyn_valid_postcode'))
{
	function fyn_valid_postcode($originalPostcode)
	{
		$valid = false;
		$alpha1 = "[abcdefghijklmnoprstuwyz]";
		$alpha2 = "[abcdefghklmnopqrstuvwxy]";
		$alpha3 = "[abcdefghjkpmnrstuvwxy]";
		$alpha4 = "[abehmnprvwxy]";
		$alpha5 = "[abdefghjlnpqrstuwxyz]";

		// Expression for AN NAA, ANN NAA, AAN NAA, AANN NAA with a space.
		$pcexp[0] = '/^('.$alpha1.'{1}'.$alpha2.'{0,1}[0-9]{1,2})([[:space:]]{0,})([0-9]{1}'.$alpha5.'{2})$/';

		// Expression for ANA NAA
		$pcexp[1] = '/^('.$alpha1.'{1}[0-9]{1}'.$alpha3.'{1})([[:space:]]{0,})([0-9]{1}'.$alpha5.'{2})$/';

		// Expression for AANA NAA
		$pcexp[2] = '/^('.$alpha1.'{1}'.$alpha2.'{1}[0-9]{1}'.$alpha4.')([[:space:]]{0,})([0-9]{1}'.$alpha5.'{2})$/';

		// Exception for the special postcode GIR 0AA
		$pcexp[3] = '/^(gir)([[:space:]]{0,})(0aa)$/';

		// Standard BFPO numbers
		$pcexp[4] = '/^(bfpo)([[:space:]]{0,})([0-9]{1,4})$/';

		// c/o BFPO numbers
		$pcexp[5] = '/^(bfpo)([[:space:]]{0,})(c\/o([[:space:]]{0,})[0-9]{1,3})$/';

		// Overseas Territories
		$pcexp[6] = '/^([a-z]{4})([[:space:]]{0,})(1zz)$/';

		// Anquilla
		$pcexp[7] = '/^ai-2640$/';

		$postcode = strtolower($originalPostcode);

		foreach($pcexp as $regex)
		{
			if(preg_match($regex, $postcode, $matches))
			{
				$postcode = strtoupper($matches[1] . ' ' . $matches[3]);
				$postcode = preg_replace ('/C\/O([[:space:]]{0,})/', 'c/o ', $postcode);
				preg_match($pcexp[7], strtolower($originalPostcode), $matches) AND $postcode = 'AI-2640';
				$valid = true;
				break;
			}
		}

		if($valid)
		{
			return $postcode;
		}

		return false;
	}
}