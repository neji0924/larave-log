<?php

namespace Neji0924\Log\Providers;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;

Class AppServiceProvider extends BaseServiceProvider
{
	public function boot()
	{
		$this->publishes([
			__DIR__ . '/../../database' => database_path()
		], 'neji0924');
	}

	public function register()
	{
		//
	}
}