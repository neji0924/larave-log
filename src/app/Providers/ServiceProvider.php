<?php

namespace Neji0924\Log\Providers;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;

Class ServiceProvider extends BaseServiceProvider
{
	public function boot()
	{
		$this->publishResources();
	}

	public function register()
	{
		//
	}

	protected function publishResources()
	{
		$this->publishes([
			__DIR__ . '/../../database' => database_path()
		], 'database');
	}
}