<?php

namespace Benjafield\FindYourNearest;

class Admin {

	protected $request;

	protected $country = 'United Kingdom';

	public function __construct()
	{
		$this->register();

		$this->request = new Request;
	}

	protected function register()
	{
		add_action('add_meta_boxes', [$this, 'registerPostMetaBox']);
		add_action('admin_enqueue_scripts', [$this, 'registerScripts']);
		$this->ajax();
	}

	public function registerPostMetaBox()
	{
		add_meta_box(
			'fyn-meta-box',
			__('<span class="dashicons dashicons-location-alt"></span> Find Your Nearest', 'find-your-nearest'),
			[$this, 'renderPostMetaBox'],
			['post', 'page'],
			'normal',
			'default'
		);
	}

	public function renderPostMetaBox($post)
	{
		wp_nonce_field('fyn_post_nonce', 'fyn_post_nonce');
		$this->postMetaBoxHtml($post);
	}

	public function postMetaBoxHtml($post)
	{
		echo fyn_component('admin.post-meta-box');
	}

	public function registerScripts()
	{
		wp_enqueue_script('fyn-admin', plugin_dir_url(dirname(__FILE__)) . 'js/fyn-admin.js', ['jquery'], false, true);
		wp_localize_script('fyn-admin', 'fyn_admin', [
			'ajaxurl' => admin_url('admin-ajax.php')
		]);
	}

	protected function ajax()
	{
		add_action('wp_ajax_fyn_geocode_postcode', [$this, 'geocodePostcode']);
	}

	public function geocodePostcode()
	{
		if($this->request->has('postcode') && fyn_valid_postcode($this->request->postcode))
		{
			$geocode = new Geocode($this->request);

			$geoData = $geocode->googleGeocode([
				'components' => [
					'postal_code' => $this->request->postcode,
					'country' => $this->country
				]
			]);

			if(!$geoData) {
				return Response::badRequest([
					'message' => 'Postcode not recognised. Please ensure you enter a valid UK postcode.'
				]);
			}

			return Response::ok($geoData);
		}
	}



}